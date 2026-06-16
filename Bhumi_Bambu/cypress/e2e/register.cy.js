describe('Register Test', () => {

  it('user berhasil daftar', () => {
    const email = `test${Date.now()}@mail.com`

    cy.visit('http://127.0.0.1:8000/daftar')

    cy.get('input[placeholder="Nama lengkap"]').type('Ghefirameyta')
    cy.get('input[name="email"]').type(email)
    cy.get('input[name="password"]').type('password123')
    cy.get('input[name="password_confirmation"]').type('password123')
    cy.get('input[name="no_hp"]').type('08123456789')
    cy.get('textarea[name="alamat"], input[name="alamat"]').type('Banyumas, Jawa Tengah')

    cy.get('button[type="submit"]').click()

    // sesuaikan redirect setelah daftar berhasil
    cy.url().should('not.include', '/daftar')
  })


  it('gagal daftar jika password tidak sama', () => {
    const email = `test${Date.now()}@mail.com`

    cy.visit('http://127.0.0.1:8000/daftar')

    cy.get('input[placeholder="Nama lengkap"]').type('Ghefirameyta')
    cy.get('input[name="email"]').type(email)
    cy.get('input[name="password"]').type('password123')
    cy.get('input[name="password_confirmation"]').type('password1233')
    cy.get('input[name="no_hp"]').type('08123456789')
    cy.get('textarea[name="alamat"], input[name="alamat"]').type('Purwokerto, Jawa Tengah')

    cy.get('button[type="submit"]').click()

  })
})