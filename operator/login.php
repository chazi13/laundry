<?php include_once '../sistem/koneksi.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Opertor</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row mt-2">
            <div class="col-sm-12 col-md-8 col-lg-4 mx-auto login-logo text-center mb-3">
                <img src="../assets/img/mukhlida-laundry-login.png" alt="Logo" class="w-75">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12 col-md-8 col-lg-4 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title text-center"><small>Masuk Untuk Operasional</small></div>
                        <?php if (@$_SESSION['pesan']): ?>
                            <div class="alert alert-<?= $_SESSION['pesan']['status'] == 'error' ? 'danger' : $_SESSION['pesan']['status'] ?> alert-dismisable fade show" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p><?= $_SESSION['pesan']['msg'] ?></p>
                            </div>
                        <?php endif; ?>

                        <form action="sistem/act_login.php" method="post">
                            <div class="form-group">
                                <label for="id">User ID :</label>
                                <input type="text" name="id" id="id" class="form-control text-uppercase" placeholder="Ex: OP100" autofocus="" autocomplete="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" name="password" id="password" class="form-control" autocomplete="current-password" placeholder="*********" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 ml-auto">
                                        <button type="submit" class="btn btn-primary btn-block shadow">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
</body>
</html>