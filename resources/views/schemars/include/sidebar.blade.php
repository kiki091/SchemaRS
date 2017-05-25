<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <img src="{{ asset(LOGO_IMAGES_DIRECTORY) }}" class="image-header">
        </div>

        <div class="clearfix"></div>
        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>{{ trans('general.title_lable_general') }}</h3>
                <ul class="nav side-menu">
                    
                    <li>
                        <a>
                          <i class="fa">
                              @include('schemars.svg-logo.sidebar.ico-pages')
                          </i>Pages <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="#registration" onclick="menuRegistration()">{{ trans('general.title_lable_registration') }}</a>
                            </li> 
                        </ul>
                    </li> 
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>