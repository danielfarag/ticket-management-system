<template>
    <Head title="Dashboard - List Roles"/>

    <AuthenticatedLayout>

        <RoleDatatable :roles="roles"/>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import RoleDatatable from '@/Components/RoleDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        RoleDatatable,
    },
    props:{
        roles:Object
    },
}
</script>
