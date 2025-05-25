<template>
    <Head title="Reset Password Page" />

    <WebsiteLayout>
        <div class="container">
            <div class="row">
                <div class="offset-3 col-6">

                    <div class="card login">
                        <div class="card-header bg-primary text-light">
                            <p class="h3 m-0">Reset Password Form</p>
                        </div>

                        <div class="card-body login-card-body">
                            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
                    
                            <div class="input-group mb-3">
                                <input v-model="form.password" type="password" :class="{'is-invalid':errors.password}" class="form-control" placeholder="New Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="lock" />
                                    </div>
                                </div>
                                <InputError :message="errors.password"/>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" :class="{'is-invalid':errors.password}" class="form-control" v-model="form.password_confirmation" placeholder="Retype New password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="lock" />
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
                                <Link :href="$route('login')">Login</Link>
                            </p>
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
        request:Object
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
            this.$inertia.post(route('post.reset'), this.form)
        }
    }
}
</script>

<style>
.input-group-text{
    padding: 10px;
}

.login {
    margin:164px 0
}
</style>