<template>
    <Head title="Dashboard - List Quick Links"/>

    <AuthenticatedLayout>
        <QuickLinkDatatable :quickLinks="quickLinks"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import QuickLinkDatatable from '@/Components/QuickLinkDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        QuickLinkDatatable,
    },
    props:{
        quickLinks:Object
    },
}
</script>
