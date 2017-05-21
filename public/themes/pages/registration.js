
function crudDataRegistration() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                registration_number : '',
                registration_date : '',
                id : '',
                nik : '',
                fullname : '',
                gender : '',
                place_of_birth : '',
                date_of_birth : '',
                height : '',
                weight : '',
                street : '',
                districts : '',
                city : '',
                province : '',
                age : '',
                phone_number : '',
                description : '',
                religion : '',
                education : '',
                blood : '',
                work : '',
                citizen : '',
                country : '',
                marital_status : '',
                registration_id : '',
            },
            medical_record : [],
            policlinic : {policlinic_name: ''},
            doctor : {fullname:''},
            medicament : {medicament_code: '', medicament_name:''},

            edit: false,
            responseData: {},
        },

        watch: {
            /*showData: function() {
                this.fetchData()
            }*/
        },

        methods: {

            fetchData: function(){
                this.$http.get('/registration/data', []).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.$set('responseData', response.data)
                    } else {
                        pushNotifV3(response.status, response.message)
                    }
                })
            },

            searchDataByNumber: function() {
                number = $('#filter-function-by-number').val();
                type = "search-by-nik"

                var domain  = laroute.url('registration/search', []);
                this.$http.get(domain+'?number='+number).then(function (response) {
                    response = response.data
                    this.$set('responseData', response.data)
                });
            },

            searchDataByNik: function() {
                param = $('#filter-function').val();
                type = "search-by-nik"

                var domain  = laroute.url('registration/search', []);
                this.$http.get(domain+'?param='+param).then(function (response) {
                    response = response.data
                    this.$set('responseData', response.data)
                });
            },

            showData: function(id) {
                registration_id = id

                var domain = laroute.url('registration/show', []);
                this.$http.get(domain+'?show='+registration_id).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.models = response.data
                        this.medical_record = response.data.medical_record
                        
                        $('.folder--nav').addClass('folder--hidden')
                        $('#toggle-detail-content').slideDown('swing')
                    } else {
                        pushNotifV3(response.status, response.message);
                    }
                })
            },

            storeData: function(event) {
                var vm = this;
                var optForm      = {

                    dataType: "json",

                    beforeSerialize: function(form, options) {
                        for (instance in CKEDITOR.instances)
                            CKEDITOR.instances[instance].updateElement();
                    },

                    beforeSend: function(){
                        showLoadingData(true)
                        vm.clearErrorMessage()
                    },
                    success: function(response){
                        if (response.status == false) {
                            if(response.is_error_form_validation) {

                                var message_validation = ''
                                $.each(response.message, function(key, value){
                                    $('input[name="' + key.replace(".", "_") + '"]').focus();
                                    $("#form--error--message--" + key.replace(".", "_")).text(value)
                                    message_validation += '<li class="notif__content__li"><span class="text" >' + value + '</span></li>'
                                });
                                pushNotifMessage(response.status,response.message, message_validation);

                            } else {
                                pushNotifV3(response.status, response.message);
                            }
                        } else {
                            vm.fetchData()
                            vm.resetForm()
                            pushNotifV3(response.status, response.message);
                            $('.btn__add__cancel').click();
                        }
                    },
                    complete: function(response){
                        hideLoading()
                    }

                };

                $("#FormDataRegistration").ajaxForm(optForm);
                $("#FormDataRegistration").submit();
            },  

            clearErrorMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){
                this.models.id = ''
                this.models.nik = ''
                this.models.fullname = ''
                this.models.gender = ''
                this.models.place_of_birth = ''
                this.models.date_of_birth = ''
                this.models.height = ''
                this.models.weight = ''
                this.models.street = ''
                this.models.districts = ''
                this.models.city = ''
                this.models.province = ''
                this.models.age = ''
                this.models.phone_number = ''
                this.models.description = ''
                this.models.religion = ''
                this.models.education = ''
                this.models.blood = ''
                this.models.work = ''
                this.models.citizen = ''
                this.models.country = ''
                this.models.marital_status = ''
                this.models.registration_id = ''
            },

        },

        ready: function () {
            this.fetchData()
        }
    });
}
