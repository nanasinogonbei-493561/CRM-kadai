<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

// 構造化ログの設定をしました。
Log::error($message);
Log::warning($message);
Log::info($message);
Log::debug($message);

class UserController extends Controller
{
    public function index()
    {
        Log::error($message);
        Log::debug('message');
        return view('home');
    }
}