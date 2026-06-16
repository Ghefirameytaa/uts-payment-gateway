<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // ================= READ (Semua feedback milik user login) =================
    public function index()
    {
        $feedbacks = Feedback::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('feedback.index', compact('feedbacks'));
    }

    // ================= CREATE - Form =================
    public function create()
    {
        // Cek apakah user pernah reservasi dan sudah lunas
        $hasReservation = \App\Models\Reservasi::where('user_id', auth()->id())
            ->where('status_pembayaran', 'lunas')
            ->exists();

        if (!$hasReservation) {
            return redirect()->route('beranda')
                ->with('error', 'Anda harus memiliki reservasi tiket yang sudah lunas terlebih dahulu untuk dapat memberikan feedback.');
        }

        return view('feedback.create');
    }

    // ================= CREATE - Store =================
    public function store(Request $request)
    {
        // Pengecekan ulang di backend untuk mencegah bypass via request POST/Postman
        $hasReservation = \App\Models\Reservasi::where('user_id', auth()->id())
            ->where('status_pembayaran', 'lunas')
            ->exists();

        if (!$hasReservation) {
            return redirect()->route('beranda')
                ->with('error', 'Anda tidak diizinkan mengirim feedback karena belum memiliki reservasi lunas.');
        }

        $validated = $request->validate([
            'judul'   => ['required', 'string', 'max:255'],
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'komentar'=> ['required', 'string', 'max:1000'],
        ], [
            'judul.required'    => 'Judul feedback wajib diisi.',
            'rating.required'   => 'Rating wajib dipilih.',
            'komentar.required' => 'Komentar wajib diisi.',
        ]);

        Feedback::create([
            'user_id'          => auth()->id(),
            'judul'            => $validated['judul'],
            'rating'           => $validated['rating'],
            'komentar'         => $validated['komentar'],
            'tanggal_feedback' => now()->toDateString(),
        ]);

        return redirect()->route('feedback.index')
                         ->with('success', 'Feedback berhasil dikirim. Terima kasih!');
    }

    // ================= READ - Detail =================
    public function show($id)
    {
        $feedback = Feedback::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('feedback.show', compact('feedback'));
    }

    // ================= UPDATE - Form Edit =================
    public function edit($id)
    {
        $feedback = Feedback::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('feedback.edit', compact('feedback'));
    }

    // ================= UPDATE - Simpan =================
    public function update(Request $request, $id)
    {
        $feedback = Feedback::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $validated = $request->validate([
            'judul'   => ['required', 'string', 'max:255'],
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'komentar'=> ['required', 'string', 'max:1000'],
        ]);

        $feedback->update([
            'judul'   => $validated['judul'],
            'rating'  => $validated['rating'],
            'komentar'=> $validated['komentar'],
        ]);

        return redirect()->route('feedback.index')
                         ->with('success', 'Feedback berhasil diperbarui.');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $feedback = Feedback::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $feedback->delete();

        return redirect()->route('feedback.index')
                         ->with('success', 'Feedback berhasil dihapus.');
    }
}