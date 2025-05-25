<template>
    <Head title="Dashboard - List FAQs"/>
    
    <AuthenticatedLayout>
        <FaqDatatable :faqs="faqs"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import FaqDatatable from '@/Components/FaqDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        FaqDatatable,
    },
    props:{
        faqs:Object
    },
}
</script>
