<template>
    <div>
        <div v-if="resultRecord === 'success'" class="alert alert-success" role="alert">
            <strong>Вітаєм!</strong> Ви успішно зробили запис до лікаря.
            <a target="_blank" :href="/talon/ + idTalon">Посилання на талон</a>
        </div>
        <div v-if="resultRecord === 'error'" class="alert alert-danger" role="alert">
            <strong>Помилка</strong> Щось пішло не так.
        </div>
        <div class="selected-doctors" v-for="(doctor, index) in result">
            <div class="image">
                <img :src="'images/User/' + doctor.userImage">
            </div>
            <div class="description">
                <p>Імя: <span v-text="doctorFullName(doctor)"></span></p>
                <p>Початок прийому: <span v-text="cutTime(doctor.start)"></span></p>
                <p>Кінець прийому: <span v-text="cutTime(doctor.end)"></span></p>
                <p>Опис: <span v-text="doctor.description"></span></p>
                <div>
                    <button @click="makeNewRecord(doctor)" type="submit" class="btn btn-primary">Зареєструватись</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            result: {},
            user: {}
        },

        data() {
            return {
                msn: '',
                resultRecord: '',
                idTalon: ''
            }
        },

        methods: {

            doctorFullName(doctor){
                return doctor.workerName + ' ' + doctor.workerSecondName + ' ' + doctor.workerLastName;
            },

            makeNewRecord(doctor){
                doctor['user_identificator'] = this.user.id
                this.$http.post('/make-record-doctor', doctor).then(res => {
                    if (res.status === 201) {
                        this.resultRecord = 'success'
                        this.idTalon = res.data.schedule_identify
                    }
                }, err => {
                    if (+err.status === 400) {
                        this.resultRecord = 'error'
                    }
                });
            },

            cutTime(object){
                return object.substr(0, 5);
            }

        }
    }
</script>

<style scoped>
    .selected-doctors {
        display: flex;
    }
    .image {
        flex: 1 1 25%;
    }

    .image img {
        max-width: 400px;
        max-height: 200px;
    }

    .description {
        flex: 1 1 75%;
        padding-left: 15px;
    }

    .selected-doctors {
        margin-bottom: 15px;
    }
</style>