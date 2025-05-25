<template>
    <Datatable :settings="settings">

        <template #column_status="status">
            <span v-if="status.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_color="status">
            <ColorSquare :color="status.color"/>
        </template>

        <template #column_created_at="status">
            {{ moment(status.created_at) }}
        </template>

        <template #column_updated_at="status">
            {{ moment(status.updated_at) }}
        </template>

    </Datatable>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import ColorSquare from '@/Components/ColorSquare.vue'
import Datatable from '@/Components/Datatable.vue'

export default {
    components:{
        Pagination,
        ColorSquare,
        Datatable,
    },
    props:{
        statuses:Object
    },
    computed:{
        settings(){
            return {
                collection:this.statuses,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Statuses',
                    create: 'Create Status',
                    export: 'Export Statuses',
                    import: 'Import Statuses',
                },
                routes:{
                    bind: 'status',
                    index: 'statuses.index',
                    create: 'statuses.create',
                    show: 'statuses.show',
                    edit: 'statuses.edit',
                    destroy: 'statuses.destroy',
                    import: 'statuses'
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
