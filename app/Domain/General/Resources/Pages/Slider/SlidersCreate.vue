<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" v-model="form.title" :class="{'is-invalid':errors.title}" class="form-control" id="title" placeholder="Enter Slider Title">
                  
                    <InputError :message="errors.title"/>
                </div>
                
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <textarea v-model="form.subtitle" :class="{'is-invalid':errors.subtitle}" class="form-control" id="subtitle" placeholder="Enter Slider Subtitle"></textarea>
                  
                    <InputError :message="errors.subtitle"/>
                </div>
                
                <div class="form-group">
                    <label for="button">Button</label>
                    <input type="text" v-model="form.button" :class="{'is-invalid':errors.button}" class="form-control" id="button" placeholder="Enter Slide Button Text">
                
                    <InputError :message="errors.button"/>
                </div>
                
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" v-model="form.link" :class="{'is-invalid':errors.link}" class="form-control" id="link" placeholder="Enter Slider Link">
                
                    <InputError :message="errors.link"/>
                </div>
                
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" @change="form.image = $event.target.files[0]" :class="{'is-invalid':errors.image}" id="image">
                
                    <InputError :message="errors.image"/>

                    <img class="d-block" width="150" :src="slider?.image"/>

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
        slider:Object
    },
    data(){
        return {
            form:{
                title:null,
                subtitle:null,
                button:null,
                link:null,
                image:null,
                status:'active',
            },
        }
    },
    mounted(){
        if(this.slider){
            this.form.title = this.slider.title;
            this.form.subtitle = this.slider.subtitle;
            this.form.button = this.slider.button;
            this.form.link = this.slider.link;
            this.form.status = this.slider.status;
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
            return this.slider ? 'Edit Slider' : 'Create New Slider';
        }
    },
    methods:{
        store(){
            if(this.slider){
                this.$inertia.post(route('sliders.update', this.slider.id), {...this.form, '_method':"PUT", id:this.slider.id})
            }else{
                this.$inertia.post(route('sliders.store'), this.form)
            }
        }
    }
}
</script>
