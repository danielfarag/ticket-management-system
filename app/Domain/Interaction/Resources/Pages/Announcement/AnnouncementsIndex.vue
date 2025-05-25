<template>
    <Head title="Dashboard - List Announcements"/>

    <AuthenticatedLayout>

        <AnnouncementDatatable :announcements="announcements"/>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import AnnouncementDatatable from '@/Components/AnnouncementDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        AnnouncementDatatable,
    },
    props:{
        announcements:Object
    },
}
</script>
