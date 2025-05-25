<template>
    <Head title="Dashboard - List Todos"/>

    <AuthenticatedLayout>
        <TodoDatatable :todos="todos"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import TodoDatatable from '@/Components/TodoDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        TodoDatatable,
    },
    props:{
        todos:Object
    },
}
</script>
