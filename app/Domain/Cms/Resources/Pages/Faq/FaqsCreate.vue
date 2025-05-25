<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" v-model="form.question" :class="{'is-invalid':errors.question}" class="form-control"  id="question" placeholder="Enter Question">
                  
                    <InputError :message="errors.question"/>
                </div>
        
                <div class="form-group">
                    <label for="answer">Answer</label>
                    <editor v-model="form.answer"  :class="{'is-invalid':errors.answer}" id="answer" :api-key="editorApiKey" placeholder="Enter Answer"/>
                  
                    <InputError :message="errors.answer"/>
                </div>

                <div class="form-group">
                    <label for="department_id">Department</label>
                    <Select2 :settings="settings" v-model="form.department_id" :class="{'is-invalid':errors.department_id}" :options="_departments"/>

                    <InputError :message="errors.department_id"/>
                </div>

                <div class="form-group">
                    <label for="article_id">Article</label>
                    <Select2  :settings="{...settings, allowClear:true }" v-model="form.article_id" :class="{'is-invalid':errors.article_id}" :options="_articles"/>

                    <InputError :message="errors.article_id"/>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" v-model="status" class="custom-control-input" id="status">
                        <label class="custom-control-label" for="status">Active</label>
                    </div>
                    
                    <InputError :message="errors.status"/>
                </div>
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
        faq:Object,
        departments: Array,
        articles: Array,
    },
    computed:{
        _departments:function(){
            return this.departments.map(department=>({id:department.id, text:department.name}))
        },
        _articles:function(){
            return this.articles.map(article=>({id:article.id, text:article.title}))
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
            return this.faq ? 'Edit Faq' : 'Create New Faq';
        }
    },
    data(){
        return {
            form:{
                question:null,
                answer:null,
                department_id:null,
                article_id:null,
                status:'active',
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    mounted(){
        if(this.faq){
            this.form.question = this.faq.question;
            this.form.answer = this.faq.answer;
            this.form.department_id = this.faq.department_id;
            this.form.article_id = this.faq.article_id;
            this.form.status = this.faq.status;
        }
    },
    methods:{
        store(){
            if(this.faq){
                this.$inertia.put(route('faqs.update', this.faq.id), {...this.form, id:this.faq.id})
            }else{
                this.$inertia.post(route('faqs.store'), this.form)
            }
        }
    }
}
</script>
