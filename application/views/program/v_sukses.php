<div class="flash-data" data-flashdata="<?= $this->session->flashdata('sukses') ?>"></div>
<main class="bg-gray-light">

    <section class="tp-about-area position-relative pt-100 pb-90 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="card sukses-bayar text-center">
                        <h4 class="text-center pt-3">Pendaftaran Berhasil!</h4>
                        <p><?= date('d F Y', strtotime($tempdata['created_at'])) ?></p>
                        <div class="col-lg-12 d-flex justify-content-center">
                            <dotlottie-player
                                src="https://lottie.host/eba15ced-8977-429f-8cb8-65f15c0785ab/7GanDEl2to.json"
                                background="transparent" speed="1" style="width: 130px; height: 130px" direction="1"
                                loop autoplay></dotlottie-player>
                        </div>
                        <span class="mb-3 text-bg-dark">Silahkan konfirmasi pendaftaran dibawah</span>

                        <?php
                        switch ($tempdata['prog_id']) {
                            case 6:
                            case 7:
                            case 8:
                                echo "<a class='btn btn-primary mb-1'
                                href='https://api.whatsapp.com/send?phone=6282133558441'>Konfirmasi
                                Pendaftaran</a>";
                                break;

                            case 1:
                            case 2:
                                echo "<a class='btn btn-primary mb-1'
                                href='https://api.whatsapp.com/send?phone=6282221115979'>Konfirmasi
                                Pendaftaran</a>";
                                break;

                            case 10:
                                echo " <a class='btn btn-primary mb-1'
                                href='https://api.whatsapp.com/send?phone=6282122022948'>Konfirmasi
                                Pendaftaran</a>";
                                break;

                            default:
                                echo "  <a class='btn btn-primary mb-1'
                                href='https://api.whatsapp.com/send?phone=6281399251460'>Konfirmasi
                                Pendaftaran</a>";
                                break;
                        } ?>
                        <a class="mt-2 text-decoration-underline" href="<?= base_url() ?>">Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>