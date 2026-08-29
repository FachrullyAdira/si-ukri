<?php

namespace App\Http\Controllers;

use App\Http\Requests\KontakRequest;
use App\Models\PesanKontak;
use App\Models\PengaturanSitus;
use App\Notifications\PesanKontakNotification;
use Illuminate\Support\Facades\Notification;

class KontakController extends Controller
{
    public function index()
    {
        $alamat = PengaturanSitus::getValue('alamat', 'Jl. Terusan Halimun No.37, Lengkong, Kota Bandung');
        $telepon = PengaturanSitus::getValue('telepon', '(022) 7315175');
        $email = PengaturanSitus::getValue('email', 'si@ukri.ac.id');

        return view('kontak', compact('alamat', 'telepon', 'email'));
    }

    public function store(KontakRequest $request)
    {
        $validated = $request->validated();
        unset($validated['website_hp']); // Remove honeypot field before database insertion

        $pesan = PesanKontak::create($validated);

        try {
            Notification::route('mail', 'si@ukri.ac.id')->notify(new PesanKontakNotification($pesan));
        } catch (\Throwable $e) {
            // Log notification error silently so form submission succeeds
        }

        return redirect()->back()->with('success', 'Terima kasih, pesan Anda berhasil dikirim! Tim sekretariat kami akan merespons melalui email/WhatsApp.');
    }
}
