<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaketLayanan;

class LandingPageController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user')->latest()->take(6)->get();
        if (Auth::check()) return redirect()->route('beranda');
        return view('LandingPage.index', compact('feedbacks'));
    }
}