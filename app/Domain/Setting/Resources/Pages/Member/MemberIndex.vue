<template>
    <Head title="Dashboard - List Members"/>

    <AuthenticatedLayout>
        <MemberDatatable :members="members"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import MemberDatatable from '@/Components/MemberDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        MemberDatatable,
    },
    props:{
        members:Object
    },
}
</script>
