<template>
    <Head title="Dashboard - List Contacts"/>

    <AuthenticatedLayout>

        <ContactDatatable :contacts="contacts"/>
        
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import ContactDatatable from '@/Components/ContactDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        ContactDatatable,
    },
    props:{
        contacts:Object
    },
}
</script>
