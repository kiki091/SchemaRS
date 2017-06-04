
function crudDataRegistrationInpatient() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                registration_id : '',
                registration_number : '',
                registration_date : '',
                id : '',
                nik : '',
                fullname : '',
                person_in_charge : '',
                relation_family : '',
                hospital_name : '',
                description_reference : '',
                phone_number : '',
                type_reference : '',
                complaint_of_felt : '',
                registration_note : '',
                room_care_id : '',
                doctor_id : '',
            },

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
                this.$http.get('/registration/inpatient/data', []).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.$set('responseData', response.data)
                    } else {
                        pushNotifV3(response.status, response.message)
                    }
                })
            },

            searchFormDataByNumber: function() {
                number = $('#form-filter-function-by-number').val();

                var domain  = laroute.url('registration/inpatient/form-search', []);
                this.$http.get(domain+'?number='+number).then(function (response) {
                    response = response.data
                    this.$set('models', response.data.registration)
                });
            },

            searchDataByNumber: function() {
                number = $('#filter-function-by-number').val();
                type = "search-by-nik"

                var domain  = laroute.url('registration/inpatient/search', []);
                this.$http.get(domain+'?number='+number).then(function (response) {
                    response = response.data
                    this.$set('responseData', response.data)
                });
            },

            searchDataByNik: function() {
                param = $('#filter-function').val();
                type = "search-by-nik"

                var domain  = laroute.url('registration/inpatient/search', []);
                this.$http.get(domain+'?param='+param).then(function (response) {
                    response = response.data
                    this.$set('responseData', response.data)
                });
            },

            showData: function(id) {
                registration_id = id

                var domain = laroute.url('registration/inpatient/show', []);
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

                $("#FormDataRegistrationInpatient").ajaxForm(optForm);
                $("#FormDataRegistrationInpatient").submit();
            },  

            clearErrorMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){
                this.models.registration_id = ''
                this.models.person_in_charge = ''
                this.models.relation_family = ''
                this.models.phone_number = ''
                this.models.type_reference = ''
                this.models.complaint_of_felt = ''
                this.models.registration_note = ''
                this.models.room_care_id = ''
                this.models.doctor_id = ''

                $('#form-filter-function-by-number').val('')

                $('select').prop('selectedIndex', 0);
                $('textarea').val('');
            },

        },

        ready: function () {
            this.fetchData()
        }
    });
}
