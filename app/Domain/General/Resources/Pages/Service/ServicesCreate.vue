<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <Select2 :settings="settings" v-model="form.icon" :class="{'is-invalid':errors.icon}" :options="icons"/>

                    <InputError :message="errors.icon"/>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" v-model="form.title" :class="{'is-invalid':errors.title}" class="form-control"  id="title" placeholder="Enter Title">
                
                    <InputError :message="errors.title"/>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea v-model="form.description"  :class="{'is-invalid':errors.description}" class="form-control" id="description" placeholder="Enter Description"></textarea>
                
                    <InputError :message="errors.description"/>
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
        service:Object
    },
    data(){
        return {
            form:{
                icon:null,
                title:null,
                description:null,
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
        if(this.service){
            this.form.icon = this.service.icon;
            this.form.title = this.service.title;
            this.form.description = this.service.description;
            this.form.status = this.service.status;
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
            return this.service ? 'Edit Service' : 'Create New Service';
        }
    },
    methods:{
        store(){
            if(this.service){
                this.$inertia.put(route('services.update', this.service.id), {...this.form, id:this.service.id})
            }else{
                this.$inertia.post(route('services.store'), this.form)
            }
        }
    }
}
</script>
