<template>

    <Head title="Home Page" />

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row text-center">
                    <div class="col-12">
                        <h1>Knowledge Base</h1>
                    </div>
                </div>
                <div class="row text-center mt-5">
                    <div class="offset-md-3 col-6">
                        <div class="input-group mb-3">
                            <input v-model="key" type="text" class="form-control" placeholder="Search answers here..." aria-label="Search answers here..." aria-describedby="button-addon2">
                            <Link :href="$route('knowledge.search', {key})" class="btn btn-dark px-5" type="button" id="button-addon2">Search</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container px-5">
                <div class="row text-center">
                    <div class="col text-center page-desc">
                        <p>Here you can find all information about the ticket. While you are searching about the solution of your issue, you can interact easily with the author of the articles and discover more about the solution of yout case, let's give a try?</p>
                    </div>
                </div>
                <div class="row mt-5 text-center knowledge_category">
                    <div class="col-4" v-for="(category, index) in categories" :key="index">
                        <ul>
                            <li>
                                <font-awesome-icon class="icon" :icon="category.icon" />
                            </li>
                            <li>
                                <p class="mt-2 fw-bold">
                                    <Link class="category_name" :href="$route('knowledge.category', category.id)">
                                        {{ category.name }}
                                    </Link>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="support text-center">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p class="p-0 m-0">Still Need Support?</p>
                        <Link :href="$route('website.tickets.create')" class="btn btn-primary"> <font-awesome-icon icon="ticket-alt"/> Open Ticket </Link> 
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container px-5">
                <div class="row mt-3">
                    <p class="h3 articles_title">Articles</p>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12 pr-2">
                        <p class="h3 articles_title_section">Recent Articles</p>
                        <ul class="m-0 p-0 articles">
                            <li v-for="(article,index) in recent_articles" :key="index">
                                <Link :href="$route('knowledge.show', article.id)">
                                    <font-awesome-icon icon="file-alt" />
                                    {{ article.title }}
                                    <span>
                                        {{ article.seen }} <font-awesome-icon icon="eye" />
                                    </span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12 pr-2">
                        <p class="h3 articles_title_section">Popular Articles</p>
                        <ul class="m-0 p-0 articles">
                            <li v-for="(article,index) in popular_articles" :key="index">
                                <Link :href="$route('knowledge.show', article.id)">
                                    <font-awesome-icon icon="file-alt" />
                                    {{ article.title }}
                                    <span>
                                        {{ article.seen }} <font-awesome-icon icon="eye" />
                                    </span>
                                </Link>
                            </li>
                        </ul>
                    </div>

                    
                    <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12 pr-2">
                        <p class="h3 articles_title_section">Most Helpful Articles</p>
                        <ul class="m-0 p-0 articles">
                            <li v-for="(article,index) in helpful_articles" :key="index">
                                <Link :href="$route('knowledge.show', article.id)">
                                    <font-awesome-icon icon="file-alt" />
                                    {{ article.title }}
                                    <span>
                                        {{ article.seen }} <font-awesome-icon icon="eye" />
                                    </span>
                                </Link>
                            </li>
                        </ul>
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
        categories:Array,
        recent_articles:Array,
        popular_articles:Array,
        helpful_articles:Array,
    },
    data(){
        return {
            key: null
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
    .knowledge_category div{
        margin-bottom: 106px;
    }

    .icon{
        font-size: 58px;
        color: #1f4961;
    }
    .category_name{
        color: #45687d;
        text-decoration: none;
    }

    .support{
        background: #e3e3e3;
        padding: 51px;
        font-size: 34px;
    }

    .support p{
        color: #686868;
        font-family: initial;
        font-style: normal;
        font-variant: small-caps;
    }

    .articles{
        margin-right: 20px !important
    }
    .articles li{
        margin-bottom: 24px;
    }
    .articles li a{
        text-decoration: none;
        font-size:14px;
        display: block;
        position: relative;
        padding: 0 38px 0 0;
    }

    .articles li a span{
        position: absolute;
        right: 0
    }

    .articles_title{
        color: #b5b5b5;
        font-family: initial;
        font-style: normal;
        font-variant: small-caps;
    }

    .articles_title_section{
        color: #777777;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-variant: sub;
        margin-bottom: 13px;
    }

    .page-desc{
        padding: 0 19%;
    }
</style>