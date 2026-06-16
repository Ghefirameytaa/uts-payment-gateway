describe('Login Test', () => {
  it('user berhasil login', () => {
    cy.visit('http://127.0.0.1:8000/login')

    cy.get('input[name="email"]').type('ghefirameyta@gmail.com')
    cy.get('input[name="password"]').type('password123')

    cy.get('button[type="submit"]').click()

    // cek setelah login masuk dashboard
    cy.url().should('include', '/dashboard')
  })

  it('gagal login dengan password salah', () => {
    cy.visit('http://127.0.0.1:8000/login')

    cy.get('input[name="email"]').type('gehfirameytaaa@mail.com')
    cy.get('input[name="password"]').type('salahpassword')

    cy.get('button[type="submit"]').click()

    // cek masih di login atau muncul error
    cy.url().should('include', '/login')
  })
})