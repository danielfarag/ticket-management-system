<template>
    
    <div class="faqs">
        <div class="container">
            <div class="row mb-4 text-center">
                <div class="col">
                    <p class="h3 uppercase">Frequently Asked Question</p>
                    <p class="h6 uppercase">Do You Want to Know</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12" v-for="(faq, index) in faqs" :key="index">
                    <Link :href="$route('knowledge.show', faq.article_id)">
                        <i class="fas fa-comment"></i> <span class="ml-1">{{ faq.question }}</span>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props:{
        faqs:Array
    },
}
</script>

<style scoped>

.faqs{
    padding:80px 0;
    background:#f9f9f9
}

.faqs a:hover{
    cursor: pointer;
    color: rgb(236, 236, 236);
    background: #777;
}

.faqs a{
    background-color: rgb(240, 246, 255);
    border: 1px solid #cecece;
    transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -o-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -webkit-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -ms-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -moz-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    color: #3c3c3c;
    text-decoration: none;
    font-family: 'Times New Roman', Times, serif;
    font-style: oblique;
    display: block;
    padding: 7px 24px;
    margin: 11px 7px;
}

</style>