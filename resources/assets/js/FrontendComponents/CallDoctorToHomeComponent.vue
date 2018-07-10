<template>
    <div class="col-md-12">
        <h1 class="text-center display-3 text-primary">Виклик лікаря</h1>
        <form v-on:submit.prevent="registration">
            <p class="error alert alert-danger" role="alert" v-if="serverError">Сталась помилка при виклику лікаря</p>
            <div class="form-group">
            <label for="name">Імя:</label>
                <p class="error" v-if="errors.name">Довжина іменні повина бути більше ніж 3 символа</p>
                <input v-model="data.name" type="text" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="subname">Прізвище:</label>
            <p class="error" v-if="errors.second_name">Довжина прізвища повина бути більше ніж 3 символа</p>
            <input v-model="data.second_name" type="text" class="form-control" id="subname">
        </div>
        <div class="form-group">
            <label for="last_name">Побатькові:</label>
            <p class="error" v-if="errors.last_name">Довжина побатькові повина бути більше ніж 3 символа</p>
            <input v-model="data.last_name" type="text" class="form-control" id="last_name">
        </div>
        <div class="form-group">
            <label for="address">Адресса проживання:</label>
            <p class="error" v-if="errors.address">Невірно вказана адресса</p>
            <input v-model="data.address" type="text" class="form-control" id="address">
        </div>
        <div class="form-group">
            <label for="phone">Номер телефона:</label>
            <p class="error" v-if="errors.phone">Довжина телефона повина бути більше ніж 3 символа</p>
            <input v-model="data.phone" type="text" class="form-control" id="phone">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <p class="error" v-if="errors.email">Невірно введений емейл</p>
            <input v-model="data.email" type="text" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="description">Опис проблеми:</label>
            <p class="error" v-if="errors.description">Опишіть проблему</p>
            <textarea v-model="data.description" class="form-control" rows="5" id="description"></textarea>
        </div>
        <div v-if="success" class="alert alert-success" role="alert">
             <strong>Виклик завершений!</strong> З вами звяжуться ближчим часом
        </div>
        <input type="submit" class="btn btn-primary" :disabled="callDoctorSuccess()" value="Викликати">
        </form>
    </div>

</template>

<script>
    export default {
        data () {
            return {
                data: {
                    name: '',
                    last_name: '',
                    second_name: '',
                    email: '',
                    address: '',
                    phone: '',
                    description: ''
                },
                errors: {
                    name: false,
                    last_name: false,
                    second_name: false,
                    email: false,
                    address: false,
                    phone: false,
                    description: false
                },
                serverError: false,
                success: false
            }
        },
        methods: {

            callDoctorSuccess() {
                return (this.success) ? true : false
            },

            registration () {
                if (this.validate()) return false

                this.$http.post('/save-call-doctor-at-home', this.data).then(res => {
                    if (res.status === 201) {
                        this.success = true
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                    }
                })
            },
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'name':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'last_name':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'second_name':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'address':
                            if (!this.data[key] || this.data[key].length < 5) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'phone':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'price_city_id':
                            if (!this.data[key]) {
                                this.errors[key] = true
                            } else {
                                this.data[key] = +this.data[key]
                                this.errors[key] = false
                            }
                            break
                        case 'description':
                            if (!this.data[key] || this.data[key].length < 3) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'email':
                            if (!this.checkEmail(this.data[key])) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break

                    }
                }
                let hasError = false
                for (let key in this.errors) {
                    if (this.errors[key]) {
                        hasError = true
                    }
                }
                return hasError
            },
            checkEmail (email) {
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                return re.test(email.toLowerCase());

            },
        },
    }
</script>

<style scoped>

</style>