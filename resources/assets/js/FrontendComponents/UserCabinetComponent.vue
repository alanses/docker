<template>
    <div class="container">
        <div class="row">
            <div class="user-cabinet">
                <div class="menu-user">
                    <ul class="sidebar-nav" id="sidebar">
                        <li class="menu-nav-bar">
                            <span>Меню</span>
                        </li>
                        <li>
                            <a @click="changeActiveMenuInfo">Інформація про мене
                                <span class="sub_icon glyphicon glyphicon-link"></span>
                            </a>
                        </li>
                        <li>
                            <a @click="changeActiveMenuRegistration">Мої виклики
                                <span class="sub_icon glyphicon glyphicon-link"></span>
                            </a>
                        </li>
                        <li>
                            <a @click="logout">Вихід
                                <span class="sub_icon glyphicon glyphicon-link"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="user-info">
                    <div class="information" v-if="userInfo">
                        <h2 class="title-info">Інформація про мене</h2>
                        <div class="alert alert-success" role="alert" v-if="changeSuccess">
                            Ваші дані були зміненні
                        </div>
                        <form v-on:submit.prevent="changeMySeting">
                            <div class="form-group">
                                <label for="name">Імя:</label>
                                <input v-model="userData.name" type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="second_name">Прізвище:</label>
                                <input v-model="userData.second_name" type="text" class="form-control" id="second_name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Побатькові:</label>
                                <input v-model="userData.last_name" type="text" class="form-control" id="last_name">
                            </div>
                            <div class="form-group">
                                <label for="phone">Номер телефона:</label>
                                <input v-model="userData.phone" type="text" class="form-control" id="phone">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input v-model="userData.email" type="text" class="form-control" id="email">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Обновити">
                        </form>

                    </div>
                    <div class="my-call" v-if="myRegistration">
                        <select-data-about-registration-to-doctor></select-data-about-registration-to-doctor>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SelectDataAboutRegistrationToDoctor from '../FrontendComponents/SelectDataAboutRegistrationToDoctor.vue'

    export default {
        data() {
            return {
                userInfo: true,
                myRegistration: false,
                changeSuccess: false,
                userData: {
                    name: '',
                    second_name: '',
                    last_name: '',
                    phone: '',
                    email: '',
                    id: ''
                },
                userCallDoctor: {},
            }
        },
        props: {
            data: {}
        },
        methods: {
            changeMySeting() {
                this.$http.post('/change-setings', this.userData).then(res => {
                    if (res.status === 201) {
                        this.changeSuccess = true
                    }
                })
            },
            logout() {
                this.$http.post('/logout-user', this.userData).then(res => {
                    if (res.status === 202) {
                        window.location.href = "/"
                    }
                })
            },
            myRegistrationToDoctor() {
                this.$http.post('/get-my-registration-to-doctor', this.userData).then(res => {
                    if (res.status === 201) {
                        this.changeSuccess = true
                    }
                })
            },

            getUserData() {
                this.$http.post('/get-user-data').then(res => {
                    if (res.status === 202) {
                        this.userData = res.data.user
                    }
                })
            },

            changeActiveMenuInfo(){
                this.userInfo = true
                this.myRegistration = false
            },

            changeActiveMenuRegistration(){
                this.myRegistration = true
                this.userInfo = false
            },

        },
        created(){
          this.getUserData()
        },
        components: {
            SelectDataAboutRegistrationToDoctor
        }
    }
</script>

<style scoped>
    .user-cabinet {
        min-height: 400px;
        width: 100%;
        display: flex;
    }

    .title-info {
        text-align: center;
    }

    .information {
        margin-left: 20px;
        margin-top: 10px;
        min-height: 600px;
    }

    .menu-nav-bar {
        background: #ccc;
    }

    .menu-user {
        flex: 1 1 20%;
        background: #222;
        margin-left: 15px;
        border-right: 1px solid black;
    }

    .user-info {
        flex: 1 1 80%;
    }

    .sidebar-nav li {
        line-height: 40px;
        text-indent: 20px;
        margin-left: -40px;
        list-style-type: none;
    }

    .sidebar-nav li a {
        color: #999999;
        display: block;
        text-decoration: none;
    }

    .sidebar-nav li a:hover {
        color: #fff;
        background: rgba(255,255,255,0.2);
        text-decoration: none;
    }

    .sidebar-nav li a:active,
    .sidebar-nav li a:focus {
        text-decoration: none;
    }
    .sidebar-nav > .sidebar-brand {
        height: 65px;
        line-height: 60px;
        font-size: 18px;
    }

    .sidebar-nav > .sidebar-brand a {
        color: #999999;
    }

    .sidebar-nav > .sidebar-brand a:hover {
        color: #fff;
        background: none;
    }
</style>