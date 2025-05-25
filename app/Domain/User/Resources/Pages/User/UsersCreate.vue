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
        

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" v-model="form.email" :class="{'is-invalid':errors.email}" class="form-control"  id="email" placeholder="Enter Email Address">
                           
                            <InputError :message="errors.email"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" v-model="form.phone_number" :class="{'is-invalid':errors.phone_number}" class="form-control"  id="phone_number" placeholder="Enter Phone Number">
                            
                            <InputError :message="errors.phone_number"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" v-model="form.password" :class="{'is-invalid':errors.password}" class="form-control"  id="password" placeholder="Password">
                            
                            <InputError :message="errors.password"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" v-model="form.password_confirmation" :class="{'is-invalid':errors.password}" class="form-control"  id="password_confirmation" placeholder="Password Confirmation">
                            
                            <InputError :message="errors.password"/>
                        </div>
                    </div>
                </div>

                <div class="form-group" v-if="user.type == 'admin'">
                    <label for="type">Type</label>
                    <Select2 :settings="settings"  v-model="form.type" :class="{'is-invalid':errors.type}" :options="types"/>

                    <InputError :message="errors.type"/>
                </div>

                <div class="form-group" v-if="user.type == 'admin'">
                    <label for="role_id">Role</label>
                    <Select2 :settings="settings"  v-model="form.role_id" :class="{'is-invalid':errors.role_id}" :options="_roles"/>

                    <InputError :message="errors.role_id"/>
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
        roles: Object,
        user:Object
    },
    data(){
        return {
            form:{
                name:null,
                email:null,
                phone_number:null,
                password:null,
                password_confirmation:null,
                role_id:null,
                status:'active',
                type:'user',
            },
            types:['admin', 'agent','user'],
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    mounted(){
        if(this.user){
            this.form.name = this.user.name;
            this.form.email = this.user.email;
            this.form.phone_number = this.user.phone_number;
            this.form.status = this.user.status;
            this.form.role_id = this.user.role?.id ?? null;
            this.form.type = this.user.type;
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
        _roles:function(){
            return this.roles.map(role=>({id:role.id, text:role.name}))
        },
        user:function(){
            return this.$page.props.auth.user;
        },
        cardTitle(){
            return this.user ? 'Edit User' : 'Create New User';
        }
    },
    methods:{
        store(){
            if(this.user){
                this.$inertia.put(route('users.update', this.user.id), {...this.form, id:this.user.id})
            }else{
                this.$inertia.post(route('users.store'), this.form)
            }
        }
    }
}
</script>