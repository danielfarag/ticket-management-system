<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="type">Type</label>
                    <Select2 :settings="settings" v-model="form.type" :class="{'is-invalid':errors.type}" :options="types"/>

                    <InputError :message="errors.type"/>

                    <span 
                    class="placeholders badge badge-primary mr-2" 
                    v-for="(placeholder,index) in placeholders" 
                    :key="index"
                    v-clipboard:copy="'[' + placeholder + ']'"
                    v-clipboard:success="onCopy"
                    v-clipboard:error="onError"
                    >[{{ placeholder }}]</span>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" v-model="form.subject" :class="{'is-invalid':errors.subject}" class="form-control"  id="subject" placeholder="Enter Subject"/>
                  
                    <InputError :message="errors.subject"/>
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <editor v-model="form.body" :class="{'is-invalid':errors.body}" id="body" :api-key="editorApiKey" placeholder="Enter Body"/>

                    <InputError :message="errors.body"/>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" v-model="form.default" class="custom-control-input" id="default">
                        <label class="custom-control-label" for="default">Default</label>
                    </div>
                    
                    <InputError :message="errors.default"/>
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
        mailTemplate:Object
    },
    data(){
        return {
            form:{
                type:null,
                subject:null,
                body:null,
                default:true,
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    computed:{
        _types(){
            return this.$page.props.mail_templates
        },
        types(){
            return Object.keys(this._types)
        },
        placeholders(){
            if(this.form.type){
                return this._types[this.form.type];
            }
            return [];
        },
        cardTitle(){
            return this.mailTemplate ? 'Edit Mail Template' : 'Create New Mail Template';
        }
    },
    mounted(){
        if(this.mailTemplate){
            this.form.type = this.mailTemplate.type;
            this.form.subject = this.mailTemplate.subject;
            this.form.body = this.mailTemplate.body;
            this.form.default = this.mailTemplate.default == true;
        }
    },
    methods:{
        store(){
            if(this.mailTemplate){
                this.$inertia.put(route('mail_templates.update', this.mailTemplate.id), {...this.form, id:this.mailTemplate.id})
            }else{
                this.$inertia.post(route('mail_templates.store'), this.form)
            }
        },
        onCopy(){
            this.$toast.show('Copied!',{
                type:'success'
            });
        },
        onError(){
            this.$toast.show('Failed To Copy!',{
                type:'error'
            });
        },
    }
}
</script>

<style scoped>
    .placeholders{
        cursor: pointer;
    }
</style>
