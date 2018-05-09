<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Barangay Clearance</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/creative.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">



    <style type="text/css">
        header.masthead {
            position: relative;
            width: 100%;
            min-height: auto;
            text-align: center;
            color: #fff;
            background-image: url(resources/assets/img/header.jpg) !important;
            background-position: center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

  </head>
    <body id="page-top">
            
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <a class="navbar-brand" href="#page-top">Barangay Clearance</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

             @if (Route::has('login'))
                     <ul class="navbar-nav ml-auto">
                    @if (Auth::check())
                     <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    @else
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/barangaylocation') }}">Barangay Location</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('/barangayofficials') }}">Barangay Officials</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                      </li>

                    @endif
                    </ul>
            @endif

     
      </div>
    </nav>

     @include('includes.jumbotron')

    <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">
  We are responsible for your concern</h2>
            <hr class="light">
            <p class="text-faded">Mission: </br>
TO ENHANCE THE BARANGAY TO BE MORE EFFECTIVE WITH GOD'S FEARING TRUE, HONEST AND GENUINE SERVICE TO THE PEOPLE</p>
            <a class="btn btn-default btn-xl sr-button" href="#services" data-sr-id="6" style="; visibility: visible;  -webkit-transform: translateY(20px) scale(0.9); opacity: 0;transform: translateY(20px) scale(0.9); opacity: 0;">Get Started!</a>
          </div>
        </div>
      </div>
    </section>

    <section class="p-0" id="portfolio">
      <div class="container-fluid">
        <div class="row no-gutter popup-gallery">
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="resources/assets/img/11.jpg">
              <img class="img-fluid" src="resources/assets/img/11.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Processing Office
                  </div>
                  <div class="project-name">
                    Certification
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="resources/assets/img/2.jpg">
              <img class="img-fluid" src="resources/assets/img/2.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Admin
                  </div>
                  <div class="project-name">
                   Consultation
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="resources/assets/img/3.jpg">
              <img class="img-fluid" src="resources/assets/img/3.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Function Room
                  </div>
                  <div class="project-name">
                    Meeting Agenda
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="resources/assets/img/12.jpg">
              <img class="img-fluid" src="resources/assets/img/12.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Releasing Office
                  </div>
                  <div class="project-name">
                    Resident Concern
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="resources/assets/img/5.jpg">
              <img class="img-fluid" src="resources/assets/img/5.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                   information office
                  </div>
                  <div class="project-name">
                    
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="resources/assets/img/6.jpg">
              <img class="img-fluid" src="resources/assets/img/6.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                   Registration office
                  </div>
                  <div class="project-name">
                    clearance
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>


    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Bucana Purok 5 Brgy.76-A,Davao City</h2>
            <hr class="primary">
            <p>Call 0930 367 189</p>
             <p>Connected 24/7
         a Fast way Of Transaction</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fa fa-phone fa-3x sr-contact" data-sr-id="9" style="; visibility: visible;  -webkit-transform: scale(0.3); opacity: 0;transform: scale(0.3); opacity: 0;"></i>
            <p>123-456-6789</p>
          </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fa fa-envelope-o fa-3x sr-contact" data-sr-id="10" style="; visibility: visible;  -webkit-transform: scale(0.3); opacity: 0;transform: scale(0.3); opacity: 0;"></i>
            <p>
              <a href="mailto:your-email@your-domain.com">info@barangayclearance.com</a>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/creative.min.js') }}"></script>



  


</body>
        </div>
    </body>
</html>
