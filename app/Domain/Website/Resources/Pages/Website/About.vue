<template>

    <Head title="Home Page" />

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row">
                    <div class="col-3">
                        <h1>About Us</h1>
                        <p>Who we are ?</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container-fluid px-5">
                <div class="row">
                    <p v-html="about"></p>
                </div>
            </div>
        </div>
    </WebsiteLayout>

</template>


<script>
import WebsiteLayout from '@/Layouts/Website.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
        WebsiteLayout,
    },
    props:{
        about: String
    },
}
</script>


<style scoped>
    .head{
        background: rgb(31, 73, 97);
        color: white;
        padding: 50px 0;
    }

    .head h1{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-style: oblique;
    }
    .body{
        padding:81px;
        position: relative;
    }
</style>