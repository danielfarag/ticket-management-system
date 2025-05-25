<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="email">Email</label>
                    <Select2 :settings="{...settings, multiple: true, tags: true}" v-model="form.email" :class="{'is-invalid':errors.status}" :options="form.email"/>
                    <InputError :message="errors.email"/>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" v-model="form.subject" :class="{'is-invalid':errors.subject}" class="form-control"  id="subject" placeholder="Enter Subject"/>
                  
                    <InputError :message="errors.subject"/>
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <editor v-model="form.body"  :class="{'is-invalid':errors.body}" id="body" :api-key="editorApiKey" placeholder="Enter Body"/>

                    <InputError :message="errors.body"/>
                </div>

                <div class="form-group">
                    <label for="send_at">Send At</label>
                    <Datepicker v-model="form.send_at" :class="{'is-invalid':errors.send_at}" id="send_at"  placeholder="Create Date" ></Datepicker>

                    <InputError :message="errors.send_at"/>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <Select2 :settings="settings" v-model="form.status" :class="{'is-invalid':errors.status}" :options="statuses"/>

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
        mail:Object
    },
    data(){
        return {
            form:{
                email:null,
                subject:null,
                body:null,
                send_at:null,
                status:'pending',
            },
            statuses:['pending','sent','cancelled'],
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    computed:{
        cardTitle(){
            return this.mail ? 'Edit Mail' : 'Create New Mail';
        }
    },
    mounted(){
        if(this.mail){
            this.form.email = this.mail.email.split(',');
            this.form.subject = this.mail.subject;
            this.form.body = this.mail.body;
            this.form.send_at = this.mail.send_at;
            this.form.status = this.mail.status;
        }
    },
    methods:{
        store(){
            if(this.mail){
                this.$inertia.put(route('mails.update', this.mail.id), {...this.form, id:this.mail.id})
            }else{
                this.$inertia.post(route('mails.store'), this.form)
            }
        }
    }
}
</script>
