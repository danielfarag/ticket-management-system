<template>
    <Head :title="'Dashboard - Escalation - ' + escalation.ticket.subject" />

    <AuthenticatedLayout>
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <EntityShow :settings="settings">
                        <template #column_value_ticket="escalation">
                            <Link :href="$route('tickets.show', escalation.ticket_id)" target="_blank">
                                {{ escalation.ticket.subject }}
                            </Link>
                        </template>
                        <template #column_value_creator="escalation">
                            <Link :href="$route('users.show', escalation.creator_id)" target="_blank">
                                {{ escalation.agent.name }}
                            </Link>
                        </template>
                    </EntityShow>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <EscalationReplies :escalation="escalation" :errors="errors"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import EntityShow from '@/Components/EntityShow.vue'
import EscalationReplies from '@/Components/EscalationReplies.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        EntityShow,
        EscalationReplies
    },
    props:{
        escalation:Object,
        errors:Object
    },
    computed:{
        settings(){
            return {
                entity: this.escalation,
                lang: {
                    entity: 'Escalation',
                },
                routes:{
                    bind: 'escalation',
                    edit: 'escalations.edit',
                    destroy: 'escalations.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Ticket',
                        key:'ticket'
                    },
                    { 
                        label:'Creator',
                        key:'creator'
                    },
                    { 
                        label:'Body',
                        key:'body'
                    },
                    { 
                        label:'Status',
                        key:'status'
                    },
                    { 
                        label:'Created At',
                        key:'created_at'
                    },
                    { 
                        label:'Updated At',
                        key:'updated_at'
                    },
                ]
            }
        }
    },
}
</script>
