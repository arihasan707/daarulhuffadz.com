<main id="main" class="main">

    <div class="pagetitle">
        <h1>Diskon Pendaftaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('staff_karyawan/') ?>">Beranda</a></li>
                <li class="breadcrumb-item">Promosi</li>
                <li class="breadcrumb-item active">Diskon Pendaftaran</li>
            </ol>
        </nav>

        <div class="row">
            <?php foreach ($prog as $p) { ?>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    if ($p->diskon == '1' || $p->diskon == '2') { ?>
                                        <div class="col-12 text-center">
                                            <div class="badge rounded-pill bg-success">Aktif</div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <div class="badge rounded-pill bg-primary"><?= $p->title ?></div>
                                        </div>
                                    <?php } ?>
                                    <label for="inputEmail3"
                                        class="col-sm-12 col-form-label text-center"><?= $p->nama_prog ?></label>
                                    <div class="col-sm-12">
                                        <?php
                                        switch ($p->diskon) {
                                            case 0:
                                                echo "<button type='button' data-bs-toggle='modal' data-bs-target='#diskon" . $p->id . " ' class='btn btn-primary w-100'>Pasang Diskon</button>";
                                                break;
                                            case 1:
                                                echo "<a href=" . base_url('staff_karyawan/unset_diskon_pendaftaran/' . $p->id) . " class='btn btn-danger w-100'>Lepas Diskon</a>";
                                                break;
                                            case 2:
                                                echo "<a href=" . base_url('staff_karyawan/unset_diskon_pendaftaran/' . $p->id) . " class='btn btn-danger w-100'>Lepas Diskon</a>";
                                                break;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-text">
                            <b>Keterangan :</b><br>
                            Pilih lalu klik program yang ingin di pasang diskon pendaftaran ( free biaya pendaftaran )
                        </div>
                    </div>
                </div>
            </div>
        </div>

</main>

<?php foreach ($prog as $p) { ?>
    <div class="modal fade" id="diskon<?= $p->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header head">
                    <h5 class="modal-title bold" id="exampleModalLabel">Diskon <?= $p->nama_prog ?>
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('staff_karyawan/set_diskon_pendaftaran/' . $p->id) ?>" method="POST">
                        <div class=" mb-2">
                            <label for="exampleFormControlInput1" class="form-label bold">Jenis Diskon :</label>
                            <select name="title" class="form-select" required>
                                <option value="">-- Pilihan Diskon --</option>
                                <option value="Diskon Pendaftaran">Diskon Pendaftaran</option>
                                <option value="Diskon Uang Masuk">Diskon Uang Masuk</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label bold">Keterangan :</label>
                            <input type="text" name="ket" class="form-control"
                                placeholder="cth : Gratis Biaya Pendaftaran Rp 300.000" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary btn-sm bold">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>