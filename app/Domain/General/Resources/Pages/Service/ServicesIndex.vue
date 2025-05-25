<template>
    <Head title="Dashboard - List Services"/>

    <AuthenticatedLayout>
        <ServiceDatatable :services="services"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import ServiceDatatable from '@/Components/ServiceDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        ServiceDatatable,
    },
    props:{
        services:Object
    },
}
</script>
