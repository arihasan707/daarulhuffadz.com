<main class="bg-gray-light">
    <!-- breadcrumb area start -->
    <section class="breadcrumb bg">
        <div class="row">
            <div class="col">
                <h3 class='text-center'>galeri</h3>
            </div>
        </div>
    </section>


    <!-- progress area start here -->
    <section class="pb-40 pt-40">
        <div class="container">
            <div class="row">
                <?php foreach ($galeri as $key => $value) { ?>
                <div class="col-lg-4 p-2">
                    <a href="<?= base_url('galeri/aktivitas/' . url_title($value->nama)) ?>">
                        <div class="foto wow fadeInUp" data-bs-delay='.2s'
                            style="background-image: linear-gradient(rgba(129, 129, 129, 0), rgba(20, 19, 19, 0.7)), url(<?= base_url('assets/backend/upload/galeri/sampul/' . $value->sampul) ?>);">
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