<template>
    <Datatable :settings="settings">

        <template #column_agent_name="ticket">
            <span v-if="ticket.agent_name" class="badge bg-primary"> {{ ticket.agent_name }} </span>
            <span v-else class="badge bg-danger"> NO AGENT ! </span>
        </template>

        <template #column_solved="ticket">
            <span v-if="ticket.solved == 'yes'" class="badge bg-success"> YES </span>
            <span v-else class="badge bg-warning"> NO </span>
        </template>

        <template #column_created_at="ticket">
            {{ moment(ticket.created_at) }}
        </template>

        <template #column_updated_at="ticket">
            {{ moment(ticket.updated_at) }}
        </template>

    </Datatable>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import Datatable from '@/Components/Datatable.vue'

export default {
    components:{
        Pagination,
        Datatable
    },
    props:{
        tickets:Object,
        statuses: Array,
        severities: Array,
        categories: Array,
    },
    computed:{
        _settings(){
            return this.$page.props.settings;
        },
        settings(){
            return {
                collection:this.tickets,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Tickets',
                    create: 'Create Ticket',
                },
                routes:{
                    bind: 'ticket',
                    index: 'website.tickets.index',
                    create: 'website.tickets.create',
                    show: 'website.tickets.show',
                    edit: 'website.tickets.edit',
                    destroy: this._settings.user_can_delete_ticket != false ? 'website.tickets.destroy' : false,
                    import: false,
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'User',
                        key: 'user_name',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Category',
                        key: 'category_name',
                        searchable: {
                            type:'select',
                            options:this.categories,
                        },
                        sortable: true,
                    },
                    {
                        name: 'Severity',
                        key: 'severity_name',
                        searchable: {
                            type:'select',
                            options:this.severities,
                        },
                        sortable: true,
                    },
                    {
                        name: 'Status',
                        key: 'status_name',
                        searchable: {
                            type:'select',
                            options:this.statuses,
                        },
                        sortable: true,
                    },
                    {
                        name: 'Agent',
                        key: 'agent_name',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Solved',
                        key: 'solved',
                        searchable: {
                            type:'select',
                            options:[
                                {
                                    id:'yes',
                                    text:'Yes'
                                },{
                                    id:'no',
                                    text:'No',
                                }
                            ]
                        },
                        sortable: true,
                    },
                ]
            }
        }
    },
}
</script>

<style scoped>
    .color{
        display: inline-block;
        height: 30px;
        width: 110px;
    }
</style>