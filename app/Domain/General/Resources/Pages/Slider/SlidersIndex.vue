<template>
    <Head title="Dashboard - List Sliders"/>

    <AuthenticatedLayout>
        <SliderDatatable :sliders="sliders"/>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import SliderDatatable from '@/Components/SliderDatatable.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        SliderDatatable,
    },
    props:{
        sliders:Object
    },
}
</script>
