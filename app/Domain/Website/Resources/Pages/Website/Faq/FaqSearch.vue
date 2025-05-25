<template>

    <Head title="Home Page" />

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row text-center">
                    <div class="col-12">
                        <h1>Frequently Asked Questions</h1>
                    </div>
                </div>
                <div class="row text-center mt-5">
                    <div class="offset-md-3 col-6">
                        <div class="input-group mb-3">
                            <input type="text" v-model="key" class="form-control" placeholder="Search answers here..." aria-label="Search answers here..." aria-describedby="button-addon2">
                            <Link :href="$route('faqs.search', {key})" class="btn btn-dark px-5" type="button" id="button-addon2">Search</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container px-5">
                <div class="row">
                    <div class="col text-center" >
                        
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item mb-2" v-for="(faq,index) in faqs" :key="index">
                                <h2 class="accordion-header bg-success" :id="'heading'+index">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse'+index" aria-expanded="false" :aria-controls="'collapse'+index">
                                        {{ faq.question }}
                                    </button>
                                </h2>
                                <div :id="'collapse'+index" class="accordion-collapse collapse" :aria-labelledby="'heading'+index" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p class="text-left">{{ faq.answer }}</p>
                                        <Link v-if="faq.article_id" :href="$route('knowledge.show', faq.article_id)" class="d-block text-left">Details</Link>
                                    </div>
                                </div>
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
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
        Link,
        WebsiteLayout,
    },
    props:{
        request:Object,
        faqs: Array,
    },
    mounted(){
        this.key = this.request.key
    },
    data(){
        return {
            key:null,
        }
    }
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
        padding:40px;
    }

    .category_title{
        font-size: 20px;
        font-weight: bolder;
        font-family: revert;
        text-transform: capitalize;
        color: #424242;
        text-decoration: underline;
        margin-bottom: 20px;
    }

    .categories li {
        padding: 4px 0;
    }

    .categories li a {
        text-decoration: none;
        color: #8e8e8e;
        font-size: 14px;
        transition: color 0.2s ease-in-out;
        -moz-transition: color 0.2s ease-in-out;
        -webkit-transition: color 0.2s ease-in-out;
        -o-transition: color 0.2s ease-in-out;
    }

    .categories li a.active {
        color: #1c75a8;
        text-decoration: underline;
    }

    .categories li a:hover{
        color: #0e0e0e;
    }

    .faq_title{
        font-size: 35px;
        text-transform: capitalize;
        font-weight: bolder;
        font-family: initial;
        letter-spacing: 4px;
        color: #9d9d9d;
        margin-bottom: 10px;
    }

    .faq_subtitle{
        color: #9d9d9d;
        font-size: 14px;
        text-transform: uppercase;
        font-family: initial;
        letter-spacing: 4px;
        margin-bottom: 40px;
    }

    .accordion-button{
        background: #1f4961;
        color: white;
    }

    .accordion-button.collapsed{
        background: #8dadbf;
        color: white;
    }
</style>