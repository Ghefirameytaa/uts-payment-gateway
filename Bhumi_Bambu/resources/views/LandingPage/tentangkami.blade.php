@extends('layout.app')

@section('title', 'Tentang Kami')

@section('content')

<!-- HERO -->
<section class="hero-tentang">
    <img src="{{ asset('aset/tentang/foto1.png') }}" alt="">
</section>

<!-- ABOUT -->
<section class="tentang-section">
    <div class="container">

        <div class="tentang-row">

            <!-- TEXT -->
            <div class="tentang-text">
                <h2>Tentang Kami</h2>

                <h3>Menjaga Bhumi Dengan Bambu</h3>

                <p>
                    Bhumi Bambu merupakan kawasan ekowisata 
                    bernuansa alam yang asri dengan koleksi 49 jenis 
                    bambu yang menjadi daya tarik utama sekaligus 
                    sarana edukasi bagi pengunjung. 
                </p>

                <p>
                    Selain hutan bambu, kawasan ini dilengkapi dengan 
                    curug alami, pondok kayu, area camping, serta 
                    berbagai aktivitas outbound yang cocok untuk 
                    keluarga maupun rombongan
                </p>

                <p>
                    Bhumi Bambu menjadi destinasi ideal bagi keluarga, 
                    pelajar, dan rombongan yang ingin menikmati wisata 
                    edukatif, menyenangkan, dan dekat dengan alam.
                </p>
            </div>

            <!-- IMAGE -->
            <div class="tentang-image">
                <img src="{{ asset('aset/tentang/foto2.png') }}" alt="">
            </div>

        </div>

    </div>
</section>

<!-- MENGAPA BERBEDA -->
<section class="berbeda-section">
    <div class="container">

        <div class="berbeda-row">

            <!-- KIRI GAMBAR -->
            <div class="berbeda-image">
                <img src="{{ asset('aset/tentang/foto3.png') }}" alt="">
                <img src="{{ asset('aset/tentang/foto4.png') }}" alt="">
            </div>

            <!-- KANAN -->
            <div class="berbeda-content">

                <!-- JUDUL (PINDAH KE SINI & KIRI) -->
                <h2 class="judul-section">Mengapa Bhumi Bambu Berbeda?</h2>

                <div class="berbeda-grid">

                    <div class="item">
                        <h4>Edukasi Bambu</h4>
                        <p>Mengedukasi pengunjung tentang morfologi dan ekologi bambu sebagai upaya pelestarian.</p>
                    </div>

                    <div class="item">
                        <h4>Ekonomi Berkelanjutan</h4>
                        <p>Memberdayakan masyarakat lokal dan menciptakan kolaborasi yang saling menguntungkan</p>
                    </div>

                    <div class="item">
                        <h4>Siklus Ramah Alam</h4>
                        <p>Pengelolaan alam dilakukan secara ramah lingkungan agar kawasan tetap terjaga dan wisata dapat berlangsung berkelanjutan.</p>
                    </div>

                    <div class="item">
                        <h4>Konservasi Bambu</h4>
                        <p>Dengan koleksi 49 jenis bambu, Bhumi Bambu menghadirkan pengalaman belajar dan berwisata di tengah keragaman bambu yang bermanfaat bagi lingkungan.</p>
                    </div>

                </div>

                <a href="#" class="btn-aktivitas">Aktivitas Kami</a>

            </div>

        </div>

    </div>
</section>

<style>

/* GLOBAL BG */
body{
    background: #F4EFE6;
}

/* HERO */
.hero-tentang img{
    width: 100%;
    height: 700px;
    object-fit: cover;
}

/* CONTAINER */
.container{
    max-width: 1200px;
    margin: auto;
    padding: 0 20px;
}

/* SECTION */
.tentang-section,
.berbeda-section{
    padding: 80px 0;
    background: #F4EFE6;
}

/* ABOUT */
.tentang-row{
    display: flex;
    align-items: center;
    gap: 50px;
}

.tentang-text{
    flex: 1;
}

.tentang-text h2{
    font-size: 40px;
    margin-bottom: 10px;
    font-weight: 700;
}

.tentang-text h3{
    color: #e58b1f;
    margin-bottom: 15px;
    font-size: 28px;
}

.tentang-text p{
    line-height: 1.5;
    margin-bottom: 15px;
    font-size: 20px;
    text-align: justify;
    text-justify: inter-word;
}

.tentang-image{
    flex: 1;
}

.tentang-image img{
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 12px;
}

/* BERBEDA */
.berbeda-row{
    display: flex;
    gap: 50px;
    align-items: flex-start;
}

/* GAMBAR KIRI (FIX SIZE SESUAI KAMU) */
.berbeda-image{
    width: 400px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.berbeda-image img{
    width: 400px;
    height: 300px;
    object-fit: cover;
    border-radius: 12px;
}

/* KANAN */
.berbeda-content{
    flex: 1;
    margin-left: 50px;
}

.judul-section{
    font-size: 32px;
    margin-bottom: 50px;
    margin-right: 30px;
}

/* GRID */
.berbeda-grid{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    margin-top: 30px;
}

.item h4{
    color: #e58b1f;
    margin-bottom: 8px;
}

.item p{
    font-size: 14px;
    line-height: 1.7;
}

/* BUTTON */
.btn-aktivitas{
    display: inline-block;
    margin-top: 60px;
    background: #e58b1f;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
}

.btn-aktivitas:hover{
    background: #c87414;
}

/* RESPONSIVE */
@media (max-width: 768px){

    .tentang-row,
    .berbeda-row{
        flex-direction: column;
    }

    .berbeda-image,
    .berbeda-image img{
        width: 100%;
        height: auto;
    }

    .berbeda-grid{
        grid-template-columns: 1fr;
    }
}

</style>

@endsection