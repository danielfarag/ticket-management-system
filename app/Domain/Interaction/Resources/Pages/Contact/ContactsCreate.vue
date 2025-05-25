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
                    <input type="text" v-model="form.name" :class="{'is-invalid':errors.name}" class="form-control"  id="name" placeholder="Enter Content"/>
                  
                    <InputError :message="errors.name"/>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" v-model="form.email" :class="{'is-invalid':errors.email}" class="form-control"  id="email" placeholder="Enter Content"/>
                  
                    <InputError :message="errors.email"/>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone number</label>
                    <input type="text" v-model="form.phone_number" :class="{'is-invalid':errors.phone_number}" class="form-control"  id="phone_number" placeholder="Enter Content"/>
                  
                    <InputError :message="errors.phone_number"/>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <editor v-model="form.message"  :class="{'is-invalid':errors.message}" id="message" :api-key="editorApiKey" placeholder="Enter Content"/>

                    <InputError :message="errors.message"/>
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
        contact:Object
    },
    data(){
        return {
            form:{
                name:null,
                email:null,
                phone_number:null,
                message:null,
            },
        }
    },
    computed:{
        cardTitle(){
            return this.contact ? 'Edit Contact' : 'Create New Contact';
        }
    },
    mounted(){
        if(this.contact){
            this.form.name = this.contact.name;
            this.form.email = this.contact.email;
            this.form.phone_number = this.contact.phone_number;
            this.form.message = this.contact.message;
        }
    },
    methods:{
        store(){
            if(this.contact){
                this.$inertia.put(route('contacts.update', this.contact.id), {...this.form, id:this.contact.id})
            }else{
                this.$inertia.post(route('contacts.store'), this.form)
            }
        }
    }
}
</script>
