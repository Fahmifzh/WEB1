<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SweetSip Studio 🍹</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include 'layout/navbar.php'; ?>

<!-- ================= HERO SECTION ================= -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center">

      <!-- TEXT -->
      <div class="col-md-6 hero-text">
        <span class="badge bg-warning text-dark mb-3">
          🍓 New Recipe Collection
        </span>

        <h1 class="mt-3">
          Manis di Setiap Resep,<br>
          Bikin Hari Lebih Happy ✨
        </h1>

        <p class="mt-3">
          SweetSip Studio adalah kumpulan resep dessert dan
          minuman manis yang mudah dibuat, enak, dan cocok
          untuk menemani waktu santaimu.
        </p>

        <a href="#resep" class="hero-btn mt-3 d-inline-block">
          Jelajahi Resep 🍹
        </a>
      </div>

      <!-- IMAGE CAROUSEL -->
      <div class="col-md-6">
        <div id="heroSlider" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <div class="carousel-item active" data-bs-interval="3000">
              <img src="assets/img/heror1.jpg" class="hero-img d-block w-100">
            </div>

            <div class="carousel-item" data-bs-interval="3000">
              <img src="assets/img/hero2.jpg" class="hero-img d-block w-100">
            </div>

            <div class="carousel-item" data-bs-interval="3000">
              <img src="assets/img/hero3.jpg" class="hero-img d-block w-100">
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ================= RESEP SECTION ================= -->
<section id="resep" class="container my-5">
  <h2 class="text-center fw-bold mb-5" style="color:#6d4c41;">
    ✨ Koleksi Resep ✨
  </h2>

  <div class="row">
    <?php
    $query = mysqli_query($conn,"
      SELECT resep.*, kategori.nama_kategori
      FROM resep
      JOIN kategori ON resep.kategori_id = kategori.id
      ORDER BY resep.id DESC
    ");

    while($row = mysqli_fetch_assoc($query)):
    ?>
    <div class="col-md-4 mb-4">
      <div class="card recipe-card h-100">
        <img src="assets/uploads/<?php echo $row['gambar']; ?>"
             class="card-img-top"
             style="height:220px; object-fit:cover;">

        <div class="card-body text-center">
          <span class="category-badge">
            <?php echo $row['nama_kategori']; ?>
          </span>

          <h5 class="fw-bold mt-2">
            <?php echo $row['nama_resep']; ?>
          </h5>

          <p class="text-muted small">
            Resep favorit yang wajib kamu coba 🍰
          </p>

          <a href="detail.php?id=<?php echo $row['id']; ?>"
             class="btn btn-aesthetic">
             Lihat Resep 📖
          </a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</section>

<!-- ================= ABOUT ================= -->
<section id="about" class="py-5" style="background: linear-gradient(135deg, #fff5f7 0%, #ffffff 100%);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-5 mb-4 mb-md-0">
        <img src="assets/img/logo.png" class="img-fluid rounded-4 shadow" alt="SweetSip Studio" style="border: 8px solid white;">
      </div>
      <div class="col-md-7 ps-md-5">
        <h6 class="text-danger fw-bold text-uppercase small mb-2">Since 2024</h6>
        <h2 class="fw-bold mb-4" style="color:#6d4c41; font-family: 'Playfair Display', serif;">Misi SweetSip Studio 🍰</h2>
        <p class="lead text-muted">
          SweetSip Studio hadir sebagai rumah digital bagi para pecinta hidangan manis. 
        </p>
        <p class="text-secondary">
          Kami percaya bahwa setiap resep memiliki cerita. Aplikasi ini dibuat untuk membantu kamu mendokumentasikan, menemukan, dan mencoba berbagai resep dessert serta minuman manis secara terstruktur. Tidak perlu lagi bingung mencari catatan resep yang hilang di media sosial—semua kelezatan ada di sini.
        </p>
        <div class="row mt-4">
          <div class="col-6">
            <h5 class="fw-bold mb-0">100+</h5>
            <small class="text-muted">Resep Teruji</small>
          </div>
          <div class="col-6">
            <h5 class="fw-bold mb-0">Mudah</h5>
            <small class="text-muted">Langkah Praktis</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="contact" class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold" style="color:#6d4c41;">Hubungi Kami</h2>
      <div class="mx-auto" style="width: 50px; height: 3px; background: #ffc107;"></div>
    </div>
    
    <div class="row justify-content-center">
      <div class="col-md-4 mb-4">
        <div class="p-4 text-center rounded-4 shadow-sm h-100 border-0 card-hover" style="background: #fdfdfd;">
          <div class="fs-1 mb-3">📧</div>
          <h5 class="fw-bold">Email</h5>
          <p class="text-muted">sweetsipstudio@email.com</p>
        </div>
      </div>
      
      <div class="col-md-4 mb-4">
        <div class="p-4 text-center rounded-4 shadow-sm h-100 border-0 card-hover" style="background: #fdfdfd;">
          <div class="fs-1 mb-3">📍</div>
          <h5 class="fw-bold">Lokasi</h5>
          <p class="text-muted">Bandung, West Java<br>Indonesia</p>
        </div>
      </div>
      
      <div class="col-md-4 mb-4">
        <div class="p-4 text-center rounded-4 shadow-sm h-100 border-0 card-hover" style="background: #fdfdfd;">
          <div class="fs-1 mb-3">📸</div>
          <h5 class="fw-bold">Instagram</h5>
          <p class="text-muted">@SweetSip.Studio</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'layout/footer.php'; ?>

</body>
</html>
