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
                    <input type="text" v-model="form.name" :class="{'is-invalid':errors.name}" class="form-control"  id="name" placeholder="Enter Name">
                
                    <InputError :message="errors.name"/>
                </div>
        
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <Select2 :settings="settings" v-model="form.icon" :class="{'is-invalid':errors.icon}" :options="icons"/>

                    <InputError :message="errors.icon"/>
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
        request:Object,
        category:Object
    },
    data(){
        return {
            form:{
                name:null,
                type:null,
                icon:null,
                status:'active',
            },
            icons:[
                {
                    id:'lock',
                    text:'<i class="fas fa-lock"></i> lock'
                },
                {
                    id:'plus',
                    text:'<i class="fas fa-plus"></i> plus'
                },
                {
                    id:'download',
                    text:'<i class="fas fa-download"></i> download'
                },
                {
                    id:'upload',
                    text:'<i class="fas fa-upload"></i> upload'
                },
                {
                    id:'bell',
                    text:'<i class="fas fa-bell"></i> bell'
                },
                {
                    id:'eye',
                    text:'<i class="fas fa-eye"></i> eye'
                },
                {
                    id:'envelope',
                    text:'<i class="fas fa-envelope"></i> envelope'
                },
                {
                    id:'user',
                    text:'<i class="fas fa-user"></i> user'
                },
                {
                    id:'edit',
                    text:'<i class="fas fa-edit"></i> edit'
                },
            ],
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }

        }
    },
    mounted(){
        this.form.type = this.request.type

        if(this.category){
            this.form.icon = this.category.icon;
            this.form.name = this.category.name;
            this.form.status = this.category.status;
        }
    },
    computed:{
        status:{
            get:function(){
                return this.form.status == 'active'
            },
            set:function(value){
                this.form.status = value ?  'active' : 'inactive'
            }
        },
        cardTitle(){
            return this.category ? 'Edit Category' : 'Create New Category';
        }
    },
    methods:{
        store(){
            if(this.id){
                this.$inertia.put(route('categories.update', { type: this.request.type, id:this.id}), {...this.form, id:this.id})
            }else{
                this.$inertia.post(route('categories.store', { type: this.request.type}), this.form)
            }
        },
    }
}
</script>
