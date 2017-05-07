<!DOCTYPE html>
<html lang="en">

    <head>
        @include('Front.Includes.head')
    </head>
    <body>

        <!-- *** TOPBAR *** -->
        <div id="top">
            <div class="container">
                <div class="col-md-12 offer" data-animate="fadeInDown">
                </div>
                <div class="col-md-6" data-animate="fadeInDown">
                    <a class="navbar-brand home" href="{{route('homePage')}}" data-animate-hover="bounce">
                        <img src="{{asset('themes/front/img/logo-nusantara.png')}}" alt="Obaju logo" class="hidden-xs">
                        <img src="{{asset('themes/front/img/logo-nusantara.png')}}" alt="Obaju logo" class="visible-xs"><span class="sr-only">Nusantara Group</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- *** TOP BAR END *** -->

        <!-- *** NAVBAR *** -->
        @include('Front.Includes.navbar')
        <!-- *** NAVBAR END *** -->

        <div id="all">
            <!-- *** CONTENT *** -->
            <div id="content">
                <div class="container">
                    <div class="col-md-12">
                        <div class="row" id="error-page">
                            <div class="col-sm-12">
                                <div class="box">

                                    <p class="text-center">
                                        <h3>
                                            <i class="icon fa fa-warning"></i>
                                        </h3>
                                    </p>

                                    <h3>We are sorry - this page is not here anymore</h3>
                                    <h4 class="text-muted">Error 404 - Page not found</h4>

                                    <p class="text-center">To continue please use the <strong>Search form</strong> or <strong>Menu</strong> above.</p>

                                    <p class="buttons"><a href="index.html" class="btn btn-primary"><i class="fa fa-home"></i> Go to Homepage</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** CONTENT END *** -->

            <!-- *** FOOTER *** -->
            @include('Front.Includes.footer')
            <!-- *** FOOTER END *** -->

            <!-- *** COPYRIGHT *** -->
            <div id="copyright">
                <div class="container">
                    <div class="col-md-6">
                        <p class="pull-left">© 2016  Nusantara (Co. Reg. No. 1997000735D). All Rights Reserved.</p>

                    </div>
                </div>
            </div>
            <!-- *** COPYRIGHT END *** -->
        </div>
        <!-- /#all -->

        <script src="{{asset('themes/front/js/jquery-1.11.0.min.js')}}"></script>
        <script src="{{asset('themes/front/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('themes/front/js/jquery.cookie.js')}}"></script>
        <script src="{{asset('themes/front/js/waypoints.min.js')}}"></script>
        <script src="{{asset('themes/front/js/modernizr.js')}}"></script>
        <script src="{{asset('themes/front/js/bootstrap-hover-dropdown.js')}}"></script>
        <script src="{{asset('themes/front/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('themes/front/js/front.js')}}"></script>

        <!-- Start Vue Js Component -->
        <script src="{{asset('js/vue.js')}}"></script>
        <script src="{{asset('js/vue-min.js')}}"></script>
        <script src="{{asset('js/vue-resource.js')}}"></script>
        <script src="{{asset('themes/front/content/footer.js')}}"></script>
        <script src="{{asset('themes/front/content/news.js')}}"></script>
        <script src="{{asset('themes/front/content/contact-us.js')}}"></script>
        <script src="{{asset('themes/front/content/company-profile.js')}}"></script>

        <!-- End Vue Js Component -->
        
    </body>
</html>