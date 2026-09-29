<?php

/* só para probas de funcionamento da BBDDD */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DatabaseTestController extends Controller
{
    public function index()
    {
        $database = DB::selectOne(
            'SELECT current_database() AS database, version() AS version'
        );

        return response()->json([
            'status' => 'ok',
            'database' => $database->database,
            'version' => $database->version,
        ]);
    }
}
