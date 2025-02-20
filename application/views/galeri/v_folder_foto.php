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
                <?php if ($value->folder_galeri_id) { ?>
                <div class="col-lg-4 p-2">
                    <a data-fslightbox href="<?= base_url('assets/backend/upload/galeri/foto/' . $value->foto) ?>">
                        <img src="<?= base_url('assets/backend/upload/galeri/foto/' . $value->foto) ?>">
                    </a>
                </div>
                <?php } ?>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- progress area end here -->

</main>