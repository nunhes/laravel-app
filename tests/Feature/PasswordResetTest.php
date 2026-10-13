
<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

uses(RefreshDatabase::class);

it('shows the password recovery form', function () {
    $this->get(route('password.request'))
        ->assertOk()
        ->assertSee('Recuperar contrasinal');
});

it('sends a reset notification for a registered user', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post(route('password.email'), [
        'email' => $user->email,
    ])
        ->assertRedirect()
        ->assertSessionHas(
            'status',
            'Se existe unha conta asociada a ese correo, recibirás unha ligazón de recuperación.'
        );

    Notification::assertSentTo($user, ResetPassword::class);
});

it('does not reveal whether an email is registered', function () {
    Notification::fake();

    $this->post(route('password.email'), [
        'email' => 'non-existe@example.test',
    ])
        ->assertRedirect()
        ->assertSessionHas(
            'status',
            'Se existe unha conta asociada a ese correo, recibirás unha ligazón de recuperación.'
        );

    Notification::assertNothingSent();
});

it('resets the password with a valid token', function () {
    $user = User::factory()->create([
        'password' => 'current-password-123',
    ]);

    $token = Password::broker()->createToken($user);

    $resetUrl = route('password.reset', [
        'token' => $token,
        'email' => $user->email,
    ]);

    $this->from($resetUrl)
        ->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ])
        ->assertRedirect(route('login'))
        ->assertSessionHas(
            'status',
            'O contrasinal actualizouse correctamente. Xa podes iniciar sesión.'
        );

    expect(Hash::check(
        'new-password-123',
        $user->fresh()->password
    ))->toBeTrue();
});

it('rejects an invalid token without changing the password', function () {
    $user = User::factory()->create([
        'password' => 'current-password-123',
    ]);

    $originalHash = $user->password;
    $token = 'invalid-token';

    $resetUrl = route('password.reset', [
        'token' => $token,
        'email' => $user->email,
    ]);

    $this->from($resetUrl)
        ->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ])
        ->assertRedirect($resetUrl)
        ->assertSessionHasErrors('email');

    expect($user->fresh()->password)->toBe($originalHash);
});

it('rejects an expired token without changing the password', function () {
    $user = User::factory()->create([
        'password' => 'current-password-123',
    ]);

    $originalHash = $user->password;
    $token = Password::broker()->createToken($user);

    $resetUrl = route('password.reset', [
        'token' => $token,
        'email' => $user->email,
    ]);

    // A configuración actual permite utilizar o token durante 60 minutos.
    $this->travel(61)->minutes();

    $this->from($resetUrl)
        ->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ])
        ->assertRedirect($resetUrl)
        ->assertSessionHasErrors('email');

    expect($user->fresh()->password)->toBe($originalHash);
});

it('does not allow a reset token to be reused', function () {
    $user = User::factory()->create([
        'password' => 'current-password-123',
    ]);

    $token = Password::broker()->createToken($user);

    $resetUrl = route('password.reset', [
        'token' => $token,
        'email' => $user->email,
    ]);

    // Primeiro uso: debe funcionar.
    $this->post(route('password.update'), [
        'token' => $token,
        'email' => $user->email,
        'password' => 'first-new-password-123',
        'password_confirmation' => 'first-new-password-123',
    ])
        ->assertRedirect(route('login'));

    // Segundo uso do mesmo token: debe ser rexeitado.
    $this->from($resetUrl)
        ->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'second-new-password-123',
            'password_confirmation' => 'second-new-password-123',
        ])
        ->assertRedirect($resetUrl)
        ->assertSessionHasErrors('email');

    expect(Hash::check(
        'first-new-password-123',
        $user->fresh()->password
    ))->toBeTrue();
});