<main class="bg-gray-light">
    <!-- breadcrumb area start -->
    <section class="breadcrumb bg">
        <div class="row">
            <div class="col">
                <h3>DHI News</h3>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->
    
    <?php if(!empty($news->result())) { ?>
     <section class="blog-sidebar-area pt-30 pb-30">
        <div class="container">
            <div class="tp-custom-container-box">
                <div class="row">
                    <?php foreach ($news->result() as $row) { ?>
                    <div class="col-lg-6">
                        <div class="ablog__sidebar--wrapper mr-50">
                            <div class="ablog ablog-4 mb-55 wow fadeInUp" data-wow-delay=".4s">
                                <div class="ablog__img">
                                    <img style="border-radius:12px 12px 0px 0px"
                                        src="<?= base_url() ?>assets/backend/upload/<?= $row->foto ?>" class="img-fluid"
                                        alt="img">
                                </div>
                                <div class="ablog__text ablog__text4">
                                    <div class="ablog__meta ablog__meta4">
                                        <ul>
                                            <li><i class="far fa-calendar"></i>
                                                <?= date('d M Y', strtotime($row->created_at)) ?> </li>
                                        </ul>
                                    </div>
                                    <h3 class="ablog__text--title4"><a
                                            href="<?= base_url('dhi_news/detail/' . $row->slug) ?>"><?= $row->judul ?></a>
                                    </h3>
                                    <p class=""><?= substr($row->isi, 0, 150) ?>..</p>
                                    <div class="ablog__btn4 mt-3">
                                        <a href="<?= base_url('dhi_news/detail/' . $row->slug) ?>" class="theme-btn"><i
                                                class="flaticon-enter"></i>
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="basic-pagination mt-10 wow fadeInUp" data-wow-delay=".5s">
                            <ul>
                                <li><span aria-current="page" class="page-numbers current">1</span></li>
                                <li><a class="page-numbers" href="#">2</a></li>
                                <li><a class="page-numbers" href="#">3</a></li>
                                <li><a class="next page-numbers" href="#">
                                        <i class="fal fa-long-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <?php } else { ?>
   <section class="blog-sidebar-area pt-120 pb-120">
        <div class="container">
            <div class="tp-custom-container-box d-flex justify-content-center">
               <h5>Belum Ada Berita</h3>
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="basic-pagination mt-10 wow fadeInUp" data-wow-delay=".5s">
                            <ul>
                                <li><span aria-current="page" class="page-numbers current">1</span></li>
                                <li><a class="page-numbers" href="#">2</a></li>
                                <li><a class="page-numbers" href="#">3</a></li>
                                <li><a class="next page-numbers" href="#">
                                        <i class="fal fa-long-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <?php } ?>


</main>