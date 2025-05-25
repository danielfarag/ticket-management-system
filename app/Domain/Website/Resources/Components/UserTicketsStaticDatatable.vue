<template>
    <StaticDatatable :settings="settings">

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

    </StaticDatatable>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import StaticDatatable from '@/Components/StaticDatatable.vue'

export default {
    components:{
        Pagination,
        StaticDatatable
    },
    props:{
        tickets:Object,
    },
    computed:{
        settings(){
            return {
                collection:this.tickets,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'Latest Tickets',
                    create: 'Create Ticket',
                },
                routes:{
                    bind: 'ticket',
                    index: 'website.tickets.index',
                    create: 'website.tickets.create',
                    show: 'website.tickets.show',
                    edit: 'website.tickets.edit',
                    destroy: 'website.tickets.destroy',
                    import: false,
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                    },
                    {
                        name: 'User',
                        key: 'user_name',
                    },
                    {
                        name: 'Category',
                        key: 'category_name',
                    },
                    {
                        name: 'Severity',
                        key: 'severity_name',
                    },
                    {
                        name: 'Status',
                        key: 'status_name',
                    },
                    {
                        name: 'Agent',
                        key: 'agent_name',
                    },
                    {
                        name: 'Solved',
                        key: 'solved',
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