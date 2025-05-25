<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>

        <div class="card card-primary">
            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" v-model="form.subject" :class="{'is-invalid':errors.subject}" class="form-control"  id="subject" placeholder="Enter Subject">
                  
                    <InputError :message="errors.subject"/>
                </div>
                
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea v-model="form.body" :class="{'is-invalid':errors.body}" class="form-control"  id="body" placeholder="Enter Body"></textarea>
                  
                    <InputError :message="errors.body"/>
                </div>

                <div class="form-group">
                    <label for="user">User</label>
                    <Select2 :settings="settings" v-model="form.user_id" :class="{'is-invalid':errors.user_id}" :options="_users"/>

                    <InputError :message="errors.user_id"/>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <Select2 :settings="settings" v-model="form.category_id" :class="{'is-invalid':errors.category_id}" :options="_categories"/>

                            <InputError :message="errors.category_id"/>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="severity">Severity</label>
                            <Select2 :settings="settings" v-model="form.severity_id" :class="{'is-invalid':errors.severity_id}" :options="_severities"/>

                            <InputError :message="errors.severity_id"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <Select2 :settings="settings" v-model="form.status_id" :class="{'is-invalid':errors.status_id}" :options="_statuses"/>
                        
                            <InputError :message="errors.status_id"/>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="attachments">Attachments</label>
                    <input type="file" @change="form.attachments = $event.target.files" multiple :class="{'is-invalid':errors.attachments}" class="form-control"  id="attachments">
                  
                    <InputError :message="errors.attachments"/>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" v-model="solved" class="custom-control-input" id="solved">
                        <label class="custom-control-label" for="solved">Solved</label>
                    </div>
                    
                    <InputError :message="errors.solved"/>
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
        categories: Array,
        users: Array,
        statuses: Array,
        severities: Array,
        ticket:Object
    },
    computed:{
        _statuses:function(){
            return this.statuses.map(status=>({id:status.id, text:status.name}))
        },
        _categories:function(){
            return this.categories.map(category=>({id:category.id, text:category.name}))
        },
        _severities:function(){
            return this.severities.map(severity=>({id:severity.id, text:severity.name}))
        },
        _users:function(){
            return this.users.map(user=>({id:user.id, text:user.name}))
        },
        solved:{
            get:function(){
                return this.form.solved == 'yes'
            },
            set:function(value){
                this.form.solved = value ?  'yes' : 'no'
            }
        },
        cardTitle(){
            return this.ticket ? 'Edit Ticket' : 'Create New Ticket';
        }
    },
    data(){
        return {
            form:{
                subject:null,
                body:null,
                user_id:null,
                category_id:null,
                severity_id:null,
                status_id:null,
                solved:'no',
                attachments:[],
            },
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    mounted(){
        if(this.ticket){
            this.form.subject = this.ticket.subject;
            this.form.body = this.ticket.body;
            this.form.user_id = this.ticket.user_id;
            this.form.category_id = this.ticket.category.id;
            this.form.severity_id = this.ticket.severity_id;
            this.form.status_id = this.ticket.status_id;
            this.form.solved = this.ticket.solved;
        }
    },
    methods:{
        store(){
            if(this.ticket){
                this.$inertia.post(route('tickets.update', this.ticket.id), {...this.form, _method: 'put', id:this.ticket.id})
            }else{
                this.$inertia.post(route('tickets.store'), this.form)
            }
        }
    }
}
</script>
