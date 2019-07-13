<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold"><?= $title ?></h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <?php if ($_SESSION['level'] == 'Admin'): ?>
                    <a href="index.php?page=add_member" class="btn btn-white btn-border btn-round mr-2">Add Member</a>
                <?php endif; ?>
                <a href="index.php?page=add_pesanan" class="btn btn-secondary btn-round">Add Pesanan</a>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Pemesanan</div>
                </div>
            </div>
        </div>
    </div>
</div>
