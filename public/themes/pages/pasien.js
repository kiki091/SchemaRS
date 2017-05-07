
function crudDataPasien() {
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
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

            edit: false,
            responseData: {},
        },

        watch: {
            showData: function() {
                this.fetchData()
            }
        },

        methods: {

            fetchData: function(){
                this.$http.get('/patient/data', []).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.responseData = response.data
                    } else {
                        pushNotifV3(response.status, response.message)
                    }
                })
            },

            clearErorrMessage: function(){
                $(".form--error--message").text('')
            },
            
            resetForm: function(){
                this.models.id = '',
                this.models.nik = '',
                this.models.fullname = '',
                this.models.gender = '',
                this.models.place_of_birth = '',
                this.models.date_of_birth = '',
                this.models.height = '',
                this.models.weight = '',
                this.models.street = '',
                this.models.districts = '',
                this.models.city = '',
                this.models.province = '',
                this.models.age = '',
                this.models.phone_number = '',
                this.models.description = '',
                this.models.religion = '',
                this.models.education = '',
                this.models.blood = '',
                this.models.work = '',
                this.models.citizen = '',
                this.models.country = '',
                this.models.marital_status = '',
                this.models.registration_id = '',
            },

        }

        /*ready: function () {
            this.fetchData()
        }*/
    });
}
