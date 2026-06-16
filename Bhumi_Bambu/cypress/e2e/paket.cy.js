describe('CRUD Paket Layanan', () => {

  beforeEach(() => {
    // Login
    cy.visit('http://127.0.0.1:8000/login')

    cy.get('input[name="email"]').type('ghefirameyta@gmail.com')
    cy.get('input[name="password"]').type('password123')
    cy.get('button[type="submit"]').click()

    cy.url().should('not.include', '/login')

    // Masuk halaman paket layanan
    cy.visit('http://127.0.0.1:8000/admin/paket-layanan')
    cy.get('table').should('be.visible')
  })

  const namaPaket = 'Paket Bumbi'

  // ======================
  // CREATE
  // ======================
  it('Create Paket Layanan', () => {
    cy.contains('Tambah Paket').click()

    cy.get('input[name="nama_paket"]').type(namaPaket)
    cy.get('input[name="venue"]').type('Venue Test')
    cy.get('input[name="harga"]').type('200000')
    cy.get('input[name="kapasitas"]').type('10')
    cy.get('textarea[name="fasilitas"]').type('Tenda, Kursi')
    cy.get('textarea[name="deskripsi"]').type('Deskripsi test')
    cy.get('input[name="gambar_venue"]').selectFile('cypress/fixtures/gambar.jpg')

    cy.contains('Simpan').click()

    cy.contains('berhasil').should('exist')
  })

  // ======================
  // READ
  // ======================
  it('Read / Search Paket', () => {
    cy.get('#searchPaket').type(namaPaket)

    cy.contains('tbody tr', namaPaket)
      .should('be.visible')
  })

  it('Detail Paket (Edit Page)', () => {
    cy.contains('tbody tr', namaPaket)
      .find('a[title="Edit"]')
      .click()

    cy.url().should('include', '/edit')

    cy.get('input[name="nama_paket"]')
      .should('have.value', namaPaket)
  })

  // ======================
  // UPDATE
  // ======================
  it('Update Paket Layanan', () => {
    cy.contains('tbody tr', namaPaket)
      .find('a[title="Edit"]')
      .click()

    cy.url().should('include', '/edit')

    cy.get('input[name="harga"]').clear().type('300000')

    cy.contains('button', 'Update Paket').click()

    cy.url().should('include', '/admin/paket-layanan')
    cy.contains('Sukses').should('exist')
  })

  it('Validasi Update Gagal', () => {
    cy.contains('tbody tr', namaPaket)
      .find('a[title="Edit"]')
      .click()

    cy.get('input[name="nama_paket"]').clear()

    cy.contains('button', 'Update Paket').click()

    cy.url().should('include', '/edit')
  })

  // ======================
  // DELETE
  // ======================
  it('Delete Paket Layanan', () => {

    cy.contains('tbody tr', namaPaket)
      .within(() => {

        cy.get('strong')
          .invoke('text')
          .then((textNama) => {

            cy.on('window:confirm', () => true)

            cy.get('button[title="Hapus"]').click()

            cy.contains('strong', textNama)
              .should('not.exist')
          })
      })
  })
})