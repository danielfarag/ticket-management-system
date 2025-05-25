<template>
    <Head title="Forget Password Page" />

    <WebsiteLayout>
        <div class="container">
            <div class="row">
                <div class="offset-3 col-6">

                    <div class="card login">
                        <div class="card-header bg-primary text-light">
                            <p class="h3 m-0">Forget Password Form</p>
                        </div>

                        <div class="card-body login-card-body">
                            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                    
                            <div class="input-group mb-3">
                                <input v-model="form.email" type="email" :class="{'is-invalid':errors.email}" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="envelope" />
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
                                <Link :href="$route('login')">Login</Link>
                            </p>
                            <p class="mb-0">
                                <Link :href="$route('register')" class="text-center">Register a new membership</Link>
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
            }
        }
    },
    methods:{
        forget(){
            this.$inertia.post(route('post.forget'), this.form)
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