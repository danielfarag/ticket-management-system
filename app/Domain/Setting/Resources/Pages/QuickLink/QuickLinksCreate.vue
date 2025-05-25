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
                    <input type="text" v-model="form.title" :class="{'is-invalid':errors.title}" class="form-control"  id="title" placeholder="Enter Title"/>
                  
                    <InputError :message="errors.title"/>
                </div>
                
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" v-model="form.url" :class="{'is-invalid':errors.url}" class="form-control"  id="url" placeholder="Enter Url"/>
                  
                    <InputError :message="errors.url"/>
                </div>
                
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <input type="number" v-model="form.priority" :class="{'is-invalid':errors.priority}" class="form-control"  id="priority" placeholder="Enter Priority"/>
                  
                    <InputError :message="errors.priority"/>
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
        quickLink:Object
    },
    data(){
        return {
            form:{
                title:null,
                url:null,
                priority:0,
            },
        }
    },
    computed:{
        cardTitle(){
            return this.quickLink ? 'Edit Quick Link' : 'Create New Quick Link';
        }
    },
    mounted(){
        if(this.quickLink){
            this.form.title = this.quickLink.title;
            this.form.url = this.quickLink.url;
            this.form.priority = this.quickLink.priority;
        }
    },
    methods:{
        store(){
            if(this.quickLink){
                this.$inertia.put(route('quick_links.update', this.quickLink.id), {...this.form, id:this.quickLink.id})
            }else{
                this.$inertia.post(route('quick_links.store'), this.form)
            }
        }
    }
}
</script>
