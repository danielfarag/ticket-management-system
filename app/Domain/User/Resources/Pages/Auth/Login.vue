<template>

    <Head title="Login"/>

    <GuestLayout>
        <div class="login-box">
            <div class="login-logo">
                <Link :href="$route('dashboard.login')">
                    <b>Admin</b>LTE
                </Link>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <div class="input-group mb-3">
                    <input v-model="form.email" type="email" :class="{'is-invalid':errors.phone_number || errors.email}" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                    <InputError :message="errors.email"/>
                </div>

                <div class="input-group mb-3">
                    <input v-model="form.password" type="password" :class="{'is-invalid':errors.password}" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <InputError :message="errors.password"/>
                </div>


                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" v-model="form.remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" @click="login" class="btn btn-primary btn-block">Sign In</button>
                    </div>
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
                <p class="mb-1">
                    <Link :href="$route('dashboard.forget')">
                        I forgot my password
                    </Link>
                </p>
                <p class="mb-0">
                    <Link :href="$route('dashboard.register')" >
                        Register a new membership
                    </Link>
                </p>
                </div>
            </div>
        </div>
    </GuestLayout>

</template>

<script>
import GuestLayout from '@/Layouts/Guest.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        GuestLayout,
        Head,
        Link,
        InputError,
    },
    props:{
        errors: Object,
    },
    data(){
        return {
            form:{
                email:null,
                password:null,
                remember:null,
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
            this.$inertia.post(route('dashboard.post.login'), this.form)
        }
    }
}
</script>
