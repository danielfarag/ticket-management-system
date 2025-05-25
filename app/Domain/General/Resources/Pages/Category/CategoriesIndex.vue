<template>
    <Head title="Dashboard - List Categories"/>

    <AuthenticatedLayout>
        <CategoryDatatable :categories="categories"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import CategoryDatatable from '@/Components/CategoryDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        CategoryDatatable,
    },
    props:{
        categories:Object
    },
}
</script>
