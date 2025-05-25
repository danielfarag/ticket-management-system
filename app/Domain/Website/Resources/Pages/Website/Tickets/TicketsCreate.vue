<template>

    <Head title="Create Ticket Page" />

    <WebsiteProfileLayout>
        <div class="row">
            <div class="col">
                <div class="card bg-light rounded-3">
                    <div class="card-header">
                        <p class="h5">Create New Ticket</p>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" v-model="form.subject" :class="{'is-invalid':errors.subject}" class="form-control"  id="subject" placeholder="Enter Subject">
                        
                            <InputError :message="errors.subject"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="text" v-model="form.body" :class="{'is-invalid':errors.body}" class="form-control"  id="body" placeholder="Enter Body"></textarea>
                        
                            <InputError :message="errors.body"/>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <Select2 :settings="_settings" v-model="form.category_id" :class="{'is-invalid':errors.category_id}" :options="_categories"/>

                                    <InputError :message="errors.category_id"/>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="attachments">Attachments</label>
                            <input type="file" @change="form.attachments = $event.target.files" multiple :class="{'is-invalid':errors.attachments}" class="form-control"  id="attachments">
                        
                            <InputError :message="errors.attachments"/>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" @click="store" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    </WebsiteProfileLayout>

</template>


<script>
import WebsiteProfileLayout from '@/Layouts/WebsiteProfile.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'

export default {
    components: {
        Head,
        Link,
        WebsiteProfileLayout,
        InputError,

    },
    props:{
        errors: Object,
        categories: Array,
        statuses: Array,
        severities: Array,
        ticket:Object
    },
    computed:{
        user:function(){
            return this.$page.props.auth.user
        },
        _categories:function(){
            return this.categories.map(category=>({id:category.id, text:category.name}))
        },
        settings:function(){
            return this.$page.props.settings
        },
        status_id:function(){
            return this.settings.default_status ?? ( this.statuses[0]?.id ?? null);
        },
        severity_id:function(){
            return this.settings.default_severity ?? ( this.severities[0]?.id ?? null);
        },
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
                solved:false,
                attachments:[],
            },
            _settings:{
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
            this.form.attachments = this.ticket.attachments;
        }else{
            this.form.user_id = this.user.id
            this.form.severity_id = this.severity_id
            this.form.status_id = this.status_id
            this.form.solved = 'no';
        }
    },
    methods:{
        store(){
            if(this.ticket){
                this.$inertia.post(route('website.tickets.update', this.ticket.id), {...this.form, _method:"put", id:this.ticket.id})
            }else{
                this.$inertia.post(route('website.tickets.store'), this.form)
            }
        }
    }
}
</script>