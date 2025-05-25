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
                    <input type="text" v-model="form.name" :class="{'is-invalid':errors.name}" class="form-control"  id="name" placeholder="Enter Username">
                  
                    <InputError :message="errors.name"/>
                </div>
        
                <div class="form-group">
                    <label for="name"> Permissions  <a :href="$route('export', 'permissions')" target="_black" class="mx-3">( download permissions )</a> </label>
                    <InputError :message="errors.permissions"/>
                    <div class="row">
                        <div class="col-3 mb-4" v-for="(per,index) in permissions" :key="index">
                            <h3 class="permission_name">{{ per.name }}</h3>
                            <div class="form-group" v-for="(value, name) in per.permissions" :key="name">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" v-model="form.permissions[name]" :id="name">
                                    <label class="custom-control-label" :for="name">{{ value }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
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
        role:Object,
        permissions:Array,
    },
    data(){
        return {
            form:{
                name:null,
                permissions:{}
            },
        }
    },
    mounted(){
        if(this.role){
            this.form.name = this.role.name;
            this.role.permissions.map(permission=>this.form.permissions[permission.name] = true)
        }
    },
    computed:{
        cardTitle(){
            return this.role ? 'Edit Role' : 'Create New Role';
        }
    },
    watch:{
        form:{
            handler(value){
                for(var key in value.permissions){
                    if(value.permissions.hasOwnProperty(key) && value.permissions[key] == false){
                        delete this.form.permissions[key];
                    }
                }
            },
            deep: true
        }
    },
    methods:{
        store(){
            if(this.role){
                this.$inertia.put(route('roles.update', this.role.id), {...this.form, permissions: Object.keys(this.form.permissions), id:this.role.id})
            }else{
                this.$inertia.post(route('roles.store'), {...this.form, permissions: Object.keys(this.form.permissions)})
            }
        }
    }
}
</script>


<style scoped>
    .custom-control-label{
        font-weight: unset !important;
    }
    .permission_name{
        text-transform: capitalize;
    }
    .permission{
        text-transform: uppercase;
        font-weight: bolder;
        text-decoration: underline;
    }
</style>