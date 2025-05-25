<template>
    <Head title="Dashboard - List Articles" />

    <AuthenticatedLayout>
        <ArticleDatatable :articles="articles"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import ArticleDatatable from '@/Components/ArticleDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        ArticleDatatable,
    },
    props:{
        articles:Object
    },
}
</script>
