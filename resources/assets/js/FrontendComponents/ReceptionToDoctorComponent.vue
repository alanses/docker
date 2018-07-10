<template>
    <div class="information">
        <h2 class="title-info">Створити новий прийом</h2>
        <div v-if="success" class="alert alert-success" role="alert">
            <strong>Успіх!</strong> Успішно добавлено новий час прийому.
        </div>
        <div v-if="sendError" class="alert alert-danger" role="alert">
            <strong>Помилка!</strong> На даний час вже уснує прийом.
        </div>
        <div class="time-pickers">
            <div class="form-group selected-date">
                <label>Дата прийому</label>
                <datepicker v-model="data.checkDate" :language="data.lang"></datepicker>
            </div>
            <div class="form-group selected-start">
                <label>Початок прийому</label>
                <div class="time-picker">
                    <time-picker v-model="data.startTime" :show-meridian="false"/>
                </div>
            </div>
            <div class="form-group selected-end">
                <label>Закінчення прийому</label>
                <div class="time-picker">
                    <time-picker v-model="data.endTime" :show-meridian="false"/>
                </div>
            </div>
            <div class="send-new-reception">
                <button @click="createNewReception" type="submit" class="btn btn-primary">Створити новий прийом </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {en, uk} from 'vuejs-datepicker/dist/locale'
    import Datepicker from 'vuejs-datepicker';

    export default {
        data() {
            return {
                data: {
                    checkDate: '',
                    lang: uk,
                    startTime: new Date(),
                    endTime: new Date()
                },
                errors: {
                    startTime: false,
                    endTime: false,
                    checkDate: false
                },
                success: false,
                sendError: ''
            }
        },
        components: {
            Datepicker,
            en,
            uk
        },
        props: {
            doctor: {}
        },
        methods: {
            validate () {
                for (let key in this.data) {
                    switch (key) {
                        case 'checkDate':
                            if (!this.data[key] || this.data[key].length < 0) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'startTime':
                            if (!this.data[key] || this.data[key].length < 0) {
                                this.errors[key] = true
                            } else {
                                this.errors[key] = false
                            }
                            break
                        case 'endTime':
                            if (!this.data[key] || this.data[key].length < 3) {
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

            getFullData(data){
                let month = data.getUTCMonth() + 1
                let day = data.getUTCDate()
                let year = data.getUTCFullYear()
                return year + "-" + month + "-" + day
            },

            addZero(num) {
                 return (num >= 0 && num < 10) ? "0" + num : num + "";
            },

            getCurentTime(data){
                let hours =  this.addZero(data.getHours());
                let minutes = this.addZero(data.getMinutes());
                let seconds = this.addZero(data.getSeconds());
                return hours + ':' + minutes + ':' + seconds
            },

            createNewReception (){
                if (this.validate()) return false
                let data = {
                    'start': this.getCurentTime(this.data.startTime),
                    'end': this.getCurentTime(this.data.endTime),
                    'date': this.getFullData(this.data.checkDate),
                    'doctor_id': this.doctor.id,
                }
                this.$http.post('/save-new-reception', data).then(response => {
                    if (response.status === 201) {
                        this.success = true
                        this.sendError = false
                    }
                }, response => {
                    this.sendError = true
                    this.success = false
                });
            }
        }
    }

</script>

<style scoped>
    .title-info {
        text-align: center;
    }

    .information {
        margin-left: 20px;
        margin-top: 10px;
        min-height: 600px;
    }

    .time-pickers {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }


    .time-picker {
        margin-top: -30px;
    }

    .send-new-reception {
        margin-top: 30px;
    }
</style>