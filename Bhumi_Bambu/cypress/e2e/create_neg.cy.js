describe('Create Paket Layanan', () => {
  it('Gagal menambahkan paket layanan', () => {

    cy.visit('http://127.0.0.1:8000/login')

    cy.get('input[name="email"]').type('ghefirameyta@gmail.com')
    cy.get('input[name="password"]').type('password123')

    cy.get('button[type="submit"]').click()

    cy.url().should('include', '/dashboard') 

    cy.visit('http://127.0.0.1:8000/admin/paket-layanan')

    cy.contains('Tambah Paket').click()

    cy.get('input[name="nama_paket"]').type('Paket Bambu Runcing')
    cy.get('input[name="venue"]').type('Venue Bhumi')
    cy.get('input[name="harga"]').type('dua ratus ribu')
    cy.get('input[name="kapasitas"]').type(-10)
    cy.get('textarea[name="fasilitas"]').type('Tenda, Apa, Itu')
    cy.get('textarea[name="deskripsi"]').type('Deskripsi paket test')
     cy.get('input[name="gambar_venue"]').selectFile('cypress/fixtures/gambar.jpg')

    cy.contains('Simpan').click()

    cy.contains('Terjadi kesalahan').should('exist')
    cy.contains('The harga field must be an intege').should('exist')
    cy.contains('The kapasitas field must be at least 1').should('exist')
  })
})