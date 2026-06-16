<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function index()
    {
        $features = [
            [
                'icon'  => 'fas fa-leaf',
                'title' => 'Edukasi Bambu',
                'desc'  => 'Mengedukasi pengunjung tentang morfologi dan ekologi bambu sebagai upaya pelestarian.',
                'color' => 'text-orange',
            ],
            [
                'icon'  => 'fas fa-handshake',
                'title' => 'Ekonomi Berkelanjutan',
                'desc'  => 'Memberdayakan masyarakat lokal dan menciptakan kolaborasi yang saling menguntungkan.',
                'color' => 'text-green',
            ],
            [
                'icon'  => 'fas fa-recycle',
                'title' => 'Siklus Ramah Alam',
                'desc'  => 'Pengelolaan alam dilakukan secara ramah lingkungan agar kawasan tetap terjaga dan wisata dapat berlangsung berkelanjutan.',
                'color' => 'text-orange',
            ],
            [
                'icon'  => 'fas fa-seedling',
                'title' => 'Konservasi Bambu',
                'desc'  => 'Dengan koleksi 49 jenis bambu, Bhumi Bambu menghadirkan pengalaman belajar dan berwisata di tengah keragaman bambu yang bermanfaat bagi lingkungan.',
                'color' => 'text-green',
            ],
        ];

        $aktivitas = [
            [
                'img'   => 'aktivitas/camping.jpg',
                'title' => 'Berkemah',
                'desc'  => 'Nikmati malam di bawah bintang di tengah hutan bambu yang asri dan menenangkan.',
            ],
            [
                'img'   => 'aktivitas/outbound.jpg',
                'title' => 'Outbound & Gathering',
                'desc'  => 'Cocok untuk team building perusahaan, sekolah, maupun komunitas dengan berbagai wahana seru.',
            ],
            [
                'img'   => 'aktivitas/edukasi.jpg',
                'title' => 'Edukasi Bambu',
                'desc'  => 'Belajar langsung tentang jenis-jenis bambu, manfaat, dan cara pengolahannya dari pemandu ahli.',
            ],
            [
                'img'   => 'aktivitas/wisata.jpg',
                'title' => 'Wisata Alam',
                'desc'  => 'Jelajahi curug, hutan bambu, dan hamparan alam hijau yang menyegarkan jiwa dan raga.',
            ],
            [
                'img'   => 'aktivitas/pondok.jpg',
                'title' => 'Pondok Kayu',
                'desc'  => 'Menginap nyaman di pondok kayu alami dengan suasana alam yang tenang dan sejuk.',
            ],
            [
                'img'   => 'aktivitas/cafe.jpg',
                'title' => 'Silver Roof Cafe',
                'desc'  => 'Santai menikmati kuliner dan minuman segar sambil memandang panorama alam Baturraden.',
            ],
        ];

        return view('LandingPage.tentangkami', compact('features', 'aktivitas'));
    }
}