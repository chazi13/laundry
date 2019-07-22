<?php
$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE level = 'Pegawai'");
$no = 1;
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-7">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
        <div class="col-5 text-right ml-auto">
            <a href="index.php?page=add_pegawai" class="btn btn-primary btn-round btn-sm">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>
    </div>

    <?php if (@$_SESSION['pesan']): ?>
        <div class="alert alert-<?= $_SESSION['pesan']['status'] == 'error' ? 'danger' : $_SESSION['pesan']['status'] ?> alert-dismisable fade show" role="alert">
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p><?= $_SESSION['pesan']['msg'] ?></p>
        </div>
    <?php endif; ?>

    <div class="main-content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead class="border-top">
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['id_admin'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['telp'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td>
                                        <a href="index.php?page=edit_pegawai&id_pegawai=<?= $row['id_admin'] ?>" class="btn btn-sm btn-info mt-1 mb-1"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="sistem/hapus_pegawai.php?id_pegawai=<?= $row['id_admin'] ?>" class="btn btn-sm btn-danger btn-delete mt-1 mb-1"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>