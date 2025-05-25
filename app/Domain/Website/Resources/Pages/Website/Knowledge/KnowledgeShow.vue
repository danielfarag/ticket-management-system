<template>

    <Head title="Home Page" />

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row">
                    <div class="col-12">
                        <h3 class="article_title">{{ article.title }} <span class="author">by {{ article.author.name }}</span></h3>
                        <h3 class="article_subtitle"><Link :href="$route('knowledge.category', article.category.id)">{{ article.category.name }}</Link></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container px-5">
                <div class="row">
                    <div class="col">
                        <img class="article_image mb-3" :src="article.image">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p v-html="article.body"></p>
                        <div class="d-block text-center">
                            <button @click="setUseful(1)" :class="{'btn-success':article.useful == true, 'btn-dark': article.useful == null || article.useful == false}" class="btn px-4 py-2 mr-3"> <font-awesome-icon icon="thumbs-up"/> Useful</button>
                            <button @click="setUseful(0)" :class="{'btn-danger':article.useful == false, 'btn-dark': article.useful == null || article.useful == true}" class="btn px-4 py-2"> <font-awesome-icon icon="thumbs-down"/> Not Useful</button>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col">
                        <div class="comment" v-for="(comment,index) in article.comments" :key="index">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="https://picsum.photos/id/50/50" alt="">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <span class="author h5">{{ comment.user.name }}</span> 

                                    <span v-if="comment.user.id == article.author_id" class="author badge bg-primary mx-1">Author</span> 
                                    Says: 
                                    <a v-if="user && user.id == comment.user.id" class="float-right text-danger btn" @click="deleteComment(comment.id)">X</a>
                                    <p class="h4">
                                        {{ comment.comment }}
                                    </p>
                                </div>
                            </div>
                            <hr class="my-3"/>
                        </div>
                    </div>
                </div>
                
                <div class="row" v-if="user">
                    <div class="col">
                        <div class="form-group">
                            <textarea v-model="form.comment" :class="{'is-invalid':errors.comment}" class="form-control" id="comment" placeholder="Enter Comment"></textarea>
                            <InputError :message="errors.comment"/>
                        </div>
                        <button type="button" @click="createComment" class="mt-3 btn btn-primary">Submit</button>
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
        errors:Object,
        article:Object,
    },
    data(){
        return {
            form: {
                comment: null
            }
        }
    },
    computed:{
        user() {
            return this.$page.props.auth.user
        },
    },
    methods:{
        createComment(){
            this.$inertia.post(route('website.articles.create_comment', this.article.id), this.form,{
                preserveScroll: true,
            });
            this.form.comment = null
        },
        deleteComment(id){
            this.$inertia.delete(route('website.articles.delete_comment', id),{
                preserveScroll: true,
            });
        },
        setUseful(up){
            this.$inertia.post(route('website.articles.set_useful', this.article.id),{
                up
            },{
                preserveScroll: true,
            });
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
        padding:81px;
        position: relative;
    }

    .article_title{
        font-size: 35px;
        text-transform: capitalize;
        font-weight: bolder;
        font-family: initial;
        letter-spacing: 4px;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .article_subtitle a{
        color: #ffffff;
        font-size: 14px;
        text-transform: uppercase;
        font-family: initial;
        letter-spacing: 4px;
        margin-bottom: 40px;
    }

    .article_image{
        width: 100%;
        height: 400px;
    }

    .author{
        font-size: 15px;
        font-family: revert;
        font-style: oblique;
    }
</style>