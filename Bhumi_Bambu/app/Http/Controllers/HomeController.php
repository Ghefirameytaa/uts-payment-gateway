<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function beranda()
    {
        $pakets    = PaketLayanan::latest()->take(4)->get();
        $feedbacks = Feedback::with('user')->latest()->take(6)->get();
        $myFeedback = Feedback::where('user_id', auth()->id())->latest()->first();
        return view('beranda', compact('pakets', 'feedbacks', 'myFeedback'));
    }
}