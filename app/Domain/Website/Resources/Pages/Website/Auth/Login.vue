<template>
    <Head title="Login Page" />

    <WebsiteLayout>
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 col-md-12 col-sm-12 col-xs-12">

                    <div class="card login">
                        <div class="card-header bg-primary text-light">
                            <p class="h3 m-0">Login Form</p>
                        </div>
                        <div class="card-body login-card-body">
                            <p class="login-box-msg">Sign in to start your session</p>

                            <div class="input-group mb-3">
                                <input v-model="form.email" type="email" :class="{'is-invalid':errors.email}" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="envelope" />
                                    </div>
                                </div>
                                <InputError :message="errors.email"/>
                            </div>

                            <div class="input-group mb-3">
                                <input v-model="form.password" type="password" :class="{'is-invalid':errors.password}" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="lock" />
                                    </div>
                                </div>
                                <InputError :message="errors.password"/>
                            </div>


                            <div class="row">
                                <div class="col-6 col-xs-12 p-2">
                                    <div class="icheck-primary">
                                        <input type="checkbox" class="mr-2" id="remember" v-model="form.remember">
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-xs-12 text-right">
                                    <button type="submit" @click="login" class="btn btn-primary btn-block px-5 py-2 uppercase">Sign In</button>
                                </div>

                                
                                <div class="row mt-2" v-if="demo">
                                    <div class="col">
                                        <button @click="customLogin('admin@domain.com')" class="w-100 btn btn-primary">Admin</button>
                                    </div>
                                    <div class="col">
                                        <button @click="customLogin('agent@domain.com')" class="w-100 btn btn-secondary">Agent</button>
                                    </div>
                                    <div class="col">
                                        <button @click="customLogin('user@domain.com')" class="w-100 btn btn-success">User</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-2">
                                <p class="mb-1">
                                    <Link :href="$route('forget')">I forgot my password</Link>
                                </p>
                                <p class="mb-0">
                                    <Link :href="$route('register')" class="text-center">Register a new membership</Link>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </WebsiteLayout>
</template>

<script>
import WebsiteLayout from '@/Layouts/Website.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    props:{
        errors:Object,
    },
    components: {
        Link,
        Head,
        WebsiteLayout,
        InputError,
    },
    data(){
        return {
            form:{
                email: null,
                password: null,
                remember: null,
            }
        }
    },
    computed:{
        demo(){
            return this.$page.props.demo
        }
    },
    methods:{
        customLogin(email){
            this.form.email = email;
            this.form.password = 'password';

            this.login();
        },
        login(){
            this.$inertia.post(route('post.login'), this.form)
        }
    }
}
</script>

<style>
.input-group-text{
    padding: 10px;
}
.login{
    margin:164px 0
}
</style>