describe('Reservasi E2E - FINAL FIX (AUTO FILL)', () => {

  const baseUrl = 'http://localhost:8000'; 
  const email = 'farahrizkipermatasari@gmail.com';
  const password = 'password123';

  // =============================
  // LOGIN
  // =============================
  const login = () => {
    cy.visit(`${baseUrl}/login`);

    cy.get('input[name="email"]').type(email);
    cy.get('input[name="password"]').type(password);
    cy.get('.login-button').click();

    cy.url().should('include', '/beranda');
  };

  beforeEach(() => {
    login();
  });

  // =============================
  // TC-01: Akses halaman
  // =============================
  it('TC-01: Halaman reservasi tampil', () => {

    cy.visit(`${baseUrl}/reservasi/buat`);

    cy.contains('Buat Reservasi').should('exist');

    // ✅ AUTO FILL FIX (NAMA SUDAH JELAS)
    cy.get('input[name="nama_lengkap"]')
      .should('have.value', 'Jaehyun');

    cy.get('input[name="nomor_ponsel"]')
      .should('have.value', '081234567890');

    cy.get('input[name="email"]')
      .should('have.value', email);

  });

  // =============================
  // TC-02: Submit kosong
  // =============================
  it('TC-02: Submit kosong gagal', () => {

    cy.visit(`${baseUrl}/reservasi/buat`);

    cy.get('button.res-btn-submit').click();

    cy.url().should('include', '/reservasi/buat');

  });

  // =============================
  // TC-03: Invalid jumlah orang
  // =============================
  it('TC-03: jumlah orang 0 gagal', () => {

    cy.visit(`${baseUrl}/reservasi/buat`);

    cy.get('input[name="jumlah_orang"]').clear().type('0');
    cy.get('input[name="jam_acara"]').type('10:00');

    const tgl = new Date();
    tgl.setDate(tgl.getDate() + 1);
    const tanggal = tgl.toISOString().split('T')[0];

    cy.get('input[name="tanggal_reservasi"]').type(tanggal);
    cy.get('select[name="paket_id"]').select('1');

    cy.get('button.res-btn-submit').click();

    cy.url().should('include', '/reservasi/buat');

  });

  // =============================
  // TC-04: SUCCESS FLOW
  // =============================
  it('TC-04: Reservasi berhasil', () => {

    cy.visit(`${baseUrl}/reservasi/buat`);

    // ✅ AUTO FILL VALID
    cy.get('input[name="nama_lengkap"]').should('have.value', 'Jaehyun');
    cy.get('input[name="nomor_ponsel"]').should('have.value', '081234567890');
    cy.get('input[name="email"]').should('have.value', email);

    // INPUT MANUAL
    cy.get('input[name="jumlah_orang"]').clear().type('2');

    const jam = Math.floor(Math.random() * 10) + 8;
    const jamFormat = String(jam).padStart(2, '0') + ':00';
    cy.get('input[name="jam_acara"]').type(jamFormat);

    const tgl = new Date();
    tgl.setDate(tgl.getDate() + 1);
    const tanggal = tgl.toISOString().split('T')[0];

    cy.get('input[name="tanggal_reservasi"]').type(tanggal);

    cy.get('select[name="paket_id"]').select('1');

    cy.get('textarea[name="catatan"]').type('Testing Cypress');

    // SUBMIT
    cy.get('button.res-btn-submit').click();

    // HARUS PINDAH
    cy.url().should('include', '/reservasi/review');

    // CONFIRM
    cy.get('form[action*="confirm"]').submit();

    // PAYMENT
    cy.url().should('include', '/reservasi/payment');
    cy.get('#pay-btn', { timeout: 10000 }).should('exist');
    cy.wait(3000);
    cy.get('#pay-btn').should('be.visible');

  });

  // =============================
  // TC-05: DELETE
  // =============================
  it('TC-05: Hapus reservasi', () => {

    cy.visit(`${baseUrl}/reservasi/saya`);

    cy.get('body').then(($body) => {

      if ($body.find('button.card-btn.danger').length > 0) {

        cy.on('window:confirm', () => true);

        cy.get('button.card-btn.danger').first().click();

        cy.get('#deleteForm').submit();

        cy.contains('berhasil').should('exist');

      } else {
        cy.log('Tidak ada data');
      }

    });

  });

});