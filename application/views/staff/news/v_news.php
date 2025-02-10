<main id="main" class="main">

    <div class="pagetitle">
        <h1>DHI News</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('staff_karyawan/') ?>">Beranda</a></li>
                <li class="breadcrumb-item active">DHI News</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-12">
        <div class="tambah">
            <a href="<?= base_url('staff_karyawan/add_news') ?>" class="col-12 btn btn-success">Tambah
                Berita/Artikel</a>
        </div>
        <div class="card1">
            <table id="inbox" class="ui celled table" style="width:100%; padding:0px;">
                <thead>
                    <tr style=" background-color:#0d6efd; color:white;">
                        <th>No.</th>
                        <th>Tgl/Waktu</th>
                        <th>Author</th>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($news->result() as $i) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $i->created_at ?></td>
                            <td><?= $i->user_id ?></td>
                            <td><img src="<?= base_url() ?>assets/backend/upload/<?= $i->foto; ?>" width="150px"></td>
                            <td><?= $i->judul ?></td>
                            <td style="display:inline-block;" class="text-center">
                                <a data-bs-toggle="modal" data-bs-target="#hapus<?= $i->id_news; ?>" href=""
                                    class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php foreach ($news->result() as $h) { ?>
    <!-- modal hapus -->
    <div class="modal fade" id="hapus<?= $h->id_news; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin menghapus berita ini ?</h5>
                </div>
                <form action="<?= base_url('staff_karyawan/delete_news/' . $h->id_news ) ?>" method="POST">
                    <input type="hidden" name="foto" value="<?= $h->foto ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Hapus!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }; ?>