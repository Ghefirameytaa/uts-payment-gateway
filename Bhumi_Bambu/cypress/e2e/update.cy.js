describe('Update Paket Layanan - Negative Test', () => {

  beforeEach(() => {

    cy.visit('http://127.0.0.1:8000/login')

    cy.get('input[name="email"]').type('ghefirameyta@gmail.com')
    cy.get('input[name="password"]').type('password123')

    cy.get('button[type="submit"]').click()

    cy.url().should('not.include', '/login')

    cy.visit('http://127.0.0.1:8000/admin/paket-layanan')
  })

  it('Gagal update jika harga bernilai 0', () => {

    cy.contains('tbody tr', 'Edukasi Bambu')
      .within(() => {
        cy.get('a[title="Edit"]').click()
      })

    cy.url().should('include', '/edit')

    cy.get('input[name="harga"]')
      .should('be.visible')
      .invoke('val', '0')
      .trigger('input')
      .trigger('change')

    cy.contains('button', 'Update Paket').click()

    cy.url().should('include', '/edit')
  })

  it('Gagal update jika harga bernilai negatif', () => {

    cy.contains('tbody tr', 'Edukasi Bambu')
      .within(() => {
        cy.get('a[title="Edit"]').click()
      })

    cy.url().should('include', '/edit')

    cy.get('input[name="harga"]')
      .should('be.visible')
      .invoke('val', '-100000')
      .trigger('input')
      .trigger('change')

    cy.contains('button', 'Update Paket').click()

    cy.url().should('include', '/edit')
  })

  it('Gagal update jika nama paket dikosongkan', () => {

    cy.contains('tbody tr', 'Edukasi Bambu')
      .within(() => {
        cy.get('a[title="Edit"]').click()
      })

    cy.url().should('include', '/edit')

    cy.get('input[name="nama_paket"]')
      .should('be.visible')
      .focus()
      .type('{selectall}{backspace}')

    cy.contains('button', 'Update Paket').click()

    cy.url().should('include', '/edit')
  })

})