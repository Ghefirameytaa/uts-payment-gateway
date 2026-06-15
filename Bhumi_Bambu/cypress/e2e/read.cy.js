describe('Read Paket Layanan', () => {

  beforeEach(() => {

    // Login
    cy.visit('http://127.0.0.1:8000/login')

    cy.get('input[name="email"]').type('ghefirameyta@gmail.com')
    cy.get('input[name="password"]').type('password123')

    cy.get('button[type="submit"]').click()

    // Pastikan login berhasil
    cy.url().should('not.include', '/login')

    // Masuk ke halaman paket layanan
    cy.visit('http://127.0.0.1:8000/admin/paket-layanan')

    // Pastikan tabel tampil
    cy.get('table').should('be.visible')
  })

  it('Menampilkan data paket tertentu', () => {

    cy.contains('tbody tr', 'Edukasi Bambu')
      .within(() => {
        cy.get('a[title="Edit"]').click()
      })

    cy.url().should('include', '/edit')

    cy.get('input[name="nama_paket"]')
      .should('have.value', 'Paket Edukasi Bambu')
  })

  it('Search paket berfungsi', () => {

    cy.get('#searchPaket')
      .type('Paket Edukasi Bambu')

    cy.contains('tbody tr', 'Edukasi Bambu')
      .should('be.visible')
  })

  it('Search dengan keyword yang tidak ada', () => {

    cy.get('#searchPaket')
      .type('Paket Bumi')

    cy.get('tbody tr:visible')
      .should('have.length', 0)
  })

})