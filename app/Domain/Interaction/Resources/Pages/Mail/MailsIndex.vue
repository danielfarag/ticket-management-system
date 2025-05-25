<template>
    <Head title="Dashboard - List Mails" />

    <AuthenticatedLayout>

        <MailDatatable :mails="mails"/>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import MailDatatable from '@/Components/MailDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        MailDatatable,
    },
    props:{
        mails:Object
    },
}
</script>
