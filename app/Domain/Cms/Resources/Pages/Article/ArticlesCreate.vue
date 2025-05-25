<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" v-model="form.title" :class="{'is-invalid':errors.title}" class="form-control"  id="title" placeholder="Enter Title">
                  
                    <InputError :message="errors.title"/>
                </div>
        
                <div class="form-group">
                    <label for="body">Body</label>
                    <editor v-model="form.body" :class="{'is-invalid':errors.body}" id="body" :api-key="editorApiKey" placeholder="Enter Body"/>
                    <InputError :message="errors.body"/>
                </div>
        
                <div class="form-group">
                    <label for="category">Category</label>
                    <Select2 :settings="settings" v-model="form.category_id" :class="{'is-invalid':errors.category_id}" :options="_categories"/>

                    <InputError :message="errors.category_id"/>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" @change="form.image = $event.target.files[0]" :class="{'is-invalid':errors.image}" id="image">
                
                    <InputError :message="errors.image"/>
               
                    <img class="d-block" width="150" :src="article?.image"/>
                </div>

                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" v-model="status" class="custom-control-input" id="status">
                    <label class="custom-control-label" for="status">Active</label>
                </div>
                
                <InputError :message="errors.status"/>
            </div>


            <div class="card-footer">
                <button type="submit" @click="store" class="btn btn-primary">Submit</button>
            </div>
            
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        InputError,
    },
    props:{
        errors: Object,
        article:Object,
        categories:Object,
    },
    computed:{
        _categories:function(){
            return this.categories.map(category=>({id:category.id, text:category.name}))
        },
        status:{
            get:function(){
                return this.form.status == 'active'
            },
            set:function(value){
                this.form.status = value ?  'active' : 'inactive'
            }
        },
        cardTitle(){
            return this.article ? 'Edit Article' : 'Create New Article';
        }
    },

    data(){
        return {
            form:{
                title:null,
                body:null,
                image:null,
                category_id: null,
                status:'active',
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    mounted(){
        if(this.article){
            this.form.title = this.article.title;
            this.form.body = this.article.body;
            this.form.category_id = this.article.category.id;
            this.form.status = this.article.status;
        }
    },

    methods:{
        store(){
            if(this.article){
                this.$inertia.post(route('articles.update', this.article.id), {...this.form, '_method':"PUT", id:this.article.id})
            }else{
                this.$inertia.post(route('articles.store'), this.form)
            }
        }
    }
}
</script>
