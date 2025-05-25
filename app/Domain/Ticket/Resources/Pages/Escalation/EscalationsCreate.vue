<template>
    <Head :title="cardTitle" />

    <AuthenticatedLayout>
        <div class="card card-primary">

            <div class="card-header">
                <p class="h5">{{ cardTitle }}</p>
            </div>

            <div class="card-body">
                <div v-if="!ticket_id" class="form-group">
                    <label for="ticket_id">Ticket</label>
                    <Select2 :settings="settings" v-model="form.ticket_id" :class="{'is-invalid':errors.ticket_id}" :options="_tickets"/>

                    <InputError :message="errors.ticket_id"/>
                </div>

                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea v-model="form.body" :class="{'is-invalid':errors.body}" id="body" class="form-control" placeholder="Enter Body"></textarea>
                    <InputError :message="errors.body"/>
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
        escalation: Object,
        tickets: Object,
        ticket_id: Number,
    },
    data(){
        return {
            form:{
                ticket_id:null,
                body:null,
                status:'pending',
            },
            statuses:['pending', 'in_progress', 'solved'],
            settings:{
                theme: "classic",
                escapeMarkup: function (markup) { return markup; } 
            }
        }
    },
    computed:{
        cardTitle(){
            return this.escalation ? 'Edit Escalation' : 'Create New Escalation';
        },
        _tickets:function(){
            return this.tickets.map(ticket=>({id:ticket.id, text:ticket.subject}))
        },
    },
    mounted(){
        if(this.ticket_id){
            this.form.ticket_id = this.ticket_id;
        }

        if(this.escalation){
            this.form.ticket_id = this.escalation.ticket_id;
            this.form.body = this.escalation.body;
            this.form.status = this.escalation.status;
        }
    },
    methods:{
        store(){
            if(this.escalation){
                this.$inertia.put(route('escalations.update', this.escalation.id), {...this.form, id:this.escalation.id})
            }else{
                this.$inertia.post(route('escalations.store'), this.form)
            }
        }
    }
}
</script>
