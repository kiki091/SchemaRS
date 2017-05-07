<!DOCTYPE html>
<html lang="en">

    <head>
        @include('nusantara.front.include.head-error')
    </head>
    <body data-spy="scroll" data-offset="0" data-target="#navbar-main">
        <div id="demo-content">
        
        <div id="loader-wrapper">
            <div id="loader"></div>

            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

        </div>
        <div id="content">
            <!-- *** NAVBAR *** -->
            @include('nusantara.front.include.navbar')
            <!-- *** NAVBAR END *** -->
            
            <!-- *** CONTENT *** -->
            
            <div class="col-md-12">
                <div id="error-banner-text">
                    <div class="container-fluid has-breakpoint">
                        <div class="row">
                            <div class="col-md-3 col-tablet-landscape-md-2"></div>
                            <div class="col-md-6 col-tablet-landscape-md-8">

                                <div id="error-banner-text-content">
                                    <h1 class="large-version">ERROR</h1>
                                    <p>Oops! The requested URL could not be retrieved</p>
                                    <div class="cta-container">
                                        <a href="{{ route('homePage') }}" class="arrow-cta back-version">back to home</a>
                                        <a href="{{ route('contactUsPage') }}" class="arrow-cta">contact us</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** CONTENT END *** -->
        </div>
        <script type="text/javascript">
            if ($('#back-to-top').length) {
                var scrollTrigger = 100, // px
                    backToTop = function () {
                        var scrollTop = $(window).scrollTop();
                        if (scrollTop > scrollTrigger) {
                            $('#back-to-top').addClass('show');
                        } else {
                            $('#back-to-top').removeClass('show');
                        }
                    };
                backToTop();
                $(window).on('scroll', function () {
                    backToTop();
                });
                $('#back-to-top').on('click', function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 700);
                });
            }
        </script>
        <script src="{{asset('themes/front/js/jquery-1.11.0.min.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('themes/front/shield/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('themes/front/shield/js/retina.js')}}"></script>
        <script type="text/javascript" src="{{asset('themes/front/shield/js/jquery.easing.1.3.js')}}"></script>
        <script type="text/javascript" src="{{asset('themes/front/shield/js/smoothscroll.js')}}"></script>
        <script type="text/javascript" src="{{asset('themes/front/shield/js/jquery-func.js')}}"></script>

        <!-- Start Vue Js Component -->
        <script src="{{asset('js/vue.js')}}"></script>
        <script src="{{asset('js/vue-min.js')}}"></script>
        <script src="{{asset('js/vue-resource.js')}}"></script>
        <script src="{{asset('themes/front/content/booking-service.js')}}"></script>
        <script src="{{asset('themes/front/content/booking-test-drive.js')}}"></script>
        <script src="{{asset('themes/front/content/footer.js')}}"></script>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{asset("themes/front/animation/loading/js/jquery-1.9.1.min.js")}}"><\/script>')</script>
        <script src="{{asset('themes/front/animation/loading/js/main.js')}}"></script>

    </body>
</html>