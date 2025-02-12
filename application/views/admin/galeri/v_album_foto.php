<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $head ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('administrator/') ?>">Beranda</a></li>
                <li class="breadcrumb-item active"><?= $head ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-12">

        <div class="col-12">
            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> Berhasil ! </strong> Data galeri telah <?= $this->session->flashdata('success') ?>
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

        <div class="tambah">
            <a data-bs-toggle="modal" data-bs-target="#tambah" class="col-12 btn btn-success">Tambah Galeri</a>
        </div>
        <div class="card1">
            <table id="inbox" class="ui celled table" style="width:100%; padding:0px;">
                <thead>
                    <tr style=" background-color:#0d6efd; color:white;">
                        <th>No.</th>
                        <th>Nama Galeri</th>
                        <th>Sampul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($galeri as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->nama ?></td>
                        <td class="text-center"><img
                                src="<?= base_url('assets/backend/upload/galeri/sampul/' . $value->sampul) ?>"
                                alt="sampul_galeri" srcset="" width="250"><br>
                            <span><i class="bi bi-images"></i> <?= $value->jml_foto ?> Foto</span><br>
                            <span><a href="<?= base_url('administrator/tambah_foto_galeri/' . $value->id) ?>"
                                    class="btn btn-sm btn-success"> <i class="bi bi-plus"></i>Tambah
                                    Foto</a></span>
                        </td>
                        <td><a href="" data-bs-toggle="modal" data-bs-target="#edit<?= $value->id ?>"
                                class="btn btn-sm btn-primary"> <i class="bi bi-pencil"></i></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#hapus<?= $value->id ?>"
                                class="btn btn-sm btn-danger"> <i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- modal tambah -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header head">
                <h5 class="modal-title bold" id="exampleModalLabel">Tambah Galeri</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('administrator/tambah_galeri') ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label bold">Nama Galeri<span>*</span></label>
                        <input type="text" name="nama_galeri" class="form-control" id="exampleFormControlInput1"
                            placeholder="Masukan nama galeri">
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label bold">Sampul<span>*</span></label>
                        <input type="file" name="sampul" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-text">
                        <b><i> Keterangan: <i></b><br><span>*</span>Wajib di isi.
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>



<?php foreach ($galeri as $key => $value) { ?>

<!-- modal edit    -->
<div class="modal fade" id="edit<?= $value->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header head">
                <h5 class="modal-title bold" id="exampleModalLabel">Edit Galeri</h5>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('administrator/edit_galeri/' . $value->id) ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label bold">Nama Galeri<span></span></label>
                        <input type="text" value="<?= $value->nama ?>" name="nama_galeri" class="form-control"
                            id="exampleFormControlInput1" placeholder="Masukan nama galeri">
                    </div>
                    <div class="mb-2">
                        <div>
                            <label for="exampleFormControlInput1" class="form-label bold">Sampul</label>
                            <div>
                                <img src="<?= base_url('assets/backend/upload/galeri/sampul/' . $value->sampul) ?>"
                                    width="250">
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label bold">Ganti Sampul<span></span></label>
                        <input type="file" name="sampul" class="form-control" id="exampleFormControlInput1">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- modal hapus -->
<div class="modal fade" id="hapus<?= $value->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-style: normal;" id="exampleModalLabel">Apakah anda yakin ingin
                    menghapus data galeri ini ?</h5>
            </div>
            <form action="<?= base_url('administrator/hapus_galeri/' . $value->id) ?>" method="POST">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Hapus!</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>