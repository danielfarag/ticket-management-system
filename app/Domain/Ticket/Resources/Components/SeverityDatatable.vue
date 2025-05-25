<template>
    <Datatable :settings="settings">

        <template #column_status="severity">
            <span v-if="severity.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_color="severity">
            <ColorSquare :color="severity.color"/>
        </template>

        <template #column_created_at="severity">
            {{ moment(severity.created_at) }}
        </template>

        <template #column_updated_at="severity">
            {{ moment(severity.updated_at) }}
        </template>

    </Datatable>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import Datatable from '@/Components/Datatable.vue'
import ColorSquare from '@/Components/ColorSquare.vue'

export default {
    components:{
        Pagination,
        Datatable,
        ColorSquare,
    },
    props:{
        severities:Object
    },
    computed:{
        settings(){
            return {
                collection:this.severities,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Severities',
                    create: 'Create Severity',
                    export: 'Export Severities',
                    import: 'Import Severities',
                },
                routes:{
                    bind: 'severity',
                    index: 'severities.index',
                    create: 'severities.create',
                    show: 'severities.show',
                    edit: 'severities.edit',
                    destroy: 'severities.destroy',
                    import: 'severities'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Name',
                        key: 'name',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Priority',
                        key: 'priority',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Color',
                        key: 'color',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        name: 'Status',
                        key: 'status',
                        searchable: {
                            type:'select',
                            options:[
                                {
                                    id:'active',
                                    text:'Active'
                                },{
                                    id:'inactive',
                                    text:'Inactive',
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