<template>

    <Head title="Home Page" />

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row">
                    <div class="col-12">
                        <h1>Privacy Policy</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima rem quia recusandae at id pariatur eaque sit debitis iste dignissimos minus quae similique aspernatur aut, ut tempora incidunt quasi optio.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container-fluid px-5">
                <div class="row">
                    <p v-html="privacy_policy"></p>
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
        privacy_policy: String
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