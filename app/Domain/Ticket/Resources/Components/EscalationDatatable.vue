<template>
    <Datatable :settings="settings">

        <template #column_status="escalation">
            <span v-if="escalation.status == 'solved'" class="badge badge-success">Solved</span>
            <span v-else-if="escalation.status == 'in_progress'" class="badge badge-secondary">In Progress</span>
            <span v-else class="badge badge-warning">pending</span>
        </template>

        <template #column_created_at="escalation">
            {{ moment(escalation.created_at) }}
        </template>

        <template #column_updated_at="escalation">
            {{ moment(escalation.updated_at) }}
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
        escalations:Object
    },
    computed:{
        settings(){
            return {
                collection:this.escalations,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Escalations',
                    create: 'Create Escalation',
                    export: 'Export Escalations',
                    import: 'Import Escalations',
                },
                routes:{
                    bind: 'escalation',
                    index: 'escalations.index',
                    create: 'escalations.create',
                    show: 'escalations.show',
                    edit: 'escalations.edit',
                    destroy: 'escalations.destroy',
                    import: 'escalations'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Creator',
                        key: 'creator_name',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Ticket',
                        key: 'ticket_subject',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Status',
                        key: 'status',
                        searchable: {
                            type:'select',
                            options:[
                                {
                                    id:'pending',
                                    text:'Pending'
                                },{
                                    id:'in_progress',
                                    text:'In Progress',
                                },{
                                    id:'solved',
                                    text:'Solved',
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