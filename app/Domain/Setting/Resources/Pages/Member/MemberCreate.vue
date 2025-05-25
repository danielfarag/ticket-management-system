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
                    <label for="title">Title</label>
                    <input type="text" v-model="form.title" :class="{'is-invalid':errors.title}" class="form-control"  id="title" placeholder="Enter Title">
                  
                    <InputError :message="errors.title"/>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea v-model="form.description" :class="{'is-invalid':errors.description}" class="form-control"  id="description" placeholder="Enter Description"></textarea>
                  
                    <InputError :message="errors.description"/>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" @change="form.image = $event.target.files[0]" :class="{'is-invalid':errors.image}" id="image">
                
                    <InputError :message="errors.image"/>

                    <img class="d-block" width="150" :src="member?.image"/>

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
        member: Object,
    },
    data(){
        return {
            form:{
                name:null,
                title:null,
                description:null,
                image:null,
            },
        }
    },
    computed:{
        cardTitle(){
            return this.member ? 'Edit Member' : 'Create New Member';
        }
    },
    mounted(){
        if(this.member){
            this.form.name = this.member.name;
            this.form.title = this.member.title;
            this.form.description = this.member.description;
        }
    },
    methods:{
        store(){
            if(this.member){
                this.$inertia.post(route('members.update', this.member.id), {...this.form, _method:'PUT', id:this.member.id})
            }else{
                this.$inertia.post(route('members.store'), this.form)
            }
        }
    }
}
</script>
