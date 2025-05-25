<template>
    <Head title="Dashboard - List Mail Templates"/>

    <AuthenticatedLayout>

        <MailTemplateDatatable :mailTemplates="mailTemplates"/>
        
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import MailTemplateDatatable from '@/Components/MailTemplateDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        MailTemplateDatatable,
    },
    props:{
        mailTemplates:Object
    },
}
</script>
