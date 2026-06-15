describe('Create Paket Layanan', () => {
  it('Berhasil menambahkan paket layanan dengan data valid', () => {

    cy.visit('http://127.0.0.1:8000/login')

    cy.get('input[name="email"]').type('ghefirameyta@gmail.com')
    cy.get('input[name="password"]').type('password123')

    cy.get('button[type="submit"]').click()

    cy.url().should('include', '/dashboard') 

    cy.visit('http://127.0.0.1:8000/admin/paket-layanan')

    cy.contains('Tambah Paket').click()

    cy.get('input[name="nama_paket"]').type('Paket Bambu Runcing')
    cy.get('input[name="venue"]').type('Venue Bhumi')
    cy.get('input[name="harga"]').type('200000')
    cy.get('input[name="kapasitas"]').type(10)
    cy.get('textarea[name="fasilitas"]').type('Tenda, Apa, Itu')
    cy.get('textarea[name="deskripsi"]').type('Deskripsi paket test')
    cy.get('input[name="gambar_venue"]').selectFile('cypress/fixtures/gambar.jpg')

    cy.contains('Simpan').click()

    cy.contains('berhasil').should('exist')
  })
})