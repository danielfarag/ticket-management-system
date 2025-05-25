<template>
    <Head title="Dashboard - List Surveys"/>

    <AuthenticatedLayout>

        <SurveyDatatable :surveys="surveys"/>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import SurveyDatatable from '@/Components/SurveyDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        SurveyDatatable,
    },
    props:{
        surveys:Object
    },
}
</script>
