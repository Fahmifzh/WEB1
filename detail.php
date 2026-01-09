<?php
include 'config.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM resep WHERE id='$id'");
$row = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['nama_resep']; ?> | SweetSip</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container my-5">
    <a href="index.php" class="btn btn-secondary mb-3">⬅ Kembali</a>

    <div class="card p-4 shadow-sm rounded-4">
        <img src="img/<?php echo $row['gambar']; ?>" 
             class="img-fluid rounded-4 mb-4"
             style="max-height:400px; object-fit:cover;">

        <h2 class="fw-bold"><?php echo $row['nama_resep']; ?> 🍰</h2>
        <span class="category-badge mb-3 d-inline-block">
            <?php echo $row['kategori']; ?>
        </span>

        <h5 class="mt-4">🧾 Bahan-bahan:</h5>
        <p><?php echo nl2br($row['bahan']); ?></p>

        <h5 class="mt-4">👩‍🍳 Langkah Pembuatan:</h5>
        <p><?php echo nl2br($row['langkah']); ?></p>
    </div>
</div>

<footer class="text-center py-4">
    <p class="mb-0">Dibuat dengan ❤️ oleh <b>Fahmi Fauziah</b></p>
</footer>

</body>
</html>
