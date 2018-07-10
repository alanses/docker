<template>
<div>
    <div v-if="user != null">
       <form v-on:submit.prevent="makeCallToDoctor">
            <div class="select-doctor-for-order">
            <div class="form-group offices">
                <label for="select-offices">Виберіть відділення</label>
                <select v-model="data.department" class="form-control" id="select-offices">
                    <option selected>Список відділень</option>
                    <option v-bind:value="department.id" v-text="department.title" v-for="(department, index) in departments"></option>
                </select>
            </div>
            <div class="form-group specialization">
                <label for="select-specialization">Виберіть спецілізацію</label>
                <select v-model="data.specialization" class="form-control" id="select-specialization">
                    <option selected>Список відділень</option>
                    <option v-bind:value="specialization.id" v-text="specialization.name" v-for="(specialization, index) in specializations"></option>
                </select>
            </div>
            <div class="form-group data-picker">
                <label for="select-specialization">Виберіть дату виклику</label>
                <datepicker :bootstrap-styling="true" v-model="data.dataForRegistration" :language="lang"></datepicker>
            </div>
            <div class="button-call">
                <input value="Пошук" type="submit" class="btn btn-primary">
            </div>
        </div>
        </form>
        <div v-if="result">
         <result-search-component :result="this.resultSearch" :user="user"></result-search-component>
        </div>
    </div>
    <div v-else class="alert alert-danger" role="alert">
        <strong>Помилка!</strong> Авторизуйтесь щоб зробити виклики до лікаря.
    </div>
</div>
</template>

<script>
    import ResultSearchComponent from '../FrontendComponents/ResultSearchComponent.vue'
    import {en, uk} from 'vuejs-datepicker/dist/locale'
    import Datepicker from 'vuejs-datepicker';

    export default {
        data() {
            return {
                data: {
                    department: '',
                    specialization: '',
                    dataForRegistration: '',
                },
                lang: uk,
                result: false,
                resultSearch: ''

            }
        },
        methods: {
            makeCallToDoctor() {
                let data = {
                    'department': this.data.department,
                    'specialization': this.data.specialization,
                    'dataForRegistration': this.getFullData(this.data.dataForRegistration)
                }

                this.$http.post('/search-doctors', data).then(res => {
                    if (res.status === 201) {
                        this.result = true
                        this.success = true
                        this.resultSearch = res.data.data
                        this.$forceUpdate();
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.serverError = true
                    }
                })
            },
            getFullData(data){
                let month = data.getUTCMonth() + 1
                let day = data.getUTCDate()
                let year = data.getUTCFullYear()
                return year + "-" + month + "-" + day
            },

        },
        components: {
            ResultSearchComponent,
            Datepicker,
            uk
        },
        props: {
            departments: {},
            specializations: {},
            user: {}
        }
    }
</script>

<style scoped>
    .select-doctor-for-order{
        display: flex;
    }

    .offices {
        flex: 1 1 25%;
        padding-right: 10px;
    }

    .specialization {
        flex: 1 1 25%;
        padding-right: 10px;
        padding-left: 10px;
    }

    .data-picker {
        flex: 1 1 25%;
    }

    .button-call {
        margin-top: 32px;
        margin-left: 10px;
        flex: 1 1 25%;
    }
</style>