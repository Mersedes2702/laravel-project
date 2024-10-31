<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with('product', 'user')->latest()->get();
        return view('logs.index', compact('logs'));
    }
}
