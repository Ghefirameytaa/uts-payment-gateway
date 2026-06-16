@extends('layout.app')
@section('title','Beranda Pelanggan')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="bb-page">

  {{-- HERO USER --}}
  <section class="bb-hero">
    <div class="bb-container bb-hero-inner">
      <div class="bb-hero-left">
        <span class="bb-hero-label">Beranda Pelanggan</span>
        <h1 class="bb-hero-title">Halo, {{ Auth::user()->nama_user }} 👋</h1>
        <p class="bb-hero-sub">Pilih paket yang kamu butuhkan, lalu lanjutkan reservasi dengan mudah.</p>
      </div>

      <a href="{{ route('reservasi.create') }}" class="bb-hero-cta">
        <span>Buat Reservasi</span>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
          <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </section>


  {{-- PAKET --}}
  <section class="bb-paket">
    <div class="bb-container">

      <div class="bb-paket-head">
        <div>
          <h2 class="bb-paket-title">Paket Layanan</h2>
          <p class="bb-paket-sub">Paket yang paling sering dipilih pengunjung Bhumi Bambu</p>
        </div>
        <a class="bb-paket-more" href="#">
          Lihat semua
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>

      <div class="bb-grid">

        {{-- Card 1 --}}
        <article class="bb-card">
          <div class="bb-card-media">
            <img src="aset/gambarPaket/camping1.jpg" alt="Paket Camp Chill">
            <div class="bb-card-overlay"></div>
            <span class="bb-price">Rp 450.000</span>
          </div>

          <div class="bb-card-body">
            <h3 class="bb-card-title">Paket Camp Chill</h3>
            <ul class="bb-list">
              <li>Venue Bambu Area (Tenda 3 Orang)</li>
              <li>Sarapan, Snack, Teh, Kopi, Air isi ulang</li>
              <li>Bantal dan Matras</li>
              <li>Free Ticket Wisata</li>
            </ul>

            <div class="bb-card-foot">
              <a href="#" class="bb-detail">Detail Paket</a>
            </div>
          </div>
        </article>

        {{-- Card 2 --}}
        <article class="bb-card">
          <div class="bb-card-media">
            <img src="aset/gambarPaket/edukasi.jpeg" alt="Paket Edukasi Bambu">
            <div class="bb-card-overlay"></div>
            <span class="bb-price">Rp 60.000</span>
          </div>

          <div class="bb-card-body">
            <h3 class="bb-card-title">Paket Edukasi Bambu</h3>
            <ul class="bb-list">
              <li>Kunjungan ke area bambu</li>
              <li>Pengenalan jenis-jenis bambu</li>
              <li>Pendamping lokal dari Bhumi Bambu</li>
              <li>Snack & minuman</li>
            </ul>

            <div class="bb-card-foot">
              <a href="#" class="bb-detail">Detail Paket</a>
            </div>
          </div>
        </article>

        {{-- Card 3 --}}
        <article class="bb-card">
          <div class="bb-card-media">
            <img src="aset/gambarPaket/outbound.jpg" alt="Paket Outbound Basic">
            <div class="bb-card-overlay"></div>
            <span class="bb-price">Rp 250.000</span>
          </div>

          <div class="bb-card-body">
            <h3 class="bb-card-title">Paket Outbound Basic</h3>
            <ul class="bb-list">
              <li>Area outbound</li>
              <li>Peralatan outbound</li>
              <li>Makan siang + air mineral</li>
              <li>Minimal peserta: 20 orang</li>
            </ul>

            <div class="bb-card-foot">
              <a href="#" class="bb-detail">Detail Paket</a>
            </div>
          </div>
        </article>

        {{-- Card 4 --}}
        <article class="bb-card">
          <div class="bb-card-media">
            <img src="aset/gambarPaket/gambar.jpg" alt="Paket Camp Explore">
            <div class="bb-card-overlay"></div>
            <span class="bb-price">Rp 350.000</span>
          </div>

          <div class="bb-card-body">
            <h3 class="bb-card-title">Paket Camp Explore</h3>
            <ul class="bb-list">
              <li>Tenda Dome (2 orang/tenda)</li>
              <li>Matras + bantal</li>
              <li>Free ticket wisata</li>
              <li>Mini BBQ Set (per tenda)</li>
            </ul>

            <div class="bb-card-foot">
              <a href="#" class="bb-detail">Detail Paket</a>
            </div>
          </div>
        </article>

      </div>

    </div>
  </section>

  {{-- FEEDBACK SECTION --}}
  <section class="bb-feedback" style="padding-bottom: 60px;">
    <div class="bb-container">
      
      <div class="bb-paket-head" style="margin-bottom: 24px;">
        <div>
          <h2 class="bb-paket-title">Ulasan Pengunjung</h2>
          <p class="bb-paket-sub">Apa kata mereka tentang pengalaman berkunjung ke Bhumi Bambu</p>
        </div>
        <a class="bb-paket-more" href="{{ route('feedback.index') }}">
          Kelola ulasan
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>

      {{-- My Feedback Actions (CRUD) --}}
      <div class="my-feedback-panel">
        @if($myFeedback)
          <div class="my-fb-box">
            <div class="my-fb-info">
              <span class="my-fb-badge">Ulasan Anda</span>
              <div class="my-fb-stars">
                @for($i = 1; $i <= 5; $i++)
                  <span class="star-mini {{ $i <= $myFeedback->rating ? 'filled' : '' }}">★</span>
                @endfor
              </div>
              <h4 class="my-fb-title">{{ $myFeedback->judul }}</h4>
              <p class="my-fb-text">"{{ Str::limit($myFeedback->komentar, 120) }}"</p>
            </div>
            <div class="my-fb-actions">
              <a href="{{ route('feedback.show', $myFeedback->id) }}" class="bb-btn-mini outline">
                <i class="far fa-eye"></i> Lihat
              </a>
              <a href="{{ route('feedback.edit', $myFeedback->id) }}" class="bb-btn-mini edit">
                <i class="far fa-edit"></i> Edit
              </a>
              <form action="{{ route('feedback.destroy', $myFeedback->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus feedback Anda?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bb-btn-mini delete">
                  <i class="far fa-trash-alt"></i> Hapus
                </button>
              </form>
            </div>
          </div>
        @else
          <div class="my-fb-empty">
            <div class="empty-fb-text">
              <h4>Bagikan Pengalaman Anda</h4>
              <p>Anda belum memberikan feedback. Berikan penilaian untuk kunjungan Anda.</p>
            </div>
            <a href="{{ route('feedback.create') }}" class="bb-btn-mini create-new">
              <i class="far fa-comment-dots" style="margin-right: 6px;"></i> Tulis Feedback
            </a>
          </div>
        @endif
      </div>

      {{-- Recent Feedbacks Grid --}}
      <div class="fb-scroll-grid">
        @if($feedbacks->isEmpty())
          <div class="fb-empty-state">Belum ada ulasan dari pengunjung lain.</div>
        @else
          @foreach($feedbacks as $fb)
            @if(!$myFeedback || $fb->id !== $myFeedback->id)
              <div class="fb-item-card">
                <div class="fb-item-head">
                  <div class="fb-avatar">{{ strtoupper(substr($fb->user->nama_user ?? 'U', 0, 1)) }}</div>
                  <div>
                    <h5 class="fb-author-name">{{ $fb->user->nama_user ?? 'Pelanggan' }}</h5>
                    <span class="fb-item-date">{{ \Carbon\Carbon::parse($fb->tanggal_feedback)->format('d M Y') }}</span>
                  </div>
                </div>
                <div class="fb-item-rating">
                  @for($i = 1; $i <= 5; $i++)
                    <span class="star-mini {{ $i <= $fb->rating ? 'filled' : '' }}">★</span>
                  @endfor
                </div>
                <h6 class="fb-item-title">{{ $fb->judul }}</h6>
                <p class="fb-item-comment">"{{ Str::limit($fb->komentar, 90) }}"</p>
              </div>
            @endif
          @endforeach
        @endif
      </div>

    </div>
  </section>

</div>


<style>
  :root{
    --green: #2d5530;
    --green-light: #3d6a40;
    --cream: #f8f6f1;
    --card: #ffffff;

    --text: #1a1a1a;
    --text-secondary: #4a5568;
    --muted: #718096;
    --line: rgba(0,0,0,.06);

    --orange: #f6a01a;
    --orange-dark: #e89410;
    --orangeText: #8b4d00;

    --shadow-sm: 0 2px 8px rgba(0,0,0,.04);
    --shadow: 0 4px 16px rgba(0,0,0,.06);
    --shadow-lg: 0 8px 24px rgba(0,0,0,.08);
    --shadow-xl: 0 12px 32px rgba(0,0,0,.12);
    
    --radius: 14px;
    --radius-sm: 10px;
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .bb-page{
    font-family: "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    background: var(--cream);
    min-height: 100vh;
  }

  .bb-container{
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 20px;
  }

  /* ===== HERO ===== */
  .bb-hero{
    background: linear-gradient(--cream, #ffffff 0%, #fafafa 100%);
    color: var(--text);
    padding: 36px 0 40px;
    border-bottom: 1px solid var(--line);
    margin-bottom: 48px;
  }

  .bb-hero-inner{
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 32px;
  }

  .bb-hero-label{
    display: inline-block;
    background: rgba(45, 85, 48, 0.08);
    border: 1px solid rgba(45, 85, 48, 0.12);
    color: var(--green);
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 14px;
    letter-spacing: 0.02em;
  }

  .bb-hero-title{
    margin: 0 0 12px;
    font-size: 1.45rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    color: var(--text);
    line-height: 1.2;
  }

  .bb-hero-sub{
    margin: 0;
    color: var(--text-secondary);
    font-size: 0.92rem;
    font-weight: 500;
    line-height: 1.7;
    max-width: 520px;
  }

  .bb-hero-cta{
    background: var(--green);
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.95rem;
    padding: 0.7rem 1.1rem;
    border-radius: 10px;
    box-shadow: var(--shadow-lg);
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
  }

  .bb-hero-cta:hover{
    background: var(--green-light);
    box-shadow: var(--shadow-xl);
    transform: translateY(-2px);
  }

  .bb-hero-cta:active{
    transform: translateY(0);
  }

  /* ===== PAKET ===== */
  .bb-paket{
    background: var(--cream);
    padding: 0 0 52px;
  }

  .bb-paket-head{
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 16px;
    margin-bottom: 16px;
  }

  .bb-paket-title{
    margin: 0 0 6px;
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--text);
    letter-spacing: -0.01em;
  }

  .bb-paket-sub{
    margin: 0;
    color: var(--muted);
    font-weight: 500;
    font-size: 0.9rem;
    line-height: 1.5;
  }

  .bb-paket-more{
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 999px;
    padding: 0.55rem 0.9rem;
    color: var(--text);
    text-decoration: none;
    font-weight: 700;
    font-size: 0.9rem;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    box-shadow: var(--shadow-sm);
  }

  .bb-paket-more:hover{
    background: var(--green);
    color: #fff;
    border-color: var(--green);
    box-shadow: var(--shadow);
  }

  /* ===== GRID ===== */
  .bb-grid{
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
  }

  .bb-card{
    background: var(--card);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--line);
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .bb-card:hover{
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
    border-color: rgba(45, 85, 48, 0.15);
  }

  .bb-card-media{
    position: relative;
    height: 145px;
    overflow: hidden;
    background: linear-gradient(135deg, #e9e5dc 0%, #d4cfc4 100%);
  }

  .bb-card-media img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .bb-card:hover .bb-card-media img{
    transform: scale(1.08);
  }

  .bb-card-overlay{
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
  }

  .bb-card:hover .bb-card-overlay{
    opacity: 1;
  }

  .bb-price{
    position: absolute;
    left: 10px;
    bottom: 10px;
    background: linear-gradient(135deg, var(--orange) 0%, var(--orange-dark) 100%);
    color: #fff;
    font-weight: 800;
    font-size: 0.82rem;
    padding: 0.28rem 0.6rem;
    border-radius: 999px;
    box-shadow: 0 4px 12px rgba(246, 160, 26, 0.4);
    letter-spacing: -0.01em;
  }

  .bb-card-body{
    padding: 12px 12px 14px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .bb-card-title{
    margin: 2px 0 8px;
    font-size: 1rem;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -0.01em;
    line-height: 1.3;
  }

  .bb-list{
    margin: 0;
    padding-left: 16px;
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.82rem;
    line-height: 1.5;
    flex: 1;
  }

  .bb-list li{ 
    margin: 2px 0;
  }

  .bb-list li::marker{
    color: var(--orange);
  }

  .bb-card-foot{
    margin-top: auto;
    display: flex;
    justify-content: flex-end;
    padding-top: 12px;
    border-top: 1px solid rgba(0,0,0,0.05);
  }

  .bb-detail{
    background: linear-gradient(135deg, rgba(246,160,26,0.12) 0%, rgba(246,160,26,0.08) 100%);
    color: var(--orangeText);
    text-decoration: none;
    font-weight: 700;
    font-size: 0.78rem;
    padding: 0.42rem 0.78rem;
    border-radius: 999px;
    border: 1px solid rgba(246,160,26,0.2);
    transition: all 0.2s ease;
    display: inline-block;
  }

  .bb-detail:hover{
    background: var(--orange);
    color: #fff;
    border-color: var(--orange);
    box-shadow: 0 4px 12px rgba(246, 160, 26, 0.3);
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px){
    .bb-grid{ 
      grid-template-columns: repeat(2, minmax(0, 1fr)); 
      gap: 16px;
    }
    
    .bb-paket-title{ font-size: 1.35rem; }
    .bb-hero-title{ font-size: 1.45rem; }
  }

  @media (max-width: 768px){
    .bb-container{ padding: 0 16px; }
    
    .bb-hero{ 
      padding: 20px 0 22px; 
      margin-bottom: 28px;
    }
    
    .bb-hero-inner{ 
      flex-direction: column; 
      align-items: flex-start; 
    }
    
    .bb-hero-cta{ 
      width: 100%; 
      justify-content: center;
      margin-top: 8px; 
    }
    
    .bb-hero-title{ font-size: 1.45rem; }
    .bb-hero-sub{ font-size: 0.92rem; }

    .bb-paket{ padding: 0 0 52px; }
    
    .bb-paket-head{
      flex-direction: column;
      align-items: flex-start;
      margin-bottom: 16px;
    }
    
    .bb-paket-title{ font-size: 1.35rem; }

    .bb-grid{
      grid-template-columns: unset;
      grid-auto-flow: column;
      grid-auto-columns: 86%;
      overflow-x: auto;
      gap: 14px;
      padding-bottom: 8px;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }
    
    .bb-grid::-webkit-scrollbar{
      display: none;
    }
    
    .bb-card{ 
      scroll-snap-align: start;
      min-width: 280px;
    }
    
    .bb-card-media{ height: 145px; }
  }

  /* ===== FEEDBACK SECTION STYLES ===== */
  .my-feedback-panel {
    margin-bottom: 32px;
  }
  
  .my-fb-box {
    background: #fff;
    border: 1px solid rgba(45, 85, 48, 0.15);
    border-left: 4px solid var(--green);
    border-radius: 12px;
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    box-shadow: var(--shadow);
  }

  .my-fb-info {
    flex: 1;
  }

  .my-fb-badge {
    display: inline-block;
    background: rgba(45, 85, 48, 0.08);
    color: var(--green);
    font-size: 0.72rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 4px;
    margin-bottom: 8px;
    text-transform: uppercase;
  }

  .my-fb-stars, .fb-item-rating {
    display: flex;
    gap: 2px;
    margin-bottom: 6px;
  }

  .star-mini {
    font-size: 0.95rem;
    color: #d1d5db;
  }

  .star-mini.filled {
    color: #f59e0b;
  }

  .my-fb-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 4px;
  }

  .my-fb-text {
    font-size: 0.82rem;
    color: var(--text-secondary);
    font-style: italic;
    line-height: 1.5;
  }

  .my-fb-actions {
    display: flex;
    gap: 8px;
  }

  .bb-btn-mini {
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    border: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s;
  }

  .bb-btn-mini.outline {
    background: #f3f4f6;
    color: var(--text-secondary);
  }

  .bb-btn-mini.outline:hover {
    background: #e5e7eb;
  }

  .bb-btn-mini.edit {
    background: rgba(246, 160, 26, 0.1);
    color: var(--orangeText);
    border: 1px solid rgba(246, 160, 26, 0.2);
  }

  .bb-btn-mini.edit:hover {
    background: var(--orange);
    color: white;
  }

  .bb-btn-mini.delete {
    background: rgba(239, 68, 68, 0.08);
    color: #dc2626;
    border: 1px solid rgba(239, 68, 68, 0.15);
  }

  .bb-btn-mini.delete:hover {
    background: #dc2626;
    color: white;
  }

  .my-fb-empty {
    background: #fff;
    border: 1.5px dashed rgba(45, 85, 48, 0.2);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: var(--shadow-sm);
  }

  .empty-fb-icon {
    font-size: 1.8rem;
  }

  .empty-fb-text {
    flex: 1;
  }

  .empty-fb-text h4 {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 2px;
  }

  .empty-fb-text p {
    font-size: 0.8rem;
    color: var(--muted);
  }

  .bb-btn-mini.create-new {
    background: var(--green);
    color: white;
    padding: 10px 18px;
  }

  .bb-btn-mini.create-new:hover {
    background: var(--green-light);
    transform: translateY(-1px);
  }

  /* Recent Feedbacks List */
  .fb-scroll-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
  }

  .fb-item-card {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 10px;
    padding: 16px;
    box-shadow: var(--shadow-sm);
    display: flex;
    flex-direction: column;
    transition: all 0.2s;
  }

  .fb-item-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
    border-color: rgba(45, 85, 48, 0.1);
  }

  .fb-item-head {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
  }

  .fb-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--green);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
  }

  .fb-author-name {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--text);
    margin: 0;
  }

  .fb-item-date {
    font-size: 0.7rem;
    color: var(--muted);
  }

  .fb-item-title {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 4px;
    margin-top: 6px;
  }

  .fb-item-comment {
    font-size: 0.8rem;
    color: var(--text-secondary);
    font-style: italic;
    line-height: 1.4;
  }

  .fb-empty-state {
    grid-column: span 3;
    text-align: center;
    padding: 32px;
    color: var(--muted);
    font-size: 0.85rem;
  }

  @media (max-width: 900px) {
    .fb-scroll-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }

  @media (max-width: 600px) {
    .my-fb-box {
      flex-direction: column;
      align-items: flex-start;
      gap: 14px;
    }
    .my-fb-actions {
      width: 100%;
      display: flex;
    }
    .my-fb-actions .bb-btn-mini {
      flex: 1;
      justify-content: center;
    }
    .my-fb-empty {
      flex-direction: column;
      align-items: stretch;
      text-align: center;
      gap: 12px;
    }
    .fb-scroll-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

@endsection