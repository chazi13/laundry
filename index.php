<?php
include_once 'sistem/koneksi.php';
$info_toko = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM info_toko"));
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?= $info_toko['nama_toko'] ?></title>

  <!-- Bootstrap core CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="assets/css/agency.min.css" rel="stylesheet">
</head>

<style>
  @media (max-width: 576px) {
    #nav-logo {
      float: left;
      width: 50%;
    }

    #nav-logo img {
      width: 100%!important;
    }
  }
</style>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a id="nav-logo" class="navbar-brand js-scroll-trigger float-left" href="#page-top">
        <!-- <?= $info_toko['nama_toko'] ?> -->
        <img src="assets/img/mukhlida-laundry.png" alt="<?= $info_toko['nama_toko'] ?>" class="w-50">
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Layanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Kontak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary font-weight-bold p-1 text-white" href="member/">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in">Mukhlida Laundry</div>
        <div class="intro-heading text-uppercase">Solusi Terbaik Untuk Laundry</div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Layanan Kami</a>
      </div>
    </div>
  </header>

  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Tentang Kami</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?= $info_toko['tentang'] ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section class="page-section bg-light" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Pesan Layanan Cuci Online</h2>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-mobile-alt fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Klik & Mulailah</h4>
          <p class="text-muted">Klik tombol Cuci Sekarang untuk memulai. Anda akan diarahkan ke halaman daftar layanan untuk memilih item yang ingin dibersihkan.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-shopping-basket fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Cek & Pesan</h4>
          <p class="text-muted">Periksa daftar item di keranjang Anda dengan mengklik ikon keranjang. Klik tombol Pesan Sekarang untuk memroses ke halaman pemesanan.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-credit-card fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Bayar & Proses</h4>
          <p class="text-muted">Lengkapi informasi Anda untuk memroses antar-jemput item Anda. Lakukan pembayaran di akhir proses pemesanan setelah mengklik Ajukan Pemesanan.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Kontak</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Kirim Pesan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; <?= $info_toko['nama_toko'] ?> 2019</span>
        </div>
        <div class="col-md-4">
          
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="<?= $info_toko['twitter'] ?>">
                <i class="fab fa-twitter mt-3"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="<?= $info_toko['facebook'] ?>">
                <i class="fab fa-facebook-f mt-3"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="<?= $info_toko['instagram'] ?>">
                <i class="fab fa-instagram mt-3"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <!-- <script src="assets/js/jqBootstrapValidation.js"></script>
  <script src="assets/js/contact_me.js"></script> -->

  <!-- Custom scripts for this template -->
  <script src="assets/js/agency.min.js"></script>
  <script>
    $(document).ready(function() {
      let navLogo = $('#nav-logo img');
      if ($('#mainNav').hasClass('navbar-shrink')) {
        navLogo.attr('src', 'assets/img/mukhlida-laundry-black.png');
      } else {
        navLogo.attr('src', 'assets/img/mukhlida-laundry.png');
      }

      $(window).scroll(function() {
        let navLogo = $('#nav-logo img');
        if ($('#mainNav').hasClass('navbar-shrink')) {
          navLogo.attr('src', 'assets/img/mukhlida-laundry-login.png');
        } else {
          navLogo.attr('src', 'assets/img/mukhlida-laundry.png');
        }
      });
    });
  </script>
</body>

</html>
