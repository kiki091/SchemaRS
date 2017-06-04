
function crudDataDoctor() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var token = $("#_token").attr("value")

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                nik : '',
                fullname : '',
                gender : '',
                street : '',
                districts : '',
                city : '',
                province : '',
                phone_number : '',
                education : '',
                religion : '',
                place_of_birth : '',
                date_of_birth : '',
                specialist : '',
                marital_status : '',
                citizen : '',
                poliklinik_id : '',
                country : '',
                id : '',
            },
            foto_images : '',
            form_add_title : 'Form Data Doctor',
            edit: false,
            responseData: {},
        },

        watch: {
            /*showData: function() {
                this.fetchData()
            }*/
        },

        methods: {

            onImageChange: function(element, e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;

                this.models[element] = files[0]
                this.createImage(files[0], element);
            },

            createImage: function(file, setterTo) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function (e) {
                    vm[setterTo] = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            removeImage: function (variable) {
                this[variable] = '';
                this.models[variable] = ''
            },


            fetchData: function() {
                
                this.$http.get('/doctor/data', []).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.$set('responseData', response.data)
                    } else {
                        pushNotifV3(response.status, response.message)
                    }
                })
            },

            searchDataByNik: function() {
                nik = $('#filter-function-nik').val();
                type = "search-by-nik"

                var domain  = laroute.url('doctor/search', []);
                this.$http.get(domain+'?nik='+nik).then(function (response) {
                    response = response.data
                    this.$set('responseData', response.data)
                });
            },

            searchDataByPoliName: function() {
                poli_name = $('#filter-function-poliklinik').val();
                type = "search-by-nik"

                var domain  = laroute.url('doctor/search', []);
                this.$http.get(domain+'?poli-name='+poli_name).then(function (response) {
                    response = response.data
                    this.$set('responseData', response.data)
                });
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

                $("#FormDataDoctor").ajaxForm(optForm);
                $("#FormDataDoctor").submit();
            }, 

            editData: function(id) {

                this.edit = true
                var payload = []
                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.resetForm()

                this.$http.post('/doctor/edit', form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.models = response.data;
                        this.foto_images = response.data.foto_images_url

                        this.form_add_title = "Edit Data Doctor"
                        $('.btn__add').click()

                    } else {
                        pushNotifV3(response.status,response.message)
                    }
                })
            },

            changeStatus: function(id) {
                
                var payload = []
                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/doctor/change-status';
                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotifV3(response.status,response.message);
                    }
                    else{

                        this.fetchData()
                        pushNotifV3(response.status,response.message);
                    }
                })
            },

            clearErrorMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){
                this.models.nik = ''
                this.models.fullname = ''
                this.models.gender = ''
                this.models.street = ''
                this.models.districts = ''
                this.models.city = ''
                this.models.province = ''
                this.models.phone_number = ''
                this.models.education = ''
                this.models.religion = ''
                this.models.place_of_birth = ''
                this.models.date_of_birth = ''
                this.models.specialist = ''
                this.models.marital_status = ''
                this.models.citizen = ''
                this.models.poliklinik_id = ''
                this.models.country = ''
                this.models.id = ''

                this.foto_images = ''
            },

        },

        ready: function () {
            this.fetchData()
        }
    });
}
