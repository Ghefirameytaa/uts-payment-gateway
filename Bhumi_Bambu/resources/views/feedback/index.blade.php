@extends('layout.app')
@section('title', 'Feedback Saya')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="res-page">

  <section class="res-hero">
    <div class="res-container hero-flex">
      <div>
        <h1 class="res-hero-title">Feedback & Ulasan</h1>
        <p class="res-hero-sub">Daftar ulasan yang telah Anda bagikan untuk Bhumi Bambu Baturraden</p>
      </div>
      <a href="{{ route('feedback.create') }}" class="res-hero-cta">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="5" x2="12" y2="19"></line>
          <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Tulis Feedback Baru
      </a>
    </div>
  </section>

  {{-- Flash Messages --}}
  @if(session('success'))
    <div class="res-container">
      <div class="flash-alert flash-success" id="flashAlert">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flash-icon">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>{{ session('success') }}</span>
        <button class="flash-close" onclick="this.parentElement.remove()">&times;</button>
      </div>
    </div>
  @endif

  <section class="res-list-section">
    <div class="res-container">

      @if($feedbacks->isEmpty())
        <div class="empty-state">
          <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
          </svg>
          <h3>Belum Ada Feedback</h3>
          <p>Ulasan Anda sangat berharga bagi kami. Bagikan pengalaman kunjungan Anda sekarang!</p>
          <a href="{{ route('feedback.create') }}" class="empty-btn">Tulis Feedback Pertama</a>
        </div>
      @else
        <div class="reservasi-grid">
          @foreach($feedbacks as $fb)
          <div class="reservasi-card">
            
            <div class="card-header" style="padding: 16px 20px; background: #fafaf9; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
              <span class="booking-date" style="font-size: 0.78rem; color: var(--text-muted); font-weight: 600;">
                <i class="far fa-calendar-alt" style="margin-right: 6px; color: var(--green);"></i>
                {{ \Carbon\Carbon::parse($fb->tanggal_feedback)->format('d M Y') }}
              </span>
              <div class="stars-rating" style="display: flex; gap: 2px;">
                @for($i = 1; $i <= 5; $i++)
                  <span style="color: {{ $i <= $fb->rating ? '#f6a01a' : '#d1d5db' }}; font-size: 1.1rem;">★</span>
                @endfor
              </div>
            </div>

            <div class="card-body" style="padding: 24px 20px;">
              <h3 style="font-size: 1.05rem; font-weight: 800; color: var(--text); margin-bottom: 10px; line-height: 1.4;">
                {{ $fb->judul }}
              </h3>
              <p style="font-size: 0.88rem; color: var(--text-secondary); line-height: 1.6; font-style: italic; margin-bottom: 0;">
                "{{ Str::limit($fb->komentar, 120) }}"
              </p>
            </div>

            <div class="card-footer" style="padding: 16px 20px; border-top: 1px solid var(--border); display: flex; gap: 10px; background: #fafaf9;">
              <a href="{{ route('feedback.show', $fb->id) }}" class="card-btn secondary" style="flex: 1; text-align: center; justify-content: center;">
                Detail
              </a>
              <a href="{{ route('feedback.edit', $fb->id) }}" class="card-btn secondary" style="flex: 1; text-align: center; justify-content: center; background: rgba(246,160,26,0.08); color: var(--orange); border-color: rgba(246,160,26,0.2);">
                Edit
              </a>
              <form action="{{ route('feedback.destroy', $fb->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="card-btn danger" style="padding: 10px 14px;">
                  <i class="far fa-trash-alt"></i>
                </button>
              </form>
            </div>

          </div>
          @endforeach
        </div>
      @endif

    </div>
  </section>

</div>

<style>
  :root {
    --green: #2d5530;
    --green-light: #3d6a40;
    --cream: #f8f6f1;
    --white: #ffffff;
    --text: #1a1a1a;
    --text-secondary: #4a5568;
    --text-muted: #718096;
    --border: rgba(0,0,0,.08);
    --orange: #f6a01a;
    --shadow: 0 2px 8px rgba(0,0,0,.06);
    --shadow-lg: 0 8px 24px rgba(0,0,0,.08);
  }

  .res-page {
    font-family: "Poppins", system-ui, -apple-system, sans-serif;
    background: var(--cream);
    min-height: 100vh;
    padding-bottom: 60px;
  }

  .res-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  /* Hero */
  .res-hero {
    background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
    padding: 36px 0 40px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 48px;
  }

  .hero-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
  }

  .res-hero-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -0.02em;
    margin-bottom: 8px;
  }

  .res-hero-sub {
    font-size: 0.95rem;
    color: var(--text-secondary);
    font-weight: 500;
  }

  .res-hero-cta {
    background: var(--green);
    color: white;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(45, 85, 48, 0.15);
  }

  .res-hero-cta:hover {
    background: var(--green-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(45, 85, 48, 0.2);
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 80px 20px;
    background: var(--white);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    max-width: 600px;
    margin: 0 auto;
  }

  .empty-state svg {
    margin-bottom: 24px;
  }

  .empty-state h3 {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 12px;
  }

  .empty-state p {
    font-size: 1rem;
    color: var(--text-secondary);
    margin-bottom: 32px;
    line-height: 1.6;
  }

  .empty-btn {
    display: inline-block;
    background: var(--green);
    color: white;
    padding: 14px 32px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .empty-btn:hover {
    background: var(--green-light);
    transform: translateY(-2px);
  }

  /* Reservasi Grid */
  .reservasi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
  }

  .reservasi-card {
    background: var(--white);
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .reservasi-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
  }

  /* Card Buttons */
  .card-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    cursor: pointer;
  }

  .card-btn.secondary {
    background: var(--white);
    color: var(--text-secondary);
    border-color: var(--border);
  }

  .card-btn.secondary:hover {
    background: #f9fafb;
    color: var(--text);
  }

  .card-btn.danger {
    background: rgba(239, 68, 68, 0.08);
    color: #dc2626;
    border-color: rgba(239, 68, 68, 0.15);
  }

  .card-btn.danger:hover {
    background: #dc2626;
    color: white;
  }

  /* Alerts */
  .flash-alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 28px;
    border: 1px solid transparent;
  }

  .flash-success {
    background: rgba(16, 185, 129, 0.08);
    color: #065f46;
    border-color: rgba(16, 185, 129, 0.2);
  }

  .flash-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
    transition: opacity 0.2s;
  }

  .flash-close:hover {
    opacity: 1;
  }

  @media (max-width: 768px) {
    .hero-flex {
      flex-direction: column;
      align-items: flex-start;
    }
    .res-hero-cta {
      width: 100%;
      justify-content: center;
    }
    .reservasi-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<script>
  setTimeout(() => {
    const alert = document.getElementById('flashAlert');
    if (alert) {
      alert.style.transition = 'opacity 0.5s ease';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }
  }, 4000);
</script>
@endsection