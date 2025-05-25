
<template>

    <Head title="Reset Your Password"/>

    <GuestLayout>
        <div class="login-box">
            <div class="login-logo">
                <Link :href="$route('dashboard.login')"><b>Admin</b>LTE</Link>
            </div>
            
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
            
                    <div class="input-group mb-3">
                        <input v-model="form.password" type="password" :class="{'is-invalid':errors.password}" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <InputError :message="errors.password"/>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" :class="{'is-invalid':errors.password}" class="form-control" v-model="form.password_confirmation" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <InputError :message="errors.password"/>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" @click="reset" class="btn btn-primary btn-block">Change password</button>
                        </div>
                    </div>
            
            
                    <p class="mt-3 mb-1">
                        <Link :href="$route('dashboard.login')">Login</Link>
                    </p>
                </div>
            </div>
        </div>

    </GuestLayout>

</template>

<script>
import GuestLayout from '@/Layouts/Guest.vue';
import { Head } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';

export default {
    components: {
        GuestLayout,
        Head,
        InputError,
    },
    props:{
        errors: Object,
        request: Object,
    },
    data(){
        return {
            form:{
                token:null,
                email:null,
                password:null,
                password_confirmation:null,
            }
        }
    },
    mounted(){
        this.form.token = this.request.token;
        this.form.email = this.request.email;
    },
    methods:{
        reset(){
            this.$inertia.post(route('dashboard.post.reset'), this.form)
        }
    }

}
</script>
