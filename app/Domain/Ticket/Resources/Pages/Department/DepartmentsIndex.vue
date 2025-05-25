<template>
    <Head title="Dashboard - List Departments"/>

    <AuthenticatedLayout>
        <DepartmentDatatable :departments="departments" :categories="categories"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import DepartmentDatatable from '@/Components/DepartmentDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        DepartmentDatatable,
    },
    props:{
        departments:Object,
        categories:Array,
    },
}
</script>
