<template>
    <Head title="Dashboard - List Block Ips" />

    <AuthenticatedLayout>
        <BlockIpDatatable :blockIps="blockIps"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import BlockIpDatatable from '@/Components/BlockIpDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        BlockIpDatatable,
    },
    props:{
        blockIps:Object
    },
}
</script>
