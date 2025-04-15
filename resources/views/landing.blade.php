<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Welcome to Our Platform</title>
  <meta name="description" content="Explore our services in Crypto, VTU, and Gift Cards.">
  <meta name="keywords" content="crypto, vtu, gift cards">

  <!-- Favicons -->
  <link href="{{ asset('assets_land/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets_land/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets_land/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets_land/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets_land/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets_land/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <!-- Header -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">DavyKing</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#contact">Contact</a></li>
          {{-- @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
          @else
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          @endguest --}}
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="container text-center">
        <div class="row justify-content-center" data-aos="zoom-out">
          <div class="col-lg-8">
            <h2>Welcome to DavyKing</h2>
            <p>Your one-stop solution for Crypto Trading, VTU Services, and Gift Card Management.</p>
            <a href="#services" class="btn-get-started">Explore Our Services</a>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- Services Section -->
    <section id="services" class="services section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Services</h2>
        <p>Discover the range of services we offer to meet your needs.</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <!-- Crypto Service -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-currency-bitcoin"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Crypto Trading</a></h4>
                <p class="description">Trade cryptocurrencies like Bitcoin, Ethereum, and more with ease and security.</p>
              </div>
            </div>
          </div>

          <!-- VTU Service -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-phone"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">VTU Services and Bill Payment</a></h4>
                <p class="description">Top up airtime, data, pay TV subscriptions, and electricity bills seamlessly.</p>
              </div>
            </div>
          </div>

          <!-- Gift Cards Service -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-gift"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Gift Cards</a></h4>
                <p class="description">Buy, sell, and manage gift cards from various brands effortlessly.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-gift"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Pay Tv subscriptions</a></h4>
                <p class="description">Pay your dstv, gotv subscriptions</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Services Section -->

    <!-- Download App Section -->
    <section id="download-app" class="download-app section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Download Our App</h2>
        <p>Get the DavyKing app on your mobile device for a seamless experience.</p>
      </div>

      <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <p>Download the app now and manage your Crypto, VTU, and Gift Card services on the go!</p>
            <div class="download-buttons">
              <a href="https://play.google.com/store/apps/details?id=com.example.davyking" class="btn btn-primary" target="_blank">
                <i class="bi bi-google-play"></i> Google Play
              </a>
              <a href="https://www.apple.com/app-store/" class="btn btn-primary" target="_blank">
                <i class="bi bi-apple"></i> App Store
              </a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Download App Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Get in touch with us for any inquiries or support.</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="row gy-4">
          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>VI, Lagos, Nigeria</p>
              </div>
            </div>
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+1 5589 55488 55</p>
              </div>
            </div>
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>davykingexchange@info.com.ng</p>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <form action="{{ url('contact') }}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              @csrf
              <div class="row gy-4">
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>
                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>
                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                  <button type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- /Contact Section -->

  </main>

  <!-- Footer -->
  <footer id="footer" class="footer dark-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ url('/') }}" class="d-flex align-items-center">
            <span class="sitename">DavyKing</span>
          </a>
          <div class="footer-contact pt-3">
            <p>VI</p>
            <p>Lagos, Nigeria</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@davykingexchange.com.ng</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#hero">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#contact">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">DavyKing</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">mgeniusoftware</a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets_land/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets_land/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets_land/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets_land/js/main.js') }}"></script>
</body>

</html>