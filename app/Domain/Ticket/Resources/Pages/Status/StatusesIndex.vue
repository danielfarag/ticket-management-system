<template>
    <Head title="Dashboard - List Statuses"/>

    <AuthenticatedLayout>

        <StatusDatatable :statuses="statuses"/>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import StatusDatatable from '@/Components/StatusDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        StatusDatatable,
    },
    props:{
        statuses:Object
    },
}
</script>
