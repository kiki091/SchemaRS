<!-- top navigation -->
<div class="top_nav" id="template_change_password">
    <div class="nav_menu">
        <nav class="" role="navigation">

            <div class="toggle__sidebar">
                <div class="bar nav toggle">
                    <a id="menu_toggle">
                    <span class="bar-1"></span>
                    <span class="bar-2"></span>
                    <span class="bar-3"></span>
                    </a>
                </div>
            </div>
            <div class="header__selector__dropdown">
                <div class="dropdown__select__list" id="selector-dropdown">
                    <span class="display__name">{{ MAIN_LABLE_TITLE }}</span>
                </div>
            </div>

            <!-- <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div> -->

            <ul class="nav navbar-nav navbar-right">
                
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{ DataHelper::userEmail() }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="#" @click="showForm()">
                                <i class="fa fa-lock pull-right"></i> Change Password
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-sign-out pull-right"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="javascript:;" class="change-language dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if(Request::segment(1) == "id")
                        Bahasa
                    @else
                        Language
                    @endif
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a style="color: #2d2d2d" rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

            </ul>
        </nav>
    </div>

    <modal :show.sync="showModal">
    <div class="popup__mask popup--changepass">
        <div class="popup__wrapper popup--changepass__wrapper">
            <div class="popup__layer popup--changepass__layer">
                <div class="popup__layer--header">
                    <div class="header--title">
                        <h1>Change Password</h1>
                    </div>
                    <div class="header--btn">
                        <a href="#" class="btn__add__cancel" @click.prevent="closeForm">Close</a>
                    </div>
                </div>
                <div class="popup__notif">
                    <span>@{{ notif }}</span>
                </div>
                <div class="popup__layer--content">
                    <div class="content--main">
                        <!-- notification alert form popup -->
                        <!-- <div class="info--notif--popup notif--success"><span>@{{ notif }}</span></div> -->
                        <!-- ------------- -->
                        <div class="form__password">
                            <form action="#" method="POST" enctype="multipart/form-data" @submit.prevent>
                                <div class="new__form__field">
                                    <label>Old Password</label>
                                    <input v-model="models.old_password" type="password" class="new__form__input__field" name="old_pass" id="old-password-field">
                                    <div class="form--error--message"><span id="error-old-password"></span></div>
                                </div>
                                <div class="new__form__field">
                                    <label>New Password</label>
                                    <input v-model="models.new_password" type="password" class="new__form__input__field" name="new_pass" id="new-password-field">
                                    <div class="form--error--message"><span id="error-new-password"></span></div>
                                </div>
                                <div class="new__form__field">
                                    <label>Confirm Password</label>
                                    <input v-model="models.confirm_password" type="password" class="new__form__input__field" name="confirm_pass" id="confirm-password-field">
                                    <div class="form--error--message"><span id="error-confirm-password"></span></div>
                                </div>
                                <div class="new__form__btn">
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn__form__create submit-form" @click="changePassword()">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </modal>
</div>
<!-- /top navigation -->