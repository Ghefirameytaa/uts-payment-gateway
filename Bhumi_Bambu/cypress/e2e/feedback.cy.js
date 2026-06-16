describe('Testing Fitur Feedback Pelanggan - Bhumi Bambu Baturraden', () => {
  // SILAKAN SESUAIKAN URL LOCALHOST BERIKUT DENGAN PORT SERVER ANDA
  const baseUrl = 'http://localhost:8000'; 
  const emailPelanggan = 'farahrizkipermatasari@gmail.com';
  const passwordPelanggan = 'password123';

  beforeEach(() => {
    // Kunjungi halaman login sebelum setiap test case
    cy.visit(`${baseUrl}/login`);
  });

  // Helper function untuk mempermudah login
  const loginPelanggan = () => {
    cy.get('input[name="email"]').type(emailPelanggan);
    cy.get('input[name="password"]').type(passwordPelanggan);
    cy.get('.login-button').click();
  };

  // ==========================================
  // TS-F-01: LOGIN PELANGGAN
  // ==========================================
  it('TC-F-01-01: Login dengan kredensial valid', () => {
    loginPelanggan();
    
    // Harus redirect ke beranda dan menampilkan profil user
    cy.url().should('include', '/beranda');
  });

  // ==========================================
  // TS-F-02: CREATE FEEDBACK
  // ==========================================
  it('TC-F-02-02: Menulis feedback dengan field kosong (Negative Test)', () => {
    loginPelanggan();

    // Navigasi ke Halaman Feedback
    cy.visit(`${baseUrl}/feedback/create`);

    // Klik kirim tanpa mengisi apapun (menggunakan form submit)
    cy.get('form.native-form').submit();

    // Pastikan validasi HTML5 bawaan atau pesan error Laravel bekerja
    cy.get('input[name="judul"]').then(($el) => {
      expect($el[0].checkValidity()).to.be.false;
    });
  });

  it('TC-F-02-01: Menulis feedback baru dengan data valid (Positive Test)', () => {
    loginPelanggan();

    // Navigasi ke Halaman Tambah Feedback
    cy.visit(`${baseUrl}/feedback/create`);

    // Isi Form
    const judulUlasan = 'Fasilitas Sangat Lengkap dan Asri - ' + Date.now();
    cy.get('input[name="judul"]').type(judulUlasan);
    
    // Pilih Rating Bintang 5
    cy.get('.rating-star-btn').eq(4).click();
    
    // Isi Komentar
    cy.get('textarea[name="komentar"]').type('Pengalaman berkemah yang sangat luar biasa di Bhumi Bambu Baturraden. Kamar mandi bersih, area camp luas, dan pemandangan hutan bambu sangat indah.');
    
    // Submit Form
    cy.get('form.native-form').submit();

    // Verifikasi sukses redirect dan flash message
    cy.url().should('include', '/feedback');
    cy.get('.flash-success').should('be.visible').and('contain', 'Feedback berhasil dikirim');

    // Verifikasi feedback baru tampil di daftar
    cy.get('.reservasi-card').first().within(() => {
      cy.get('h3').should('contain', judulUlasan);
    });
  });

  // ==========================================
  // TS-F-03: READ FEEDBACK
  // ==========================================
  it('TC-F-03-01 & TC-F-03-02: Melihat daftar dan detail ulasan lengkap', () => {
    loginPelanggan();

    // Navigasi ke daftar feedback
    cy.visit(`${baseUrl}/feedback`);

    // Pastikan kartu ulasan tampil
    cy.get('.reservasi-card').should('have.length.at.least', 1);

    // Klik tombol detail pada item pertama
    cy.get('.reservasi-card').first().within(() => {
      cy.contains('Detail').click();
    });

    // Verifikasi di halaman detail
    cy.url().should('match', /\/feedback\/\d+/);
    cy.get('.feedback-main-content').should('be.visible');
    cy.get('.rating-display-badge').should('be.visible');
  });

  // ==========================================
  // TS-F-04: UPDATE FEEDBACK
  // ==========================================
  it('TC-F-04-01: Mengedit feedback yang sudah ada', () => {
    loginPelanggan();

    // Navigasi ke daftar feedback
    cy.visit(`${baseUrl}/feedback`);

    // Klik Edit pada item pertama
    cy.get('.reservasi-card').first().within(() => {
      cy.contains('Edit').click();
    });

    // Verifikasi masuk ke halaman edit
    cy.url().should('include', '/edit');

    // Update Form
    const judulBaru = 'Sangat Direkomendasikan! - ' + Date.now();
    cy.get('input[name="judul"]').clear().type(judulBaru);
    cy.get('.rating-star-btn').eq(3).click(); // ubah rating jadi bintang 4
    cy.get('textarea[name="komentar"]').clear().type('Ulasan diperbarui: Fasilitas sangat bagus dan suasana sejuk.');

    // Simpan Perubahan
    cy.get('form.native-form').submit();

    // Verifikasi sukses update
    cy.url().should('include', '/feedback');
    cy.get('.flash-success').should('be.visible').and('contain', 'Feedback berhasil diperbarui');
  });

  // ==========================================
  // TS-F-05: DELETE FEEDBACK
  // ==========================================
  it('TC-F-05-01: Menghapus feedback dari daftar', () => {
    loginPelanggan();

    // Navigasi ke daftar feedback
    cy.visit(`${baseUrl}/feedback`);

    // Hitung jumlah kartu awal
    cy.get('.reservasi-card').then(($cards) => {
      const initialCount = $cards.length;

      // Klik tombol Hapus pada item pertama (ikon sampah)
      cy.get('.reservasi-card').first().within(() => {
        cy.get('form').submit(); // Memicu form submit untuk delete
      });

      // Verifikasi sukses delete
      cy.get('.flash-success').should('be.visible').and('contain', 'Feedback berhasil dihapus');

      // Pastikan jumlah kartu berkurang atau menampilkan empty state
      if (initialCount > 1) {
        cy.get('.reservasi-card').should('have.length', initialCount - 1);
      } else {
        cy.get('.empty-state').should('be.visible');
      }
    });
  });
});