<template>
    <Head title="Dashboard - List Severities"/>

    <AuthenticatedLayout>

        <SeverityDatatable :severities="severities"/>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import SeverityDatatable from '@/Components/SeverityDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        SeverityDatatable,
    },
    props:{
        severities:Object
    },
}
</script>
