 <!-- blog details area start here -->
 <section class="blog-details-area pt-120 pb-70">
     <div class="container">
         <div class="tp-custom-container-box">
             <div class="row">
                 <div class="col-lg-8">
                     <div class="blog__details--wrapper mr-50 mb-50">
                         <div class="ablog mb-55">
                             <div class="ablog__img wow fadeInUp">
                                 <img src="<?= base_url() ?>assets/backend/upload/<?= $news->foto ?>" class="img-fluid"
                                     alt="img">
                             </div>
                             <div class="ablog__text mt-3">
                                 <div class="ablog__meta ablog__meta4">
                                     <ul>
                                         <li><i class="far fa-calendar-check"></i>
                                             <?= date('d M Y', strtotime($news->created_at)) ?></li>
                                         <li><i class="far fa-user"> </i> <?= $news_join->nama ?></li>
                                         </li>
                                     </ul>
                                 </div>
                                 <h3 class="mb-20"><?= $news->judul ?>
                                 </h3>
                                 <?= $news->isi ?>
                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="ablog__sidebar mb-50">
                         <div class="widget mb-45 wow fadeInUp">
                             <h3 class="sidebar__widget--title mb-30">Recent News </h3>


                             <!-- <div class="sidebar--widget__post mb-20">
                                 <div class="sidebar__post--thumb">
                                     <a href="blog-details.html">
                                         <div class="post__img" data-background="assets/img/blog/b7.jpg"></div>
                                     </a>
                                 </div>
                                 <div class="sidebar__post--text">
                                     <h4 class="sidebar__post--title"><a href="blog-details.html">TikTok Influencer
                                             Marketing: <br>How to Work</a></h4>
                                     <span>January 15, 2021</span>
                                 </div>
                             </div> -->
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- blog details area end here -->

 </main>