<template>

    <Head title="Home Page" />

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row">
                    <div class="col-12">
                        <h1>Team Members</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima rem quia recusandae at id pariatur eaque sit debitis iste dignissimos minus quae similique aspernatur aut, ut tempora incidunt quasi optio.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container px-5">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4" v-for="(member,index) in team_members" :key="index">
                        <div class="card">
                            <img :src="member.image" class="card-img-top agent-image" alt="">
                            <div class="card-body">
                                <p class="card-title text-center fw-bolder h4">{{ member.name }}</p>
                                <p class="text-center">
                                    <span class="badge mx-3 bg-primary">{{ member.title }}</span>
                                </p>
                                <p class="card-subtitle text-center">{{ member.description }}</p>
                            </div>
                        </div>
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
        team_members: Array
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
    .agent-image{
        height:243px;
        width:100%;
    }
</style>