<template>
    <div class="ibox float-e-margins">
        <div class="ibox-content">
        <div class="row">
            <div class="col-sm-9 m-b-xs">
                <div data-toggle="buttons" class="btn-group">
                    <button type="button" @click="getDataByDay" class="btn btn-dark">За вчорашній день</button>
                    <button type="button" @click="getDataByWeek" class="btn btn-dark">За тиждень</button>
                    <button type="button" @click="getDataByMonth" class="btn btn-dark">За місяць</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Номер</th>
                    <th>Імя</th>
                    <th>Прізвище</th>
                    <th>Побатькові</th>
                    <th>Адресса</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Дата/Час реєстрації</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(oneCall, index) in CalsDoctor">
                    <td>{{++index}}</td>
                    <td v-text="oneCall.name"></td>
                    <td v-text="oneCall.second_name"></td>
                    <td v-text="oneCall.last_name"></td>
                    <td v-text="oneCall.address"></td>
                    <td v-text="oneCall.email"></td>
                    <td v-text="oneCall.phone"></td>
                    <td v-text="oneCall.created_at"></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
    </div>
</template>

<script>
    export default {
        props: {
            call_doctor_at_home: {}
        },

        watch: {

        },

        data () {
            return {
                CalsDoctor: {},
            }
        },

        methods: {
            getDataByDay () {
                this.$http.post('/call-doctor-by-day', this.data).then(res => {
                    if (res.status === 201) {
                        this.CalsDoctor = res.data.DoctorCalls;
                    }
                })
            },

            getDataByWeek () {
                this.$http.post('/call-doctor-by-week', this.data).then(res => {
                    if (res.status === 201) {
                        this.CalsDoctor = res.data.DoctorCalls;
                    }
                })
            },

            getDataByMonth () {
                this.$http.post('/call-doctor-by-month', this.data).then(res => {
                    if (res.status === 201) {
                        this.CalsDoctor = res.data.DoctorCalls;
                    }
                })
            },
        },

        created() {
            this.getDataByDay();
        }

    }
</script>

<style scoped>
    .btn-group button {
        margin-right: 15px
    }

    .ibox-title {
        background-color: #fff;
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 3px 0 0;
        color: inherit;
        margin-bottom: 0;
        padding: 14px 15px 7px;
        min-height: 48px;
    }


</style>