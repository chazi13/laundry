<?php
$query_produk = mysqli_query($koneksi, "SELECT * FROM produk");
$query_member = mysqli_query($koneksi, "SELECT id_member, nama, telp, alamat  FROM member");
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-8">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
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
        <form action="sistem/add_pesanan.php" method="post" id="form-pesanan">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Pemesan
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="is_member">Pemesan : </label>
                                    </div>
                                    <div class="col-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="member" name="is_member" value="true" class="custom-control-input is-member">
                                            <label class="custom-control-label" for="member">Member</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="non-member" name="is_member" value="false" class="custom-control-input is-member" checked>
                                            <label class="custom-control-label" for="non-member">Non-Member</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="member">Nama : </label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" name="input_nama_pemesan" id="nama-pemesan" class="form-control" placeholder="Nama Pemesan" required>
                                        <select name="nama_member" id="select-nama-pemesan" class="form-control select2 d-none">
                                            <option value="" disabled selected>Pilih Member</option>
                                            <?php while ($member = mysqli_fetch_assoc($query_member)): ?>
                                                <option value="<?= $member['nama'] ?>" data-member="<?= base64_encode(json_encode($member)) ?>"><?= $member['id_member'] . ' - ' . $member['nama'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <input type="hidden" name="id_member" id="id-member-pemesan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="telp-pemesan">Telp : </label>
                                    </div>
                                    <div class="col-10">
                                        <input type="number" name="telp" id="telp-pemesan" class="form-control" pattern="^[08][0-9]{10,15}" title="Masukan Nomor Telpon yang valid, seperti 085774237xxx. Telp hanya bisa berisi angka" placeholder="Telp Pemesan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="alamat-pemesan">Alamat : </label>
                                    </div>
                                    <div class="col-10">
                                        <textarea name="alamat" id="alamat-pemesan" rows="3" class="form-control" placeholder="Alamat Pemesan" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-select-product">
                        <div class="card-body pb-0">
                            <div class="card-title">
                                Produk
                            </div>
                        </div>
                        <div class="card-body px-2 pt-0 scrollbar scrollbar-inner">
                            <div class="list-group list-group-flush">
                                <?php while ($produk = mysqli_fetch_assoc($query_produk)): ?>
                                    <div class="list-group-item">
                                        <div class="row w-100">
                                            <div class="col-3">
                                                <img src="../<?= $produk['icon'] ?>" alt="" class="w-100">
                                            </div>
                                            <div class="col-6">
                                                <h4 class="text-capitalize"><?= $produk['nama'] ?></h4>
                                                <h6 class="text-muted">Rp. <?= number_format($produk['harga'], 2, ',', '.') ?></h6>
                                            </div>
                                            <div class="col-3 text-right">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-xs mb-1 btn-select-product" data-product="<?= base64_encode(json_encode($produk)) ?>"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Pesanan
                                <table class="table table-striped table-list-pesanan">
                                    <thead>
                                        <th width="30%">Produk</th>
                                        <th width="30%">Qty</th>
                                        <th width="35%" class="text-right">Subtotal</th>
                                        <th width="5%"></th>
                                    </thead>
                                    <tbody id="list-pesanan">
                                        
                                    </tbody>
                                </table>
                                
                                <div class="custom-control custom-checkbox d-none" id="btn-antar-pesanan">
                                    <input type="checkbox" name="antar" class="custom-control-input" id="antar">
                                    <label class="custom-control-label" for="antar">Pesanan diantar</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer total-pemesanan d-none">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="font-weight-bolder">Total</h3>
                                </div>
                                <div class="col-6">
                                    <div class="total-all text-right">
                                        <h3 class="font-weight-bolder"></h3>
                                        <input type="hidden" name="total" id="total-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Pembayaran</div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Rp. </span></div>
                                    <input type="number" name="tunai" id="tunai" class="form-control" placeholder="Masukan Nominal Pembayaran" pattern="^[1-9]([0-9].){0,}" title="Masukan Nominal!" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block shadow">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="struk-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="struk-modal-title" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="struk-modal-title">Struk Pembayaran</h3>
            </div>
            <div class="modal-body struk-content">
                
            </div>
            <div class="modal-footer">
                <a href="cetak_struk.php?k=" id="btn-print-struk" class="btn btn-primary" target="_blank" onclick="return false">
                    <i class="fa fa-print"></i>
                    <span>Print</span>
                </a>
            </div>
        </div>
    </div>
</div>