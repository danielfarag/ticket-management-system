<template>

    <Head title="Home Page" />

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row">
                    <div class="col-3">
                        <h1>Features</h1>
                        <p>This is <span class="badge bg-primary">Services</span> Page. You can Edit Your Profile on this Page and Check Your Statics on this Page.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container px-5">
                <div class="row">
                    <div class="col text-center">
                        <p class="uppercase feature_title">our features</p>
                        <p class="uppercase">Lorem, ipsum adipisicing elit. Temporibus, nostrum. Laudant ex, repellat nesciunt, sequi laboriosam pariatur delectus deleniti ea minus quos!</p>
                    </div>
                </div>
                <div  class="separator"></div>
                <div class="row mb-5" v-for="service in services" :key="service.id">
                    <div class="col-1 text-center">
                        <font-awesome-icon class="feature-icon align-top" :icon="service.icon" />
                    </div>
                    <div class="col">
                        <p class="h2 fw-bold uppercase">{{ service.title }}</p>
                        <p class="h5 service_description">{{ service.description }}</p>
                    </div>
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
        errors:Object,
        services:Object,
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

    .feature-icon{
        background: #242424;
        border-radius: 50%;
        padding: 11px;
        color: white;
        margin-top: 7px;
        width: 45px;
        height: 45px;  
    }
    .feature_title{
        font-size: 62px;
        font-weight: bolder;
        margin: 0 0 37px 0;
    }

    .service_description{
        font-family: initial;
        font-style: italic;
        font-variant: sub;
    }

    .separator{
        margin-top: 65px;
    }
</style>