<template>
    <Head title="Update Password" />

    <AuthenticatedLayout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Password</h3>
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
                current_password:null,
                password:null,
                password_confirmation:null,
            },
        }
    },
    methods:{
        updatePassword(){
            this.$inertia.post(route('dashboard.me.update-password.action'), this.form)
        }
    }
}
</script>