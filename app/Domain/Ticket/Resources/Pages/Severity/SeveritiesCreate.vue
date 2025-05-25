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
                    <input type="text" v-model="form.name" :class="{'is-invalid':errors.name}" class="form-control"  id="name" placeholder="Enter Status Name">
                  
                    <InputError :message="errors.name"/>
                </div>
                
                <div class="form-group">
                    <label for="priority">Proprity</label>
                    <input type="number" v-model="form.priority" :class="{'is-invalid':errors.priority}" class="form-control"  id="priority" placeholder="Enter Priority">
                
                    <InputError :message="errors.priority"/>
                </div>
                
                <div class="form-group">
                    <label for="color" class="d-block">Color</label>
                    <input type="color" v-model="form.color" :class="{'is-invalid':errors.color}" id="color">
                
                    <InputError :message="errors.color"/>
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
        severity:Object
    },
    data(){
        return {
            form:{
                name:null,
                priority:0,
                color:'#000000',
                status:'active',
            },
        }
    },
    mounted(){
        if(this.severity){
            this.form.name = this.severity.name;
            this.form.priority = this.severity.priority;
            this.form.color = this.severity.color;
            this.form.status = this.severity.status;
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
            return this.severity ? 'Edit Severity' : 'Create New Severity';
        }
    },
    methods:{
        store(){
            if(this.severity){
                this.$inertia.put(route('severities.update', this.severity.id), {...this.form, id:this.severity.id})
            }else{
                this.$inertia.post(route('severities.store'), this.form)
            }
        }
    }
}
</script>
