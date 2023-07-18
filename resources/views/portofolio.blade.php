<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Portofolio M.Zulkarnaen</title>
  <!-- Favicons -->
  <link href={{ asset('assets/img/profile.png') }} rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }} rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href={{ asset('assets/vendor/aos/aos.css') }} rel="stylesheet">
  <link href={{ asset('assets/vendor/aos/aos.css') }} rel="stylesheet">

  <link href={{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
  <link href={{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet">
  <link href={{ asset('assets/vendor/boxicons/css/boxicons.min.css') }} rel="stylesheet">
  <link href={{ asset('assets/vendor/glightbox/css/glightbox.min.css') }} rel="stylesheet">
  <link href={{ asset('assets/vendor/swiper/swiper-bundle.min.css') }} rel="stylesheet">
  <link href={{ asset('assets/css/style.css') }} rel="stylesheet">
  <style>
    .image-container img {
      width: 100%; 
      height: 200px; 
      object-fit: scale-down;
      color: red; 
    }
  </style>
</head>

<body>

  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="{{ $profile }}" alt="" class="img-fluid rounded-circle">


        <div class="social-links mt-3 text-center">
          @foreach ($media_social as $item)
           <a href="{{ $item['url'] }}" class={{strtolower($item['name'])}} target="_blank"><i class="{{$item['icon']}}"></i></a>
          @endforeach

        </div>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a></li>
          <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
          <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
          {{-- <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li> --}}
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1>M. Zulkarnaen</h1>
      <p>I'm <span class="typed" data-typed-items="Flutter Enthusiast, Laravel Enthusiast"></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
          <p>{{ $portofolio['about_header'] }}</p>
        </div>

        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <img src="{{ $profile }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3> {{ $portofolio['job'] }} </h3>
            <p class="fst-italic">
              Berikut adalah beberapa informasi tentang data diri saya:
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>{{ date("d F Y", strtotime($portofolio['tanggal_lahir'] )) }}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span>{{ $portofolio['website'] }}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>{{ $portofolio['kota'] }}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>{{ $umur }}</span></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span>{{ $portofolio['pendidikan'] }}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>{{ $portofolio['email'] }}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span>{{$portofolio['freelance']}}</span></li>
                </ul>
              </div>
            </div>
            
              
          <p>{{ $portofolio['about_footer'] }}</p>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
      <div class="container">

        <div class="section-title">
          <h2>Framework</h2>
          <p>Berikut ini merupakan beberapa framework yang pernah saya gunakan dalam membuat projek.</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
            <div class="card border-0" style="width: 18rem;">
              <div class="image-container">
                <img src="{{ asset('assets/img/framework/flutter.png') }}" class="card-img-top img-fluid" style="border: none;" alt="framework-image">
              </div>
              <div class="card-title text-center pt-2">
                <p class="h3"><strong>Flutter</strong></p>
                <p class="h5">Mobile Framework</p>
              </div>
            </div>  
          </div>
          
          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
            <div class="card border-0" style="width: 18rem;">
              <div class="image-container">
                <img src="{{ asset('assets/img/framework/laravel.png') }}" class="card-img-top img-fluid" style="border: none;" alt="framework-image">
              </div>
              <div class="card-title text-center pt-2">
                <p class="h3"><strong>Laravel</strong></p>
                <p class="h5">Web Framework</p>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </section><!-- End Facts Section -->

   
    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Resume</h2>
          <p>Jika Anda tertarik untuk mengetahui lebih lanjut tentang pengalaman kerja saya dan proyek-proyek yang telah saya selesaikan, silakan lihat resume saya yang terlampir di bawah. Terima kasih atas kunjungan Anda ke profil saya!</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Sumary</h3>
            <div class="resume-item pb-0">
              <h4>M. Zulkarnaen</h4>
              <p><em>Pengalaman saya selama lebih dari 1 tahun dalam pengembangan aplikasi mobile dan situs web menggunakan Flutter dan Laravel telah memperkuat keterampilan saya dalam menciptakan solusi teknologi yang unggul. Saya selalu bersemangat untuk memanfaatkan kemampuan pemrograman saya dalam menghadirkan aplikasi yang responsif dan situs web yang efisien.</em></p>
              <ul>
                <li>Selatpanjang, Riau Indonesia</li>
                <li>magerngulik@gmail.com</li>
              </ul>
            </div>

            <h3 class="resume-title">Education</h3>
            @foreach ($education as $item)
              <div class="resume-item">
                <h4>{{ $item['sekolah'] }}</h4>
                <h5>{{ $item['tahun_masuk'] }} - {{ $item['tahun_keluar'] }}</h5>
                <p><em>{{ $item['jurusan'] }}</em></p>
                <p>{{ $item['deskripsi'] }}</p>
              </div>                
            @endforeach
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Professional Experience</h3>
            @foreach ($experinces as $item)
              <div class="resume-item">
                <h4>{{ $item['pekerjaan'] }}</h4>
                <h5>{{ $item['tahun_masuk'] }} - {{ $item['tahun_keluar'] }}</h5>
                <p><em>{{ $item['posisi']}}, {{ $item['lokasi'] }}</em></p>
                <ul>
                  @foreach ($item->experience as $data)
                    <li>{{ $data['deskripsi_pekerjaan'] }}</li>  
                  @endforeach
                </ul>
              </div>
            @endforeach
           
            {{-- <div class="resume-item">
              <h4>Graphic design specialist</h4>
              <h5>2017 - 2018</h5>
              <p><em>Stepping Stone Advertising, New York, NY</em></p>
              <ul>
                <li>Developed numerous marketing programs (logos, brochures,infographics, presentations, and advertisements).</li>
                <li>Managed up to 5 projects or tasks at a given time while under pressure</li>
                <li>Recommended and consulted with clients on the most appropriate graphic design</li>
                <li>Created 4+ design presentations and proposals a month for clients and account managers</li>
              </ul>
            </div> --}}
          </div>
        </div>

      </div>
    </section><!-- End Resume Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>Hi, semuanya! Di sini, dengan senang hati, saya ingin berbagi beberapa proyek keren yang pernah saya kerjakan. Portofolio ini berisi sejumlah aplikasi mobile dan situs web yang telah saya kembangkan!</p>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              @foreach ($categorie as $item)
              <li data-filter=".filter-{{ $item['name'] }}">{{ $item['name'] }}</li>                  
              @endforeach
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
          
          @foreach ($project as $item)
          
          
          <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $item['kategori'] }}">
            <div class="portfolio-wrap">
              <img src="{{ $item['image'] }}" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="{{ $item['image'] }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $item['name'] }}"><i class="bx bx-plus"></i></a>
                <a href="{{ $item['url'] }}" title="More Details" target="blank"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>


          @endforeach

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    {{-- <section id="contact" class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(assets/img/overlay-bg.jpg);">
      <div class="overlay-mf" style="background-color: #0078ff;"></div>
      <div class="container bg-white">
        <div class="row">
          <div class="col-sm-12">

              <div id="contact" class="box-shadow-full py-3">
                <div class="row">
                  <p class="h3"><strong>Kontak Saya</strong></p>
                  <div class="col-md-8">
                    <p><em>Saya menghargai setiap kesempatan untuk berhubungan dengan rekan bisnis, mitra, atau siapa pun yang ingin berbagi gagasan dan pengalaman. Jangan ragu untuk mengirim pesan atau menelepon saya!</em></p>
                  </div>
                  <div class="social-links mt-3">
                    @foreach ($media_social as $item)
                      
                     <a href="{{ $item['url'] }}" class={{strtolower($item['name'])}} target="_blank"><i class="{{$item['icon']}}"></i></a>
                    @endforeach
                  </div>

                </div>
              </div>
          </div>
        </div>
      </div>
    </section> --}}

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>iPortfolio</span></strong>
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src={{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}></script>
  <script src={{ asset('assets/vendor/aos/aos.js') }}></script>
  <script src={{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
  <script src={{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}></script>
  <script src={{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}></script>
  <script src={{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}></script>
  <script src={{ asset('assets/vendor/typed.js/typed.umd.js') }}></script>
  <script src={{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}></script>
  <script src={{ asset('assets/vendor/php-email-form/validate.js') }}></script>

  <!-- Template Main JS File -->
  <script src={{ asset('assets/js/main.js') }}></script>

</body>

</html>