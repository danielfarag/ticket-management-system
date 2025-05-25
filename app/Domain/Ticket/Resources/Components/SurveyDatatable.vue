<template>
    <Datatable :settings="settings">

        <template #column_resolved="survey">
            <span v-if="survey.resolved == 'yes'" class="badge badge-success">Yes</span>
            <span v-else class="badge badge-danger">No</span>
        </template>


        <template #column_created_at="survey">
            {{ moment(survey.created_at) }}
        </template>

        <template #column_updated_at="survey">
            {{ moment(survey.updated_at) }}
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
        surveys:Object
    },
    computed:{
        settings(){
            return {
                collection:this.surveys,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Surveys',
                    create: 'Create Survey',
                    export: 'Export Surveys',
                    import: 'Import Surveys',
                },
                routes:{
                    bind: 'survey',
                    index: 'surveys.index',
                    create: false,
                    show: 'surveys.show',
                    edit: false,
                    destroy: 'surveys.destroy',
                    import: 'surveys'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
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
                        name: 'Resolved',
                        key: 'resolved',
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