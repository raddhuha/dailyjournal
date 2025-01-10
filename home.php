<?php
include "koneksi.php"; 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
    <link rel="icon" href="img/icon.jpg">
    <style>
      .dark-mode {
        background-color: #121212;
        color: #ffffff;
      }
      .dark-mode .navbar, .dark-mode .card, .dark-mode .carousel-inner, .dark-mode .footer {
        background-color: #222;
        color: #ffffff;
      }
      .dark-mode .navbar-brand, .dark-mode .nav-link {
        color: #ffffff !important;
      }
      .dark-mode .card-footer, .dark-mode footer a {
        color: #aaaaaa;
      }
      .bg-primary {
        background-color: #2a427a !important;
      }
      .car {
        cursor: pointer;
        filter: grayscale(100%);
      }
      img:hover {
        filter: grayscale(0%);
      }
      .about-me-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
      }
      .about-me-container img {
        cursor: pointer;
      }
      .about-me-container img.centered {
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
    </style>
  </head>
  <body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">McLaren</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About Me</a>
            </li>
            <li class="nav-item">
              <a class="bg-danger rounded-pill nav-link text-white fw-bold" href="admin.php">Login</a>
            </li>
            <li class="nav-item p-1">
              <img id="light" src="img/light.jpg" style="width: 25px;" alt="">
            </li>
            <li class="nav-item p-1">
              <img id="dark" src="img/dark.jpg" style="width: 25px;" alt="">
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- nav end -->

    <!-- hero begin -->
    <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="img/back.jpg" class="car img-fluid p-5" width="300" alt="">
          <div>
            <h1 class="fw-bold display4">McLaren Showcase</h1>
            <h4 class="lead display-6">Find Your Favorite McLaren</h4>
            <h6>
              <span id="tanggal"></span>
              <span id="jam"></span>
            </h6>
          </div>
        </div>
      </div>
    </section>
    <!-- hero end -->

    <!-- article begin -->
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">article</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
          <?php
          $sql_article = "SELECT * FROM article ORDER BY tanggal DESC";
          $hasil = $conn->query($sql_article); 

          while($row = $hasil->fetch_assoc()){
          ?>
            <div class="col">
              <div class="card h-100">
                <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title"><?= $row["judul"]?></h5>
                  <p class="card-text">
                    <?= $row["isi"]?>
                  </p>
                </div>
                <div class="card-footer">
                  <small class="text-body-secondary">
                    <?= $row["tanggal"]?>
                  </small>
                </div>
              </div>
            </div>
            <?php
          }
          ?> 
        </div>
      </div>
    </section>
    <!-- article end -->

    <!-- gallery begin -->
    <section id="gallery" class="text-center p-5 bg-danger-subtle">
      <h1 class="fw-bold display-4 pb-3">Gallery</h1>
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner ratio ratio-16x9">
          <?php
          // Koneksi ke database
          include 'koneksi.php';
          
          // Query untuk mengambil data dari tabel gallery
          $sql_gallery = "SELECT * FROM gallery";
          $result = $conn->query($sql_gallery); 
          
          $first = true; // Variable untuk menandai item pertama
          
          while($row = mysqli_fetch_assoc($result)) {
            // Tambahkan class active untuk item pertama
            $activeClass = $first ? 'active' : '';
          ?>
            <div class="carousel-item <?php echo $activeClass; ?>" data-bs-interval="2000">
              <img src="img/<?= $row["gambar"]?>" class="d-block w-100">
            </div>
          <?php
            $first = false; // Set false setelah item pertama
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <!-- gallery end -->

    <!-- schedule begin -->
    <section id="schedule" class="text-center p-5">
      <div class="container p-5">
        <h1 class="fw-bold display-4 pb-3">Schedule</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
          <div class="card" style="width: 18rem;">
            <div class="card-header bg-danger">
              SENIN
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Etika Profesi <br> 16.20-18.00|H.4.4</li>
              <li class="list-group-item">Sistem Operasi <br> 18.30-21.00|H.4.8</li>
            </ul>
          </div>
          <div class="card" style="width: 18rem;">
            <div class="card-header bg-danger">
              SELASA
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Pendidikan Kewarganegaraan <br> 12.30-13.10|H.4.9</li>
              <li class="list-group-item">Probabilitas <br> 14.30-16.00|H.4.7</li>
              <li class="list-group-item">Kecerdasan Buatan <br> 09.30-12.00|H.4.1</li>
            </ul>
          </div>
          <div class="card" style="width: 18rem;">
            <div class="card-header bg-danger">
              RABU
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Manajemen Proyek <br> 14.20-16.00|Kulino</li>
            </ul>
          </div>
          <div class="card" style="width: 18rem;">
            <div class="card-header bg-danger">
              KAMIS
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Bahasa Indonesia <br> 16.20-18.00|Kulino</li>
              <li class="list-group-item">Pendidikan Agama Islam <br> 18.30-21.00|H.4.8</li>
              <li class="list-group-item">Penambangan Data <br> 09.30-12.00|H.5.5</li>
            </ul>
          </div>
          <div class="card" style="width: 18rem;">
            <div class="card-header bg-danger">
              JUMAT
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Pemrograman Web <br> 16.20-18.00|D.2.K</li>
            </ul>
          </div>  
          <div class="card" style="width: 18rem;">
            <div class="card-header bg-danger">
              SABTU
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">FREE</li>
            </ul>
          </div> 
        </div> 
      </div>
    </section>
    <!-- schedule end -->

    <!-- about me start -->
    <section id="about" class="p-5 bg-danger-subtle">
      <div class="container about-me-container">
        <!-- ubah gambar menjadi besar ketika di klik -->
        <img id="gambarBesar" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Donald_Trump_official_portrait.jpg/473px-Donald_Trump_official_portrait.jpg" class="rounded-circle img-fluid p-5" width="300" alt="">
        <div id="about-text" class="text">
          <h6 class="display-6">A11.2023.15388</h6>
          <h4 class="fw-bold display-6">Radian Dhuha Farsainsa</h4>
          <div class="">Program Studi Teknik Informatika</div>
          <div class="fw-bold">Universitas Dian Nuswantoro</div>
        </div>
      </div>
    </section>
    <!-- about me end -->


    <!-- footer begin -->
    <footer class="text-center p-3 ">
    <div>
        <a href="https://www.instagram.com/udinusofficial"
        ><i class="bi bi-instagram h2 p-2 text-dark"></i
        ></a>
        <a href="https://twitter.com/udinusofficial"
        ><i class="bi bi-twitter h2 p-2 text-dark"></i
        ></a>
        <a href="https://wa.me/+62812685577"
        ><i class="bi bi-whatsapp h2 p-2 text-dark"></i
        ></a>
    </div>
    <div>Raddhuha &copy; 2025</div>
    </footer>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="text/javascript">
      document.getElementById("dark").onclick = function () {
        // Aktifkan dark mode
        document.body.classList.add("dark-mode");
    
        // Ubah navbar menjadi gelap
        var navbar = document.querySelector(".navbar");
        navbar.classList.add("bg-dark");
        navbar.classList.remove("bg-body-tertiary");
    
        // Ubah warna ikon footer menjadi terang
        document.querySelectorAll("footer a i").forEach(function(icon) {
          icon.style.color = "#ffffff"; // Warna ikon menjadi putih
        });
    
        // Ubah semua elemen dengan kelas "bg-info-subtle" menjadi warna baru
        document.querySelectorAll(".bg-info-subtle").forEach(function(element) {
          element.classList.remove("bg-info-subtle");
          element.classList.add("bg-primary")
        });
      };
    
      document.getElementById("light").onclick = function () {
        // Nonaktifkan dark mode
        document.body.classList.remove("dark-mode");
    
        // Kembalikan navbar ke tampilan sebelumnya
        var navbar = document.querySelector(".navbar");
        navbar.classList.remove("bg-dark");
        navbar.classList.add("bg-body-tertiary");
    
        // Kembalikan warna ikon footer ke default
        document.querySelectorAll("footer a i").forEach(function(icon) {
          icon.style.color = ""; // Kembalikan warna ikon footer
        });
    
        // Kembalikan semua elemen yang sebelumnya menggunakan "bg-info-subtle"
        document.querySelectorAll(".bg-primary").forEach(function(element) {
          element.classList.remove("bg-primary");
          element.classList.add("bg-info-subtle"); // Kembalikan kelas
        });
      };
      document.getElementById('hilang').addEventListener('click', function() {
        const textElement = document.querySelector('.text');
        textElement.style.display = 'none';
      }); 

      
      document.getElementByClass('.text').addEventListener('click', function() {
        const textElement = document.querySelector('hilang');
        textElement.style.display = 'none';
      }); 

      // Menambahkan tanggal dan waktu
      function tampilWaktu() {
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1; // Bulan dimulai dari 0
        var tanggal = waktu.getDate();
        var tahun = waktu.getFullYear();
        var jam = String(waktu.getHours()).padStart(2, '0'); // Format jam 2 digit
        var menit = String(waktu.getMinutes()).padStart(2, '0'); // Format menit 2 digit
        var detik = String(waktu.getSeconds()).padStart(2, '0'); // Format detik 2 digit

        document.getElementById("tanggal").innerHTML =
          tanggal + "/" + bulan + "/" + tahun;
        document.getElementById("jam").innerHTML =
          jam + ":" + menit + ":" + detik;
      }

      // Panggil fungsi tampilWaktu setiap detik
      setInterval(tampilWaktu, 1000);
    </script>
    
    <!-- menambahkan script untuk menampilkan gambar besar -->
    <script>
      function tampilkanGambarBesar(gambar) {
          document.getElementById("gambarBesar").src = gambar;
      }
    </script>
  </body>
</html>