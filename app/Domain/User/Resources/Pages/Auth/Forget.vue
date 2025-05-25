
<template>

    <Head title="Forget Your Password"/>

    <GuestLayout>
        <div class="login-box">
            <div class="login-logo">
                <Link :href="$route('dashboard.forget')"><b>Admin</b>LTE</Link>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
            
                    <div class="input-group mb-3">
                        <input v-model="form.email" type="email" :class="{'is-invalid':errors.email}" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <InputError :message="errors.email"/>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" @click="forget" class="btn btn-primary btn-block">Request new password</button>
                        </div>
                    </div>
        
                    <p class="mt-3 mb-1">
                        <Link :href="$route('dashboard.login')">Login</Link>
                    </p>
                    <p class="mb-0">
                        <Link :href="$route('dashboard.register')" class="text-center">Register a new membership</Link>
                    </p>
                </div>
            </div>
        </div>

    </GuestLayout>

</template>

<script>
import GuestLayout from '@/Layouts/Guest.vue'
import { Head } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        GuestLayout,
        Head,
        InputError,
    },
    props:{
        errors: Object,
    },
    data(){
        return {
            form:{
                email: null,
            }
        }
    },
    methods:{
        forget(){
            this.$inertia.post(route('dashboard.post.forget'), this.form)
        }
    }

}
</script>
