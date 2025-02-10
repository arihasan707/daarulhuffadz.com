<main id="main" class="main">

    <div class="pagetitle">
        <h1>Galeri <?= $foto->nama ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('administrator/') ?>">Beranda</a></li>
                <li class="breadcrumb-item">Galeri</li>
                <li class="breadcrumb-item active"><?= $head ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">

        <div class="col-12">
            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> Berhasil ! </strong> Data foto telah <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php }; ?>
            <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong> Gagal ! </strong> <?= $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php }; ?>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Foto Baru</h5>
                <form action="<?= base_url('administrator/proses_tambah_foto_galeri/' . $foto->id) ?>" method="POST"
                    enctype="multipart/form-data" class="row g-3">
                    <div class="col-12">
                        <label for="foto" class="form-label">Upload Foto</label>
                        <input type="file" name="foto" class="form-control" id="foto" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                        <a href="<?= base_url('administrator/galeri') ?>" class="btn btn-sm btn-secondary">Back</a>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Foto</h5>
                    <div class="row">

                        <?php foreach ($fotos as $key => $value) { ?>
                        <div class="col-lg-3 col-sm-12 mb-3">
                            <img class="img-fluid"
                                src="<?= base_url('assets/backend/upload/galeri/foto/' . $value->foto) ?>">
                            <p class="mt-1"><?= $value->ket_foto ?></p>
                            <a href="" data-bs-toggle="modal" data-bs-target="#hapus<?= $value->id ?>"
                                class="btn btn-sm btn-danger w-100">hapus</a>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>


<?php foreach ($fotos as $key => $value) { ?>
<!-- modal hapus -->
<div class="modal fade" id="hapus<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-style: normal;" id="exampleModalLabel">Apakah anda yakin ingin
                    menghapus foto ini ?</h5>
            </div>
            <form action="<?= base_url('administrator/hapus_foto_galeri/' . $value->id) ?>" method="POST">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Hapus!</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>