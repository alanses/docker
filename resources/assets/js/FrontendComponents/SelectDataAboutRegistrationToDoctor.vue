<template>
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-9 m-b-xs">
                <div data-toggle="buttons" class="btn-group">
                    <button type="button" @click="getDataByWeek" class="btn btn-info custom-btn custom-btn-left">За тиждень</button>
                    <button type="button" @click="getDataByMonth" class="btn btn-info custom-btn custom-btn-center">За місяць</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Номер</th>
                    <th>Дата</th>
                    <th>Час реєстрації</th>
                    <th>Прізвище та ініціали лікаря</th>
                    <th>Спеціалізація лікаря</th>
                    <th>Номер талона</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(oneCall, index) in CalsDoctor">
                    <td>{{++index}}</td>
                    <td>{{getDateOfSchedule(oneCall)}}</td>
                    <td>{{getTimeOfSchedule(oneCall)}}</td>
                    <td>{{getFulldoctorName(oneCall)}}</td>
                    <td>{{oneCall.specializationDoctor}}</td>
                    <td><a target= _blank :href="/talon/ + oneCall.numberTalon">Талон</a> </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                CalsDoctor: {}
            }
        },
        methods: {
            getDataByWeek(){
                this.$http.post('/get-my-registration-to-doctor-by-week', this.userData).then(res => {
                    if (res.status === 201) {
                        this.CalsDoctor = res.data.userCalls;
                    }
                })
            },

            getDataByMonth(){
                this.$http.post('/get-my-registration-to-doctor-by-month', this.userData).then(res => {
                    if (res.status === 201) {
                        this.CalsDoctor = res.data.userCalls;
                    }
                })
            },
            getDateOfSchedule(oneschedule){
                return oneschedule.date.split(' ')[0];
            },

            getTimeOfSchedule(oneschedule){
                return oneschedule.start + '/' + oneschedule.end;
            },

            getFulldoctorName(oneCall){
                return oneCall.doctorName + ' ' + oneCall.doctorSecondName + ' ' + oneCall.doctorLastName
            }
        },

        created() {
            this.getDataByWeek()
        }
    }
</script>

<style scoped>
    .ibox-content {
        background-color: #fff;
        color: inherit;
        padding: 15px 20px 20px 20px;
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0;
        min-height: 400px;
    }
    .ibox-content {
        clear: both;
    }
    .m-b-xs {
        margin-bottom: 5px;
    }

    .custom-btn {
        min-height: 40px;
        margin-top: -20px;
    }

    .custom-btn-left {
        margin-right: 20px;
    }
</style>