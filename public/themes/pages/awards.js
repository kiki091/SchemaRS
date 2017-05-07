
function crudAwards() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            banner:{
                id:'',
                title: '',
                images : '',
            },

            models: {
                id:'',
                office_name: '',
                thumbnail: '',
                filename : '',
                awards: [
                    { description: ''}
                ],
                meta_title : '',
                meta_keyword : '',
                meta_description : '',
            },

            thumbnail: '',
            filename : '',
            images : '',
            awards: [
                { description: ''}
            ],
            delete_payload: {
                id: '',
            },
            form_add_title_banner: "Banner",
            form_add_title: "Awards",
            sectionDelete : 'awards',
            default_total_description : [0],
            total_description : [],
            id: '',
            edit: false,
            responseData: {},
        },
        methods: {

            addMoreDescription: function() {
                this.models.awards.splice(this.models.awards.length + 1, 0, {description: '',});
            },

            removeMoreDescription: function(item, index) {
                this.models.awards.$remove(item);
            },

            showDeleteModal: function(id, sectionDelete) {
                this.showModal = true;
                this.delete_payload.id = id;
                this.sectionDelete = sectionDelete

                $('.popup__mask__alert').addClass('is-visible');

                // add class di container saat popup
                $('.main_container').addClass('popupContainer');
            },

            closeDeleteModal: function() {
                this.showModal = false;

                // remove class di container saat popup
                setTimeout(function() {
                    $('.popup__mask__alert').removeClass('is-visible');
                }, 300);
            },

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

            fetchData: function(){
                this.$http.get('/awards/data', []).then(function (response) {
                    if(response.data.status == true) {
                        this.$set('responseData', response.data.data)
                    } else {
                        pushNotifV3(response.data.status, response.data.message)
                    }
                })
            },

            storeData: function(event){

                var vm = this;
                var optForm      = {

                    dataType: "json",

                    beforeSend: function(){
                        showLoadingData(true)
                        vm.clearErorrMessage()
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

                $("#FormBannerAwards").ajaxForm(optForm);
                $("#FormBannerAwards").submit();
            },

            storeDataAwards: function(event){

                var vm = this;
                var optForm      = {

                    dataType: "json",

                    beforeSerialize: function(form, options) {
                        for (instance in CKEDITOR.instances)
                            CKEDITOR.instances[instance].updateElement();
                    },
                    beforeSend: function(){
                        showLoadingData(true)
                        vm.clearErorrMessage()
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

                $("#AwardsForm").ajaxForm(optForm);
                $("#AwardsForm").submit();
                
            },

            editBanner: function (id) {
                this.edit = true
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.resetForm()

                this.$http.post('/awards/edit-banner', form).then(function(response) {
                    response = response.data
                    if (response.status) {
                        this.banner = response.data;
                        this.images = response.data.image_url

                        this.form_add_title = "Edit Main Banner Awards"
                        $('.btn_add_banner').click()

                    } else {
                        pushNotifV3(response.status,response.message)
                    }
                })
            },

            editData: function (id) {
                this.edit = true
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                this.resetForm()

                var domain = '/awards/edit';
                this.$http.post(domain, form).then(function(response) {

                    response = response.data
                    if (response.status) {
                        this.models = response.data;
                        this.thumbnail = response.data.thumbnail_url
                        this.filename = response.data.filename_url
                        this.total_description = response.data.total_description

                        this.default_total_description = []

                        this.form_add_title = "Edit Awards"
                        $('.btn_add_awards').click()

                    } else {
                        pushNotifV3(response.status,response.message)
                    }
                })
            },

            changeStatusBanner: function(id) {
                console.log(id)
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/awards/change-status-banner';
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

            changeStatus: function(id) {
                
                var payload = []
                payload['id'] = id

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain = '/awards/change-status';
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

            deleteDataBanner: function(id) {
                
                var domain = '/awards/delete-banner';
                var form = new FormData();

                form.append('id', id);
                
                this.$http.post(domain, form).then(function (response) {
                    response = response.data
                    if (response.status === true)
                    {
                        this.delete_payload.id = '';
                        this.fetchData()
                        pushNotifV3(response.status, response.message);
                    }

                    this.showModal = false
                    setTimeout(function() {
                        $('.popup__mask__alert').removeClass('is-visible');
                    }, 300);
                    pushNotifV3(response.status, response.message);
                });
            },

            deleteData: function(id) {
                
                var domain = '/awards/delete';
                var form = new FormData();

                form.append('id', id);
                
                this.$http.post(domain, form).then(function (response) {
                    response = response.data
                    if (response.status === true)
                    {
                        this.delete_payload.id = '';
                        this.fetchData()

                        pushNotifV3(response.status, response.message);
                    }

                    this.showModal = false
                    setTimeout(function() {
                        $('.popup__mask__alert').removeClass('is-visible');
                    }, 300);
                    pushNotifV3(response.status, response.message);
                });
            },

            clearErorrMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){

                this.models.awards = [
                    { description : '',}
                ]

            	this.models.id = ''
                this.models.office_name = ''
                this.models.meta_title = ''
                this.models.meta_keyword = ''
                this.models.meta_description = ''

                this.thumbnail = ''
                this.filename = ''
                this.default_total_description = [0];
                this.total_description = [];
            },

            resetFormBanner: function() {
                this.banner.title = ''
                this.banner.id = ''
                this.images = ''
            },

            sortable: function() {
                var vm = this;

                setTimeout(function(){
                    Sortable.create(document.getElementById('sort'), {
                        draggable: 'li.sort-item',
                        ghostClass: "sort-ghost",
                        handle: '.handle',
                        animation: 300,
                        onUpdate: function(evt) {
                            vm.reorder(evt.oldIndex, evt.newIndex);
                        }
                    });

                }, 100);
            },

            sortableBanner: function() {
                var vm = this;

                setTimeout(function(){
                    Sortable.create(document.getElementById('sort-banner'), {
                        draggable: 'li.sort-item-banner',
                        ghostClass: "sort-ghost",
                        handle: '.handle',
                        animation: 300,
                        onUpdate: function(evt) {
                            vm.reorderBanner(evt.oldIndex, evt.newIndex);
                        }
                    });

                }, 100);
            },

            reorder: function(oldIndex, newIndex) {
                //get id list
                var ids = document.getElementsByClassName('sort-item'),
                    id_order  = [].map.call(ids, function(input) {
                        return input.getAttribute('data-id');
                    });

                var domain  = '/awards/order';

                var payload = {list_order: id_order };

                this.$http.post(domain, payload).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotifV3(response.status, response.message);
                    }
                    this.fetchData()
                    pushNotifV3(response.status, response.message);
                });
            },

            reorderBanner: function(oldIndex, newIndex) {
                //get id list
                var ids = document.getElementsByClassName('sort-item-banner'),
                    id_order  = [].map.call(ids, function(input) {
                        return input.getAttribute('data-id');
                    });

                var domain  = '/awards/order-banner';

                var payload = {list_order: id_order };

                this.$http.post(domain, payload).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotifV3(response.status, response.message);
                    }
                    this.fetchData()
                    pushNotifV3(response.status, response.message);
                });
            },

        },

        ready: function () {
            this.sortable()
            this.sortableBanner()
            this.fetchData()
        }
    });
}
