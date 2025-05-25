<template>
    <Head title="Update My Profile" />

    <AuthenticatedLayout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile Details</h3>
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
                            <Link :href="$route('dashboard.me')" class="btn btn-link">Back</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        AuthenticatedLayout,
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
                name:null,
                email:null,
                phone_number:null
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
            this.$inertia.post(route('dashboard.me.update.action'), this.form)
        }
    }
}
</script>