<template>
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-9 m-b-xs">
                <div data-toggle="buttons" class="btn-group">
                    <button type="button" @click="getDataByWeek" class="btn btn-info custom-btn custom-btn-left">За тиждень</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Номер</th>
                    <th>Дата</th>
                    <th>Час прийому</th>
                    <th>Прізвище та ініціали працієнта</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="oneschedule !== null" v-for="(oneschedule, index) in schedule">
                    <td>{{++index}}</td>
                    <td>{{getDateOfSchedule(oneschedule)}}</td>
                    <td>{{getTimeOfSchedule(oneschedule)}}</td>
                    <td>{{getFullName(oneschedule)}}</td>
                    <td>{{checkStatus(oneschedule)}}</td>
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
                schedule: {}
            }
        },

        methods: {
            getDataByWeek(){
                this.$http.post('/get-schedule-week', this.doctor).then(res => {
                    if (res.status === 201) {
                        this.schedule = res.data.schedule;
                    }
                })
            },


            getFullName(oneschedule){
                return oneschedule.user.name + ' ' + oneschedule.user.second_name + '' + oneschedule.user.last_name
            },

            checkStatus(oneschedule){
                return oneschedule ? "Заброньований" : "Вільний"
            },

            getDateOfSchedule(oneschedule){
                return oneschedule.date.split(' ')[0];
            },

            getTimeOfSchedule(oneschedule){
                return oneschedule.start + '/' + oneschedule.end;
            }
        },


        props: {
            doctor: {}
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