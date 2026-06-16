@extends('layout.app')
@section('title', 'Detail Feedback')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="res-page" style="padding-top: 40px;">
  <div class="res-container">
    
    <div class="form-wrapper">
      
      <div class="form-header">
        <a href="{{ route('feedback.index') }}" class="back-btn-round">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
        </a>
        <div class="header-text">
          <h2>Detail Feedback Anda</h2>
          <p>Ulasan yang Anda sampaikan pada tanggal {{ \Carbon\Carbon::parse($feedback->tanggal_feedback)->format('d F Y') }}</p>
        </div>
      </div>

      <div class="form-card-container">
        
        <div class="detail-top-info" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); padding-bottom: 20px; margin-bottom: 24px;">
          <div class="user-profile-tag" style="display: flex; align-items: center; gap: 12px;">
            <div class="user-avatar" style="width: 44px; height: 44px; border-radius: 50%; background: var(--green); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.1rem;">
              {{ strtoupper(substr(auth()->user()->nama_user ?? 'U', 0, 1)) }}
            </div>
            <div>
              <h4 style="font-size: 0.95rem; font-weight: 700; color: var(--text); margin: 0;">{{ auth()->user()->nama_user ?? 'User Pelanggan' }}</h4>
              <span style="font-size: 0.78rem; color: var(--text-muted); font-weight: 500;">Pelanggan Terverifikasi</span>
            </div>
          </div>

          <div class="rating-display-badge" style="background: rgba(246, 160, 26, 0.08); border: 1.5px solid rgba(246, 160, 26, 0.2); padding: 8px 16px; border-radius: 10px; display: flex; align-items: center; gap: 6px;">
            <div style="display: flex; gap: 2px;">
              @for($i = 1; $i <= 5; $i++)
                <span style="color: {{ $i <= $feedback->rating ? '#f6a01a' : '#cbd5e1' }}; font-size: 1rem;">★</span>
              @endfor
            </div>
            <strong style="font-size: 0.9rem; color: var(--orange); margin-left: 4px;">{{ $feedback->rating }}.0</strong>
          </div>
        </div>

        <div class="feedback-main-content">
          <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text); margin-bottom: 16px; line-height: 1.4;">
            {{ $feedback->judul }}
          </h3>
          
          <div class="feedback-quote-box" style="background: #fafaf9; border-left: 4px solid var(--green); padding: 24px; border-radius: 4px 12px 12px 4px; margin-bottom: 32px; border-top: 1px solid var(--border); border-right: 1px solid var(--border); border-bottom: 1px solid var(--border);">
            <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7; font-style: italic; margin: 0;">
              "{{ $feedback->komentar }}"
            </p>
          </div>
        </div>

        <div class="form-footer-actions">
          <a href="{{ route('feedback.index') }}" class="form-btn-cancel">Kembali</a>
          <a href="{{ route('feedback.edit', $feedback->id) }}" class="form-btn-submit" style="background: var(--orange); box-shadow: 0 4px 12px rgba(246, 160, 26, 0.15); text-decoration: none;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
              <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
            </svg>
            Edit Ulasan
          </a>
          <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="card-btn danger" style="padding: 12px 20px; border-radius: 10px; font-weight: 700; font-size: 0.9rem;">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
              </svg>
              Hapus
            </button>
          </form>
        </div>

      </div>

    </div>

  </div>
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
    --shadow: 0 4px 16px rgba(0,0,0,.05);
    --shadow-lg: 0 8px 32px rgba(45,85,48,0.06);
  }

  .res-page {
    font-family: "Poppins", system-ui, -apple-system, sans-serif;
    background: var(--cream);
    min-height: 100vh;
    padding-bottom: 80px;
  }

  .res-container {
    max-width: 720px;
    margin: 0 auto;
    padding: 0 24px;
  }

  /* Header */
  .form-wrapper {
    display: flex;
    flex-direction: column;
    gap: 28px;
  }

  .form-header {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .back-btn-round {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--white);
    border: 1px solid var(--border);
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: var(--shadow);
  }

  .back-btn-round:hover {
    background: var(--green);
    color: var(--white);
    border-color: var(--green);
    transform: translateX(-3px);
  }

  .header-text h2 {
    font-size: 1.45rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 4px;
    letter-spacing: -0.01em;
  }

  .header-text p {
    font-size: 0.88rem;
    color: var(--text-secondary);
    line-height: 1.5;
  }

  /* Card Container */
  .form-card-container {
    background: var(--white);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-lg);
    padding: 32px;
  }

  /* Actions */
  .form-footer-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 14px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
  }

  .form-btn-cancel {
    padding: 12px 24px;
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-decoration: none;
    background: #f1f5f9;
    border-radius: 10px;
    transition: background 0.2s;
  }

  .form-btn-cancel:hover {
    background: #e2e8f0;
  }

  .form-btn-submit {
    padding: 12px 28px;
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--white);
    background: var(--green);
    border: none;
    border-radius: 10px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
  }

  .form-btn-submit:hover {
    background: var(--green-light);
    transform: translateY(-2px);
  }

  .card-btn.danger {
    background: rgba(239, 68, 68, 0.08);
    color: #dc2626;
    border: 1px solid rgba(239, 68, 68, 0.15);
    display: inline-flex;
    align-items: center;
    cursor: pointer;
  }

  .card-btn.danger:hover {
    background: #dc2626;
    color: white;
  }

  @media (max-width: 600px) {
    .form-card-container {
      padding: 20px;
    }
    .form-footer-actions {
      flex-direction: column-reverse;
      gap: 10px;
    }
    .form-btn-cancel, .form-btn-submit, .card-btn.danger {
      width: 100%;
      text-align: center;
      justify-content: center;
    }
  }
</style>
@endsection