<template>
    <Head title="Register Page" />

    <WebsiteLayout>
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 col-md-12 col-sm-12 col-xs-12">

                    <div class="card login">
                        <div class="card-header bg-primary text-light">
                            <p class="h3 m-0">Register Form</p>
                        </div>

                        <div class="card-body register-card-body">
                            <p class="login-box-msg">Register a new membership</p>

                            <div class="input-group mb-3">
                                <input type="text" :class="{'is-invalid':errors.name}" class="form-control" v-model="form.name" placeholder="Full name">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="user" />
                                    </div>
                                </div>
                                <InputError :message="errors.name"/>
                            </div>

                            <div class="input-group mb-3">
                                <input type="email" :class="{'is-invalid':errors.email}" class="form-control" v-model="form.email" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="envelope" />
                                    </div>
                                </div>
                                <InputError :message="errors.email"/>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" :class="{'is-invalid':errors.phone_number}" class="form-control" v-model="form.phone_number" placeholder="Phone Number">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="phone" />
                                    </div>
                                </div>
                                <InputError :message="errors.phone_number"/>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" :class="{'is-invalid':errors.password}" class="form-control" v-model="form.password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="lock" />
                                    </div>
                                </div>
                                <InputError :message="errors.password"/>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" :class="{'is-invalid':errors.password}" class="form-control" v-model="form.password_confirmation" placeholder="Retype password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <font-awesome-icon icon="lock" />
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
                            <Link :href="$route('login')" class="text-center">I already have a membership</Link>
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
                name:null,
                email:null,
                phone_number:null,
                password:null,
                password_confirmation:null,
            }
        }
    },
    methods:{
        register(){
            this.$inertia.post(route('post.register'), this.form)
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