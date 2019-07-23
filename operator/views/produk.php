<?php
$query = mysqli_query($koneksi, "SELECT * FROM produk");
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-8">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
        <div class="col-4 text-right ml-auto">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#add_product" class="btn btn-primary btn-round btn-sm">
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
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img src="../<?= $row['icon'] ?>" alt="" class="w-100">
                                </div>
                                <div class="col-6">
                                    <h4 class="text-capitalize"><?= $row['nama'] ?></h4>
                                    <h6 class="text-muted">Rp. <?= number_format($row['harga'], 2, ',', '.') ?></h6>
                                </div>
                                <div class="col-3 text-right">
                                    <a href="javascript:void(0)" class="btn btn-primary btn-xs mb-1 btn-edit-product" data-toggle="modal" data-target="#edit_product" data-product="<?= base64_encode(json_encode($row)) ?>"><i class="fa fa-pen"></i></a>
                                    <a href="sistem/hapus_produk.php?id_produk=<?= $row['id_produk'] ?>" class="btn btn-danger btn-delete btn-xs mb-1"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="add_product_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="sistem/add_produk.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title" id="add_product_label">Tambah Katalog Produk</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="icon">Icon/Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="icon" id="icon" class="custom-file-input" accept="image/*" required>
                                <label class="custom-file-label" for="icon">Choose image</label>
                            </div>
                        </div>
                        <!-- <input type="file" name="icon" id="icon" class="form-control" placeholder="" required> -->
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" name="harga" id="harga" class="form-control" aria-label="Harga" placeholder="Ex. 10.0000" pattern="(^[1-9])+[0-9]{0,}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan Produk</label>
                        <input type="text" name="satuan" id="satuan" class="form-control" placeholder="satuan Produk. Ex: Kg, Potong" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="edit_product_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="sistem/update_produk.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title" id="edit_product_label">Edit Produk</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="icon-edit">Icon/Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="icon" id="icon-edit" class="custom-file-input" accept="image/*">
                                <input type="hidden" name="id_produk" id="edit-id-produk">
                                <label class="custom-file-label" for="icon">Choose image</label>
                            </div>
                        </div>
                        <small class="text-muted">Kosongkan jika tidak ingin dirubah!</small>
                        <!-- <input type="file" name="icon" id="icon" class="form-control" placeholder="" required> -->
                    </div>
                    <div class="form-group">
                        <label for="edit-nama-produk">Nama Produk</label>
                        <input type="text" name="nama" id="edit-nama-produk" class="form-control" placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-harga-produk">Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" name="harga" id="edit-harga-produk" class="form-control" aria-label="Harga" placeholder="Ex. 10.0000" pattern="(^[1-9])+[0-9]{0,}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-satuan-produk">Satuan Produk</label>
                        <input type="text" name="satuan" id="edit-satuan-produk" class="form-control" placeholder="satuan Produk. Ex: Kg, Potong" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

