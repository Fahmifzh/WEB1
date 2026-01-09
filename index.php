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

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">🍰 SweetSip Studio</a>
    <div class="ms-auto">
        <a href="login.php" class="btn btn-outline-secondary btn-sm">Admin Login 🔒</a>
    </div>
  </div>
</nav>

<div class="hero">
    <div>
        <h1>Manis di Setiap Resep 🍓</h1>
        <p class="fs-5">Resep dessert & minuman manis favoritmu ✨</p>
    </div>
</div>

<div class="container my-5">
    <h2 class="text-center fw-bold mb-5" style="color:#6d4c41;">
        ✨ Koleksi Resep ✨
    </h2>

    <div class="row">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM resep ORDER BY id DESC");
        while ($row = mysqli_fetch_array($query)) {
        ?>
        <div class="col-md-4 mb-4">
            <div class="card recipe-card h-100">
                <img src="img/<?php echo $row['gambar']; ?>" 
                     class="card-img-top" 
                     style="height:250px; object-fit:cover;">

                <div class="card-body text-center">
                    <span class="category-badge"><?php echo $row['kategori']; ?></span>
                    <h5 class="fw-bold mt-2"><?php echo $row['nama_resep']; ?></h5>
                    <p class="text-muted small">Resep rahasia yang wajib kamu coba 🤫</p>

                    <a href="detail.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-aesthetic">
                       Lihat Resep 📖
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<footer class="text-center py-4">
    <p class="mb-0">Dibuat dengan ❤️ oleh <b>Fahmi Fauziah</b></p>
</footer>

</body>
</html>
