<template>
    <Head title="List Users" />

    <AuthenticatedLayout>

        <UserDatatable :users="users" :roles="roles"/>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import UserDatatable from '@/Components/UserDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        UserDatatable,
    },
    props:{
        users:Object,
        roles:Array,
    },
}
</script>
