<template>
    <div class="login">

        <div class="login-container">
            <!-- Page container -->
            <div class="page-container">
                <!-- Page content -->
                <div class="page-content">
                    <!-- Main content -->
                    <div class="content-wrapper">

                        <form class="form-horizontal" @submit.prevent="login">

                            <div class="panel panel-body login-form">
                                <div class="text-center">
                                    <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                                    <h5 class="content-group">Login <small class="display-block">Enter your credentials below</small></h5>
                                </div>

                                <div v-if="serverErrors.length">
                                    <b-alert v-model="showDismissibleAlert" variant="danger" dismissible>
                                        <ul>
                                            <li v-for="err in serverErrors">{{err}}</li>
                                        </ul>
                                    </b-alert>
                                </div>


                                <div class="form-group has-feedback has-feedback-left">
                                    <input class="form-control" placeholder="Email" id="email" type="email" name="email" v-model="user.email" value="" autofocus v-validate="'required|email'">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                    <span v-if="errors.has('email')" class="text-danger">{{ errors.first('email') }}</span>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input id="password" type="password" class="form-control" name="password" v-model="user.password" placeholder="Password" v-validate="'required|min:6'">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    <span v-if="errors.has('password')" class="text-danger">{{ errors.first('password') }}</span>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn bg-pink-400 btn-block">
                                        Sign in <i class="icon-circle-right2 position-right"></i>
                                    </button>
                                </div>

                                <div class="text-center">
                                    <router-link to="/forgot-password">Forgot password?</router-link>
                                </div>
                            </div>
                        </form>
                        <!-- /simple login form -->
                    </div>
                    <!-- /main content -->
                </div>
                <!-- /page content -->
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'Login',
        data () {
            return {
                user: {
                    email: '',
                    password: '',
                },
                serverErrors: [],
                showDismissibleAlert: false,
            }
        },
        methods: {
            login() {

                this.$validator.validateAll().
                        then((result) => {
                    if(result) {
                        this.$auth.login({
                            params: {
                                email: this.user.email,
                                password: this.user.password
                            },
                            success: function(res) {
                                this.user = {};
                            },
                            error: function(err) {
                                this.showDismissibleAlert = true;
                                this.serverErrors = [];
                                if (err.response.data.error === 'Unauthorized') {
                                    this.serverErrors.push(err.response.data.msg);
                                } else {
                                    this.handleErrors(err.response.data.errors);
                                }

                            },
                            rememberMe: true,
                            fetchUser: true,
                            redirect: '/dashboard'
                        })
                    }
                });

            },

            handleErrors(Errs) {
                const newErr = [];
                _.forEach(Errs, function(value, key) {
                    newErr.push(Errs[key][0]);
                });
                this.serverErrors = newErr;
            }
        },
        created () {
            if(this.$auth.check()) {
                this.$router.push('/dashboard');
             }
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .alert button.close {
        margin-right: 5px !important;
    }
    .alert ul {
        padding: 0;
        list-style-type: none;
    }
</style>
