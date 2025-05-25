<template>

    <Head title="Profile Page" />

    <WebsiteProfileLayout>
        <div class="row mt-4">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card bg-light rounded-3">
                    <div class="card-header">
                        <p class="m-0 fw-bolder">Update User Details</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" :class="{'is-invalid':errors.name}" class="form-control" v-model="form.name" placeholder="Full name">
                            <InputError :message="errors.name"/>
                        </div>
                                            
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" :class="{'is-invalid':errors.email}" class="form-control" v-model="form.email" placeholder="Email">
                            <InputError :message="errors.email"/>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" :class="{'is-invalid':errors.phone_number}" class="form-control" v-model="form.phone_number" placeholder="Phone Number">
                            <InputError :message="errors.phone_number"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button @click="update" type="button" class="btn btn-primary">Save</button>
                        <Link :href="$route('me')" class="btn btn-link">Back</Link>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card bg-light rounded-3">
                    <div class="card-header">
                        <p class="m-0 fw-bolder">Update Password</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" :class="{'is-invalid':errors.current_password}" class="form-control" v-model="form.current_password" placeholder="current Password">
                            <InputError :message="errors.current_password"/>
                        </div>
                                            
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" :class="{'is-invalid':errors.password}" class="form-control" v-model="form.password" placeholder="New Password">
                            <InputError :message="errors.password"/>
                        </div>
                                            
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" :class="{'is-invalid':errors.password}" class="form-control" v-model="form.password_confirmation" placeholder="Confirm New Password">
                            <InputError :message="errors.password"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button @click="updatePassword" type="button" class="btn btn-primary">Save</button>
                        <Link :href="$route('me')" class="btn btn-link">Back</Link>
                    </div>

                </div>
            </div>
        </div>
    </WebsiteProfileLayout>

</template>


<script>
import WebsiteProfileLayout from '@/Layouts/WebsiteProfile.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    props:{
        tickets:Array,
        errors: Object,
    },
    components: {
        Head,
        Link,
        WebsiteProfileLayout,
        InputError,
    },
    data(){
        return {
            form:{
                name:null,
                email:null,
                phone_number:null,

                current_password:null,
                password:null,
                password_confirmation:null,
            },
        }
    },
    mounted(){
        if(this.user){
            this.form.name = this.user.name;
            this.form.email = this.user.email;
            this.form.phone_number = this.user.phone_number;
        }
    },
    computed:{
        user:function(){
            return this.$page.props.auth.user
        }
    },
    methods:{
        update(){
            this.$inertia.post(route('me.update.action'), this.form)
        },
        updatePassword(){
            this.$inertia.post(route('me.update-password.action'), this.form)
        }
    }
}
</script>