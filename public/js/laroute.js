(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"\/","name":"homePage","action":"App\Http\Controllers\Front\LandingController@index"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"contact-us","name":"contactUsPage","action":"App\Http\Controllers\Front\ContactUsController@index"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"contact-us\/data","name":"GetDataDontactUsPage","action":"App\Http\Controllers\Front\ContactUsController@getData"},{"host":"locnusantara.com","methods":["POST"],"uri":"contact-us\/create","name":"contactUsPageStore","action":"App\Http\Controllers\Front\ContactUsController@store"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"berita","name":"newsPage","action":"App\Http\Controllers\Front\NewsController@index"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"berita\/data","name":"GetDataNewsPage","action":"App\Http\Controllers\Front\NewsController@getData"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"event\/category\/{slug}","name":"categoryEvent","action":"App\Http\Controllers\Front\ServiceController@category"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"event\/{slug}","name":"detailEvent","action":"App\Http\Controllers\Front\ServiceController@detail"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"profil\/perusahaan","name":"companyProfilePage","action":"App\Http\Controllers\Front\CompanyProfileController@index"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"profil\/visi-misi","name":"companyVisiMisiPage","action":"App\Http\Controllers\Front\CompanyVisiMisiController@index"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"profil\/visi-misi\/data","name":"companyVisiMisiPageGetData","action":"App\Http\Controllers\Front\CompanyVisiMisiController@getData"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"profil\/sejarah-perusahaan","name":"companyHistoryPage","action":"App\Http\Controllers\Front\CompanyHistoryController@index"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"profil\/kantor-cabang\/{slug}","name":"branchOfficeDetail","action":"App\Http\Controllers\Front\CompanyBranchOfficeController@getDetail"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"profil\/penghargaan","name":"awardsPage","action":"App\Http\Controllers\Front\AwardsController@index"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"promosi\/category","name":"promotionCategory","action":"App\Http\Controllers\Front\PromotionController@promotionCategory"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"promosi\/category\/{slug_category}","name":"promotionCategoryList","action":"App\Http\Controllers\Front\PromotionController@promotion"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"promosi\/category\/detail\/{slug}","name":"promotionDetail","action":"App\Http\Controllers\Front\PromotionController@promotionDetail"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"promosi\/booking-service","name":"bookingServices","action":"App\Http\Controllers\Front\PromotionController@bookingServices"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"promosi\/booking-service\/data","name":"getLocationBookingServices","action":"App\Http\Controllers\Front\PromotionController@getDataLocation"},{"host":"locnusantara.com","methods":["POST"],"uri":"promosi\/booking-service\/store","name":"storeBookingServices","action":"App\Http\Controllers\Front\PromotionController@storeBookingServices"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"promosi\/test-drive","name":"testDrive","action":"App\Http\Controllers\Front\PromotionController@testDrive"},{"host":"locnusantara.com","methods":["POST"],"uri":"promosi\/test-drive\/store","name":"storeTestDrive","action":"App\Http\Controllers\Front\PromotionController@storeBookingTestDrive"},{"host":"locnusantara.com","methods":["GET","HEAD"],"uri":"karir","name":"carier","action":"App\Http\Controllers\Front\CairerController@index"},{"host":"locnusantara.com","methods":["POST"],"uri":"subscribe-mail","name":"subscribeMail","action":"App\Http\Controllers\Front\SubscribeMailController@store"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"\/","name":"login","action":"App\Http\Controllers\Cms\AuthController@index"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"auth","name":"authenticate","action":"App\Http\Controllers\Cms\AuthController@authenticate"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Cms\AuthController@logout"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"dashboard","name":"CmsDashboard","action":"App\Http\Controllers\Cms\DashboardController@index"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"booking-services","name":"BookingServices","action":"App\Http\Controllers\Cms\pages\BookingServicesController@index"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"booking-services\/data","name":"getDataBookingServices","action":"App\Http\Controllers\Cms\pages\BookingServicesController@getData"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"booking-services\/store","name":"storeBookingServices","action":"App\Http\Controllers\Cms\pages\BookingServicesController@store"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"booking-services\/show","name":"showDataBookingServices","action":"App\Http\Controllers\Cms\pages\BookingServicesController@showData"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"booking-services\/search","name":"searchBookingServices","action":"App\Http\Controllers\Cms\pages\BookingServicesController@searchData"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"static-page","name":"StaticPage","action":"App\Http\Controllers\Cms\pages\StaticPageController@index"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"static-page\/data","name":"StaticPageGetData","action":"App\Http\Controllers\Cms\pages\StaticPageController@getData"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"static-page\/store","name":"StoreStaticPage","action":"App\Http\Controllers\Cms\pages\StaticPageController@store"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"static-page\/edit","name":"EditStaticPage","action":"App\Http\Controllers\Cms\pages\StaticPageController@edit"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"static-page\/change-status","name":"ChangeStatusStaticPage","action":"App\Http\Controllers\Cms\pages\StaticPageController@changeStatus"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"main-banner","name":"MainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@index"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"main-banner\/data","name":"MainBannerGetData","action":"App\Http\Controllers\Cms\pages\MainBannerController@getData"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"main-banner\/store","name":"StoreMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@store"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"main-banner\/edit","name":"EditMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@edit"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"main-banner\/change-status","name":"ChangeStatusMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@changeStatus"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"main-banner\/order","name":"OrderMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@order"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"main-banner\/delete","name":"DeleteMainBanner","action":"App\Http\Controllers\Cms\pages\MainBannerController@delete"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"branch-office","name":"BranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@index"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"branch-office\/data","name":"GetDataBranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@getData"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"branch-office\/store","name":"StoreBranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@store"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"branch-office\/edit","name":"EditBranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@edit"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"branch-office\/order","name":"OrderDataBranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@order"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"branch-office\/change-status","name":"ChangeStatusBranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@changeStatus"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"branch-office\/delete","name":"DeleteBranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@delete"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"branch-office\/edit-slider","name":"BranchOfficeEditImageSlider","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@editImageSlider"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"branch-office\/delete-image-slider","name":"DeleteImageSliderBranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@deleteImageSlider"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"branch-office\/delete-office-detail","name":"DeleteDetailBranchOffice","action":"App\Http\Controllers\Cms\pages\BranchOfficeController@deleteOfficeDetail"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"awards","name":"Awards","action":"App\Http\Controllers\Cms\pages\AwardsController@index"},{"host":"loccms.nusantara.com","methods":["GET","HEAD"],"uri":"awards\/data","name":"AwardsGetData","action":"App\Http\Controllers\Cms\pages\AwardsController@getData"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/store","name":"AwardsStore","action":"App\Http\Controllers\Cms\pages\AwardsController@store"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/store-banner","name":"AwardsStoreBanner","action":"App\Http\Controllers\Cms\pages\AwardsController@storeBanner"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/edit","name":"AwardsEditData","action":"App\Http\Controllers\Cms\pages\AwardsController@edit"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/edit-banner","name":"AwardsEditBanner","action":"App\Http\Controllers\Cms\pages\AwardsController@editBanner"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/order","name":"AwardsOrderData","action":"App\Http\Controllers\Cms\pages\AwardsController@order"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/order-banner","name":"AwardsOrderBanner","action":"App\Http\Controllers\Cms\pages\AwardsController@orderBanner"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/change-status","name":"AwardsChangeStatus","action":"App\Http\Controllers\Cms\pages\AwardsController@changeStatus"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/change-status-banner","name":"AwardsChangeStatusBanner","action":"App\Http\Controllers\Cms\pages\AwardsController@changeStatusBanner"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/delete","name":"AwardsDeleteData","action":"App\Http\Controllers\Cms\pages\AwardsController@delete"},{"host":"loccms.nusantara.com","methods":["POST"],"uri":"awards\/delete-banner","name":"AwardsDeleteBanner","action":"App\Http\Controllers\Cms\pages\AwardsController@deleteBanner"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

