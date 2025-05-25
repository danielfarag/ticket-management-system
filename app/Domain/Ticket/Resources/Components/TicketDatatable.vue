<template>
    <Datatable :settings="settings">

        <template #column_agent_name="ticket">
            <span v-if="ticket.agent_name" class="badge badge-primary"> {{ ticket.agent_name }} </span>
            <span v-else class="badge badge-danger"> NO AGENT ! </span>
        </template>

        <template #column_solved="ticket">
            <span v-if="ticket.solved == 'yes'" class="badge badge-success"> YES </span>
            <span v-else class="badge badge-warning"> NO </span>
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
        settings(){
            return {
                collection:this.tickets,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Tickets',
                    create: 'Create Ticket',
                    export: 'Export Tickets',
                    import: 'Import Tickets',
                },
                routes:{
                    bind: 'ticket',
                    index: 'tickets.index',
                    create: 'tickets.create',
                    show: 'tickets.show',
                    edit: 'tickets.edit',
                    destroy: 'tickets.destroy',
                    import: 'tickets'
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
                    {
                        name: 'Created At',
                        key: 'created_at',
                        searchable: {
                            type: "date-range"
                        },
                        sortable: true,
                    },
                    {
                        name: 'Updated At',
                        key: 'updated_at',
                        searchable: {
                            type: "date"
                        },
                        sortable: true,
                    }
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