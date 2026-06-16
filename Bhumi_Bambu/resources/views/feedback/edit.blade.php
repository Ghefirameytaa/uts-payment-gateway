@extends('layout.app')
@section('title', 'Edit Feedback')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="res-page" style="padding-top: 40px;">
  <div class="res-container">
    
    <div class="form-wrapper">
      
      <div class="form-header">
        <a href="{{ route('feedback.show', $feedback->id) }}" class="back-btn-round">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
        </a>
        <div class="header-text">
          <h2>Perbarui Feedback Anda</h2>
          <p>Ubah ulasan lama Anda agar sesuai dengan pengalaman terbaru Anda</p>
        </div>
      </div>

      <div class="form-card-container">
        @if($errors->any())
          <div class="error-wrapper">
            <div class="error-header">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
              </svg>
              <span>Mohon periksa inputan Anda:</span>
            </div>
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('feedback.update', $feedback->id) }}" method="POST" class="native-form">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="judul" class="form-label">Judul Ulasan <span class="required">*</span></label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $feedback->judul) }}" class="form-input" placeholder="Contoh: Pengalaman Berkemah yang Berkesan" required>
            <span class="form-hint">Buat judul ringkas yang menggambarkan ulasan Anda.</span>
          </div>

          <div class="form-group">
            <label class="form-label">Berikan Penilaian Anda <span class="required">*</span></label>
            <div class="rating-box">
              <div class="rating-stars" id="starContainer">
                @for($i = 1; $i <= 5; $i++)
                  <span class="rating-star-btn" data-value="{{ $i }}" onclick="selectRating({{ $i }})">★</span>
                @endfor
              </div>
              <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating', $feedback->rating) }}" required>
              <div class="rating-helper" id="ratingTextHelper">Pilih bintang untuk memberikan rating</div>
            </div>
          </div>

          <div class="form-group">
            <label for="komentar" class="form-label">Komentar & Cerita Anda <span class="required">*</span></label>
            <textarea id="komentar" name="komentar" rows="6" class="form-textarea" placeholder="Tuliskan pengalaman Anda secara jujur selama berada di Bhumi Bambu Baturraden..." required>{{ old('komentar', $feedback->komentar) }}</textarea>
            <div class="textarea-footer">
              <span class="form-hint">Ceritakan detail layanan, fasilitas, maupun suasana alam.</span>
              <span class="char-counter"><span id="charNum">0</span>/1000</span>
            </div>
          </div>

          <div class="form-footer-actions">
            <a href="{{ route('feedback.show', $feedback->id) }}" class="form-btn-cancel">Batal</a>
            <button type="submit" class="form-btn-submit">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
              Simpan Perubahan
            </button>
          </div>

        </form>
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

  /* Form Header */
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

  /* Form Card Container */
  .form-card-container {
    background: var(--white);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-lg);
    padding: 32px;
  }

  .native-form {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  /* Form Groups */
  .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .form-label {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--text);
  }

  .required {
    color: #ef4444;
  }

  .form-hint {
    font-size: 0.78rem;
    color: var(--text-muted);
  }

  .form-input, .form-textarea {
    width: 100%;
    font-family: inherit;
    font-size: 0.9rem;
    padding: 12px 16px;
    border-radius: 10px;
    border: 1.5px solid #e2e8f0;
    background: var(--white);
    color: var(--text);
    transition: all 0.2s ease;
    outline: none;
  }

  .form-input:focus, .form-textarea:focus {
    border-color: var(--green);
    box-shadow: 0 0 0 4px rgba(45, 85, 48, 0.08);
  }

  .form-input::placeholder, .form-textarea::placeholder {
    color: #a0aec0;
  }

  .textarea-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.78rem;
  }

  .char-counter {
    color: var(--text-muted);
    font-weight: 600;
  }

  /* Rating system */
  .rating-box {
    background: #fafaf9;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 16px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
  }

  .rating-stars {
    display: flex;
    gap: 8px;
  }

  .rating-star-btn {
    font-size: 2.2rem;
    color: #cbd5e1;
    cursor: pointer;
    user-select: none;
    transition: all 0.15s ease;
  }

  .rating-star-btn.active, .rating-star-btn:hover {
    color: var(--orange);
    transform: scale(1.15);
  }

  .rating-helper {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--text-secondary);
  }

  /* Actions */
  .form-footer-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 14px;
    padding-top: 12px;
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
    box-shadow: 0 4px 12px rgba(45, 85, 48, 0.15);
  }

  .form-btn-submit:hover {
    background: var(--green-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(45, 85, 48, 0.2);
  }

  /* Errors List */
  .error-wrapper {
    background: rgba(239, 68, 68, 0.04);
    border: 1px solid rgba(239, 68, 68, 0.15);
    border-radius: 10px;
    padding: 16px 20px;
    margin-bottom: 24px;
  }

  .error-header {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #dc2626;
    font-weight: 700;
    font-size: 0.88rem;
    margin-bottom: 10px;
  }

  .error-wrapper ul {
    list-style-type: none;
    padding-left: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .error-wrapper li {
    font-size: 0.82rem;
    color: #dc2626;
    font-weight: 500;
  }

  .error-wrapper li::before {
    content: "•";
    margin-right: 8px;
    font-weight: 700;
  }

  @media (max-width: 600px) {
    .form-card-container {
      padding: 20px;
    }
    .form-footer-actions {
      flex-direction: column;
    }
    .form-btn-cancel, .form-btn-submit {
      width: 100%;
      text-align: center;
      justify-content: center;
    }
  }
</style>

<script>
  const labelsHelper = [
    'Pilih bintang untuk memberikan rating',
    'Buruk sekali 😞',
    'Kurang memuaskan 😕',
    'Cukup baik 😐',
    'Sangat baik 😊',
    'Luar biasa istimewa! 🤩'
  ];

  let currentSelectedRating = parseInt(document.getElementById('ratingValue').value) || 0;

  function selectRating(val) {
    currentSelectedRating = val;
    document.getElementById('ratingValue').value = val;
    document.getElementById('ratingTextHelper').textContent = labelsHelper[val];
    
    document.querySelectorAll('.rating-star-btn').forEach((s, idx) => {
      s.classList.toggle('active', idx < val);
    });
  }

  if (currentSelectedRating > 0) {
    selectRating(currentSelectedRating);
  }

  // Hover animations
  document.querySelectorAll('.rating-star-btn').forEach((s, idx) => {
    s.addEventListener('mouseenter', () => {
      document.querySelectorAll('.rating-star-btn').forEach((star, subIdx) => {
        star.style.color = subIdx <= idx ? '#f6a01a' : '#cbd5e1';
      });
      document.getElementById('ratingTextHelper').textContent = labelsHelper[idx + 1];
    });

    s.addEventListener('mouseleave', () => {
      document.querySelectorAll('.rating-star-btn').forEach(star => {
        star.style.color = '';
      });
      selectRating(currentSelectedRating);
    });
  });

  // TextArea counter
  const textarea = document.getElementById('komentar');
  const countSpan = document.getElementById('charNum');
  
  textarea.addEventListener('input', () => {
    countSpan.textContent = textarea.value.length;
  });
  
  countSpan.textContent = textarea.value.length;
</script>
@endsection