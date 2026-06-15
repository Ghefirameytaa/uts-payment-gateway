describe('Delete Paket Layanan', () => {

  beforeEach(() => {

    cy.visit('http://127.0.0.1:8000/login')

    cy.get('input[name="email"]').type('ghefirameyta@gmail.com')
    cy.get('input[name="password"]').type('password123')

    cy.get('button[type="submit"]').click()

    cy.url().should('not.include', '/login')

    cy.visit('http://127.0.0.1:8000/admin/paket-layanan')
  })

  it('Berhasil menghapus paket Bambu R', () => {

    // Klik OK pada popup konfirmasi
    cy.on('window:confirm', () => true)

    cy.contains('tbody tr', 'Paket Bambu R')
      .within(() => {
        cy.get('button[title="Hapus"]').click()
      })

    // Data sudah tidak ada
    cy.contains('tbody tr', 'Paket Bambu R')
      .should('not.exist')
  })

  it('Batal menghapus paket Edukasi Bambu', () => {

    // Klik Cancel pada popup konfirmasi
    cy.on('window:confirm', () => false)

    cy.contains('tbody tr', 'Paket Bambu R')
      .within(() => {
        cy.get('button[title="Hapus"]').click()
      })

    // Data masih ada
    cy.contains('tbody tr', 'Paket Bambu R')
      .should('exist')
  })

})