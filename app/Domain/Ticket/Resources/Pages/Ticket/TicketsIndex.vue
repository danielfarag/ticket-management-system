<template>
    <Head title="Dashboard - List Tickets"/>

    <AuthenticatedLayout>

        <TicketDatatable :tickets="tickets" :statuses="statuses" :severities="severities" :categories="categories"/>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import TicketDatatable from '@/Components/TicketDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        TicketDatatable,
    },
    props:{
        tickets:Object,
        statuses:Array,
        categories:Array,
        severities:Array,
    },
}
</script>

<style scoped>
    .badge{
        display:block;
        width:15;
        height: 15
    }
</style>
