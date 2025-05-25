<template>
    <Head :title="'Dashboard - Ticket - ' + ticket.subject" />
   
    <AuthenticatedLayout>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <EntityShow :settings="settings">
                                    <template #column_value_category="ticket">
                                        {{ ticket.category?.name }}
                                        <TicketUpdateCategory @updateCategory="updateCategory" :categories="categories" :ticket="ticket" :errors="errors"/>
                                    </template>

                                    <template #column_value_user="ticket">
                                        {{ ticket.user?.name }}
                                    </template>
                                    
                                    <template #column_value_escalation="ticket">
                                        <div v-if="ticket.isEscalated">
                                            <Link :href="$route('escalations.show', ticket.escalation,id)">
                                                <span class="text-danger"><code>Raised</code></span>
                                                <span class="text-primary"> [ {{ ticket.escalation.status }} ]</span>
                                            </Link>
                                        </div>
                                        <span v-else class="text-success">no</span>
                                    </template>

                                    <template #column_value_agents="ticket">
                                        <ul v-if="ticket.agents.length > 0">
                                            <li v-for="(agent,index) in ticket.agents" :key="index">{{ agent.name }}</li>
                                        </ul>
                                        <span v-else class="badge badge-danger">No Agents Assigned</span>
                                        <TicketUpdateAgents @updateAgents="updateAgents" :agents="agents" :ticket="ticket" :errors="errors"/>
                                    </template>

                                    <template #column_value_severity="ticket">
                                        {{ ticket.severity.name }}
                                        <TicketUpdateSelectColumn @updateColumn="updateColumn" :collection="severities" :ticket="ticket" :errors="errors" column="Severity" column_key="severity_id"/>
                                    </template>

                                    <template #column_value_status="ticket">
                                        {{ ticket.status.name }}
                                        <TicketUpdateSelectColumn @updateColumn="updateColumn" :collection="statuses" :ticket="ticket" :errors="errors" column="Status" column_key="status_id"/>
                                    </template>
                                    
                                    <template #column_value_solved="ticket">
                                        <span v-if="ticket.solved == 'yes'" class="badge badge-success">Solved</span>
                                        <span v-else class="badge badge-info">In Progress</span>

                                        <button v-if="ticket.solved == 'yes' && !ticket.survey" @click="sendSurvey" class="btn btn-link">Send Servey</button>
                                        <TicketUpdateSelectColumn @updateColumn="updateColumn" :collection="solved" :ticket="ticket" :errors="errors" column="Solved" column_key="solved"/>
                                    </template>
                                    
                                    <template #column_value_survey="ticket">
                                        <div v-if="ticket.survey">
                                            <span class="badge" :class="{'bg-success': ticket.survey.resolved == 'yes', 'bg-danger': ticket.survey.resolved == 'no'}">{{ ticket.survey.resolved }}</span>
                                            <p><span class="user_survey_comment">User Says </span>{{ ticket.survey.comment }}</p>
                                        </div>
                                        <div v-else>
                                            Not Yet
                                        </div>
                                    </template>

                                    <template #column_value_attachments="ticket">
                                        <div v-if="ticket.attachments.length > 0">
                                            <a class="badge badge-primary mx-2" v-for="(url, index) in ticket.attachments" :key="index" :href="url" target="_blank"> File {{ index + 1 }}</a>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-secondary">No Attachments</span>
                                        </div>
                                    </template>
                                    
                                    <template #actions="ticket">
                                        <Link v-if="!ticket.isEscalated" :href="$route('escalations.create', {ticket_id: ticket.id})" class="btn btn-info">
                                            Escalate
                                        </Link>
                                    </template>
                                    
                                </EntityShow>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <TicketReplies :ticket="ticket" :errors="errors"/>
                            </div>
                        </div>
                    </div>
                
                </div>

                <div class="col-md-3">
                    <TicketNotes :ticket="ticket" :errors="errors"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import EntityShow from '@/Components/EntityShow.vue'
import TicketUpdateCategory from '@/Components/TicketUpdateCategory.vue'
import TicketUpdateSelectColumn from '@/Components/TicketUpdateSelectColumn.vue'
import TicketReplies from '@/Components/TicketReplies.vue'
import TicketNotes from '@/Components/TicketNotes.vue'
import TicketUpdateAgents from '@/Components/TicketUpdateAgents.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        EntityShow,
        TicketUpdateCategory,
        TicketUpdateSelectColumn,
        TicketReplies,
        TicketNotes,
        TicketUpdateAgents,
    },
    props:{
        ticket:Object,
        categories:Object,
        severities:Object,
        statuses:Object,
        agents:Object,
        errors:Object,
    },
    data(){
        return {
            solved:[
                {
                    id: 'yes',
                    name: 'Yes'
                },
                {
                    id: 'no',
                    name: 'No'
                }
            ]
        }
    },
    computed:{
        settings(){
            return {
                entity: this.ticket,
                lang: {
                    entity: 'Ticket',
                    title: 'subject',
                },
                routes:{
                    bind: 'ticket',
                    edit: 'tickets.edit',
                    destroy: 'tickets.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Subject',
                        key:'subject'
                    },
                    { 
                        label:'Body',
                        key:'body'
                    },
                    { 
                        label:'Category',
                        key:'category'
                    },
                    { 
                        label:'User',
                        key:'user'
                    },
                    { 
                        label:'Escalation',
                        key:'escalation'
                    },
                    { 
                        label:'Severity',
                        key:'severity'
                    },
                    { 
                        label:'Agents',
                        key:'agents'
                    },
                    { 
                        label:'Status',
                        key:'status'
                    },
                    { 
                        label:'Solved',
                        key:'solved'
                    },
                    { 
                        label:'Survey',
                        key:'survey'
                    },{ 
                        label:'Attachments',
                        key:'attachments'
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
    methods:{
        sendSurvey(){
            this.$inertia.post(route('tickets.send_survey', this.ticket.id),{
                preserveScroll: true,
            });
        },
        updateCategory(category_id){
            this.$inertia.put(route('tickets.update_category', this.ticket.id), {category_id})
        },
        updateAgents(agents){
            this.$inertia.put(route('tickets.update_agents', this.ticket.id), {agents})
        },
        updateColumn({column_id, column_key, column}){
            this.$inertia.put(route('tickets.update_column', {ticket: this.ticket.id, column: column}), {[column_key]: column_id})
        },
    }
}
</script>

<style>
.user_survey_comment{
    color: #bfbfbf;
    display: block;
    text-transform: uppercase;
}
</style>