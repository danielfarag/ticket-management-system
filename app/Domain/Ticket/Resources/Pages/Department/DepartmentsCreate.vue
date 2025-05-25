<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" :class="{'is-invalid':errors.name}" class="form-control"  id="name" placeholder="Enter Department Name">
                  
                    <InputError :message="errors.name"/>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea v-model="form.description" :class="{'is-invalid':errors.description}" class="form-control"  id="description" placeholder="Enter Department Description"></textarea>
                
                    <InputError :message="errors.description"/>
                </div>
                                
                <div class="form-group">
                    <label for="image" class="d-block">Image</label>
                    <input type="file" @change="form.image = $event.target.files[0]" :class="{'is-invalid':errors.image}" id="image">
                
                    <InputError :message="errors.image"/>
                 
                    <img class="d-block" width="150" :src="department?.image"/>
                </div>

                <div class="form-group">
                    <label for="categories">Categories</label>
                    <Select2 :settings="settings" v-model="form.categories" :class="{'is-invalid':errors.categories}" :options="_categories"/>

                    <InputError :message="errors.categories"/>
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
        department:Object,
        categories:Array
    },
    data(){
        return {
            form:{
                name:null,
                description:null,
                image:null,
                categories:[],
                status:'active',
            },
            settings:{
                multiple:true,
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    mounted(){
        if(this.department){
            this.form.name = this.department.name;
            this.form.description = this.department.description;
            this.form.categories = this.department.categories?.map(category=>category.id);
            this.form.status = this.department.status;
        }
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
            return this.department ? 'Edit Department' : 'Create New Department';
        }
    },
    methods:{
        store(){
            if(this.department){
                this.$inertia.post(route('departments.update', this.department.id), {...this.form, '_method':"PUT", id:this.department.id})
            }else{
                this.$inertia.post(route('departments.store'), this.form)
            }
        }
    }
}
</script>
