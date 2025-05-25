<template>
    <Head title="Dashboard - List Escalations"/>

    <AuthenticatedLayout>
        <EscalationDatatable :escalations="escalations"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import EscalationDatatable from '@/Components/EscalationDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        EscalationDatatable,
    },
    props:{
        escalations:Object
    },
}
</script>
