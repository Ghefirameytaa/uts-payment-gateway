describe("Manajemen Promo - Admin Bhumi Bambu", () => {

  const loginAdmin = () => {
    cy.visit("http://127.0.0.1:8000/login");
    cy.get('input[name="email"]').should("not.be.disabled").type("ghefirameyta@gmail.com");
    cy.get('input[name="password"]').type("password123");
    cy.get('button.login-button').click();
    cy.url().should("include", "/admin/dashboard");
  };

  // ============================================================
  // CREATE
  // ============================================================

  it("TC_PC_001_001 - Tambah promo baru dengan data valid (Positif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo/create");
    cy.contains("Tambah Promo Baru").should("be.visible");

    cy.get('input[name="nama_promo"]').type("Promo Akhir Tahun");
    cy.get('textarea[name="deskripsi"]').type("Diskon spesial akhir tahun untuk semua paket");
    cy.get('input[name="tanggal_mulai"]').type("2026-12-01");
    cy.get('input[name="tanggal_selesai"]').type("2026-12-31");
    cy.get('input[name="diskon"]').type("20");

    cy.get('button.btn-submit').click();

    cy.contains("Promo berhasil ditambahkan!").should("be.visible");
    cy.url().should("include", "/admin/promo");
  });

  it("TC_PC_001_002 - Tambah promo dengan tanggal selesai lebih awal dari tanggal mulai (Negatif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo/create");

    cy.get('input[name="nama_promo"]').type("Promo Tahun Baru");
    cy.get('textarea[name="deskripsi"]').type("Diskon spesial tahun baru untuk semua paket");
    cy.get('input[name="tanggal_mulai"]').type("2026-12-31");
    cy.get('input[name="tanggal_selesai"]').type("2026-12-01");
    cy.get('input[name="diskon"]').type("10");

    cy.get('button.btn-submit').click();

    cy.get('.alert-danger').should("be.visible");
    cy.url().should("include", "/promo/create");
  });

  it("TC_PC_001_003 - Klik tombol Batal saat tambah promo (Alternatif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo/create");
    cy.get('input[name="nama_promo"]').type("Promo Dibatalkan");

    cy.get('a.btn-cancel').click();

    cy.url().should("include", "/admin/promo");
    cy.contains("Promo Dibatalkan").should("not.exist");
  });

  // ============================================================
  // READ
  // ============================================================

  it("TC_PR_002_001 - Lihat daftar promo yang tersedia (Positif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo");

    cy.contains("Daftar Promo").should("be.visible");
    cy.contains("Nama Promo").should("be.visible");
    cy.contains("Diskon").should("be.visible");
    cy.contains("Periode").should("be.visible");
    cy.contains("Status").should("be.visible");
    cy.contains("Total Promo").should("be.visible");
    cy.contains("Promo Aktif").should("be.visible");
    cy.contains("Kadaluarsa").should("be.visible");
  });

  it("TC_PR_002_002 - Lihat daftar promo saat belum ada data (Negatif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo");
    cy.contains("Daftar Promo").should("be.visible");

    cy.get("tbody").then(($tbody) => {
      if ($tbody.find("tr").length === 0) {
        cy.contains("Belum ada promo").should("be.visible");
      } else {
        cy.log("Ada data promo, skip pengecekan kosong");
      }
    });
  });

  it("TC_PR_002_003 - Akses halaman promo tanpa login (Alternatif)", () => {
    cy.visit("http://127.0.0.1:8000/admin/promo");

    cy.url().should("include", "/login");
    cy.get('button.login-button').should("be.visible");
  });

  // ============================================================
  // UPDATE
  // ============================================================

  it("TC PU_003_001 - Edit promo dengan data valid (Positif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo");
    cy.get('a[title="Edit"]').first().click();

    cy.url().should("include", "/edit");
    cy.contains("Edit Promo").should("be.visible");

    cy.get('input[name="nama_promo"]').clear().type("Promo Tahun Baru Updated");
    cy.get('input[name="diskon"]').clear().type("30");

    cy.get('button.btn-submit').click();

    cy.contains("Promo berhasil diperbarui!").should("be.visible");
    cy.url().should("include", "/admin/promo");
  });

  it("TC_PU_003_002 - Edit promo dengan diskon di bawah nilai minimum (Negatif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo");
    cy.get('a[title="Edit"]').first().click();

    cy.url().should("include", "/edit");

    // Hapus atribut min & required dari input agar bisa submit nilai 0
    // sehingga validasi diteruskan ke Laravel (bukan diblokir browser)
    cy.get('input[name="diskon"]')
      .invoke("removeAttr", "min")
      .invoke("removeAttr", "required")
      .clear()
      .type("0");

    cy.get('button.btn-submit').click();

    // Validasi Laravel muncul
    cy.get('.alert-danger').should("be.visible");
    cy.url().should("include", "/edit");
  });

  it("TC_PU_003_003 - Edit promo dengan ID yang tidak ada di database (Alternatif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo/9999/edit", { failOnStatusCode: false });

    cy.contains("404").should("be.visible");
  });

  // ============================================================
  // DELETE
  // ============================================================

  it("TC_PD_004_001 - Hapus promo yang ada (Positif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo");

    cy.get("tbody tr").its("length").then((jumlahSebelum) => {
      // Daftarkan handler confirm SEBELUM klik
      cy.on("window:confirm", () => true);

      cy.get('button[title="Hapus"]').first().click();

      cy.contains("Promo berhasil dihapus!").should("be.visible");
      cy.get("tbody tr").should("have.length.lessThan", jumlahSebelum);
    });
  });

  it("TC_PD_004_002 - Hapus promo yang sudah kadaluarsa (Negatif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo");

    // Daftarkan confirm handler SEBELUM klik
    cy.on("window:confirm", () => true);

    // Badge kadaluarsa pakai class .badge-kadaluarsa bukan teks dalam <td>
    cy.get('.badge-kadaluarsa')
      .first()
      .closest("tr")
      .find('button[title="Hapus"]')
      .click();

    cy.contains("Promo berhasil dihapus!").should("be.visible");
  });

  it("TC_PD_004_003 - Hapus promo dengan ID yang tidak ada (Alternatif)", () => {
    loginAdmin();

    cy.visit("http://127.0.0.1:8000/admin/promo");

    // Ambil CSRF token dari hidden input dalam form delete yang ada di halaman
    cy.get('form input[name="_token"]')
      .first()
      .invoke("val")
      .then((csrfToken) => {
        cy.request({
          method: "POST",
          url: "http://127.0.0.1:8000/admin/promo/9999",
          form: true,
          body: {
            _token: csrfToken,
            _method: "DELETE",
          },
          failOnStatusCode: false,
        }).then((response) => {
          expect(response.status).to.eq(404);
        });
      });
  });

});