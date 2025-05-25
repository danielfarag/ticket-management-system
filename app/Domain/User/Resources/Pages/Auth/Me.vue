<template>
    <Head title="My Profile" />

    <AuthenticatedLayout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="invoice p-3 mb-3">

                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> {{ user.name }}
                                    <small class="float-right">Since: {{ moment(user.created_at) }}</small>
                                </h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table mt-2 table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="head">ID</td>
                                            <td class="font-weight-bolder">{{ user.id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="head">Name</td>
                                            <td class="font-weight-bolder">{{ user.name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="head">Email</td>
                                            <td class="font-weight-bolder">{{ user.email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="head">Phone Number</td>
                                            <td class="font-weight-bolder">{{ user.phone_number }}</td>
                                        </tr>
                                        <tr>
                                            <td class="head">Type</td>
                                            <td class="font-weight-bolder">{{ user.type }}</td>
                                        </tr>
                                        <tr>
                                            <td class="head">Status</td>
                                            <td class="font-weight-bolder">{{ user.status }}</td>
                                        </tr>
                                        <tr>
                                            <td class="head">Role</td>
                                            <td class="font-weight-bolder">{{ user.role.name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="head">Created At</td>
                                            <td class="font-weight-bolder">{{ moment(user.created_at) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="head">Updated At</td>
                                            <td class="font-weight-bolder">{{ moment(user.updated_at) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row no-print">
                            <div class="col-12">
                                <Link :href="$route('dashboard.me.update')" class="btn btn-success float-right">
                                    Update Details
                                </Link>
                                <Link :href="$route('dashboard.me.update-password')" class="btn btn-primary float-right mr-2">
                                    Update Password
                                </Link>
                            </div>
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
        role:Object
    },
    computed:{
        user:function(){
            return this.$page.props.auth.user
        }
    },
    mounted(){
    },
}
</script>


<style scoped>
.head{
    width:20%;
}
</style>