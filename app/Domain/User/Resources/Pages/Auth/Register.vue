<template>

    <Head title="Register"/>

    <GuestLayout>
        <div class="register-box">
            <div class="register-logo">
                <Link :href="$route('dashboard.register')" >
                    <b>Admin</b>LTE
                </Link>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <div class="input-group mb-3">
                    <input type="text" class="form-control"  :class="{'is-invalid':errors.name}"  v-model="form.name" placeholder="Full name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <InputError :message="errors.name"/>
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control"  :class="{'is-invalid':errors.email}"  v-model="form.email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <InputError :message="errors.email"/>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control"  :class="{'is-invalid':errors.phone_number}"  v-model="form.phone_number" placeholder="Phone Number">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <InputError :message="errors.phone_number"/>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control"  :class="{'is-invalid':errors.password}"  v-model="form.password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <InputError :message="errors.password"/>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control"  :class="{'is-invalid':errors.password_confirmation}"  v-model="form.password_confirmation" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <InputError :message="errors.password"/>
                </div>

                <div class="row">
                    <div class="col-4">
                        <button type="submit" @click="register" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>

                <hr/>
                <Link :href="$route('dashboard.login')" >
                    I already have a membership
                </Link>
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
    components:{
        GuestLayout,
        InputError,
    },
    props:{
        errors: Object,
    },
    data(){
        return {
            form:{
                name:null,
                email:null,
                phone_number:null,
                password:null,
                password_confirmation:null,
            }
        }
    },
    components: {
        GuestLayout,
        Head,
        Link,
    },
    methods:{
        register(){
            this.$inertia.post(route('dashboard.post.register'), this.form)
        }
    }

}
</script>
