<?php include_once 'sistem/content.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>MUKHLIDA Laundry</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<!-- <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script> -->

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">
	<link rel="stylesheet" href="../assets/css/fonts.min.css">
	
	<!-- Custom -->
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="index.html" class="logo text-white text-uppercase">
					MUKHLIDA LAUNDRY
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/<?= $_SESSION['jenis_kelamin'] ?>.jpg" alt="<?= $_SESSION['jenis_kelamin'] ?>" class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?= $_SESSION['nama'] ?>
									<span class="user-level"><?= $_SESSION['level'] ?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="index.php?page=edit_profil">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="sistem/logout.php">
											<span class="link-collapse">Logout</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item <?= @$d_active ?>">
							<a href="index.php">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
                        <?php if ($_SESSION['level'] == 'Admin'): ?>
						<li class="nav-item <?= @$pt_active ?>">
							<a href="index.php?page=profil_toko">
								<i class="fas fa-store-alt"></i>
								<p>Profil Toko</p>
							</a>
                        </li>
                        <li class="nav-item <?= @$p_active ?>">
							<a href="index.php?page=pegawai">
								<i class="fas fa-user"></i>
								<p>Pegawai</p>
							</a>
                        </li>
                        <?php endif; ?>
						<li class="nav-item <?= @$m_active ?>">
							<a href="index.php?page=member">
								<i class="fas fa-users"></i>
								<p>Member</p>
							</a>
						</li>
						<?php if ($_SESSION['level'] == 'Admin'): ?>
						<li class="nav-item <?= @$pk_active . @$pd_active ?> submenu">
							<a data-toggle="collapse" href="#produk">
								<i class="fas fa-layer-group"></i>
								<p>Produk</p>
								<span class="caret"></span>
							</a>
							<div class="collapse <?= (@$pk_active || @$pd_active) ? 'show' : '' ?>" id="produk">
								<ul class="nav nav-collapse">
									<li class="<?= @$pk_active ?>">
										<a href="index.php?page=produk">
											<span class="sub-item">Katalog</span>
										</a>
                                    </li>
                                    <li class="<?= @$pd_active ?>">
										<a href="index.php?page=diskon">
											<span class="sub-item">Diskon</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<?php endif; ?>
						<li class="nav-item <?= @$ps_active ?>">
							<a href="index.php?page=pesanan">
								<i class="fas fa-table"></i>
								<p>Pesanan</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<?php include_once 'views/' . $page ?>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto">
						<!-- 2019, Created By Chazi -->
						<!-- 2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a> -->
					</div>
				</div>
			</footer>
		</div>
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	
	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Custom JS -->
	<script src="../assets/js/main.js"></script>
</body>
</html>
<?php unset($_SESSION['pesan']) ?>
