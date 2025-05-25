<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="in">In</label>
                    <Select2 :settings="settings" v-model="form.in" :class="{'is-invalid':errors.in}" :options="options"/>

                    <InputError :message="errors.in"/>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <editor v-model="form.content"  :class="{'is-invalid':errors.content}" id="content" :api-key="editorApiKey" placeholder="Enter Announcement Content"/>
                  
                    <InputError :message="errors.content"/>
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
        announcement:Object
    },
    data(){
        return {
            form:{
                in:'dashboard',
                content:null,
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            },
            options: ['dashboard', 'website']
        }
    },
    computed:{
        cardTitle(){
            return this.announcement ? 'Edit Announcement' : 'Create New Announcement';
        }
    },
    mounted(){
        if(this.announcement){
            this.form.in = this.announcement.in;
            this.form.content = this.announcement.content;
        }
    },
    methods:{
        store(){
            if(this.announcement){
                this.$inertia.put(route('announcements.update', this.announcement.id), {...this.form, id:this.announcement.id})
            }else{
                this.$inertia.post(route('announcements.store'), this.form)
            }
        }
    }
}
</script>
