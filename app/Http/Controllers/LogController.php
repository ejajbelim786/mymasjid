<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function showLogs()
    {
        $logs = Activity::latest()->paginate(20);
        return view('logs.index', compact('logs'));
    }
}
