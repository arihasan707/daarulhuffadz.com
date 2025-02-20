<main class="bg-gray-light">
    <!-- breadcrumb area start -->
    <section class="breadcrumb bg">
        <div class="row">
            <div class="col">
                <h3 class='text-center'><?= $galeri->nama ?></h3>
            </div>
        </div>
    </section>

    <!-- progress area start here -->
    <section class="pb-40 pt-40">
        <div class="container">
            <div class="row">

                <?php foreach ($fotos as $key => $value) { ?>
                <?php if ($value->folder_galeri_id === null) { ?>
                <div class="col-lg-4 p-2">
                    <a data-fslightbox href="<?= base_url('assets/backend/upload/galeri/foto/' . $value->foto) ?>">
                        <img src="<?= base_url('assets/backend/upload/galeri/foto/' . $value->foto) ?>">
                    </a>
                </div>
                <?php } ?>
                <?php } ?>

                <?php foreach ($folder as $key => $value) { ?>
                <div class="col-lg-4 p-2">
                    <a
                        href="<?= base_url('galeri/aktivitas/' . url_title($galeri->nama) . '/' . url_title($value->nama)) ?>">
                        <div class="foto wow fadeInUp" data-bs-delay='.2s'
                            style="background-image: linear-gradient(rgba(129, 129, 129, 0), rgba(20, 19, 19, 0.7)), url(<?= base_url('assets/backend/upload/galeri/folder/sampul/' . $value->sampul) ?>);">
                            <p>Aktivitas</p>
                            <h5><?= $value->nama ?></h5>
                        </div>
                    </a>
                </div>
                <?php } ?>


            </div>
        </div>
    </section>
    <!-- progress area end here -->

</main>