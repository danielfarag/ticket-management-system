<template>
    <Datatable :settings="settings">

        <template #column_icon="service">
            <font-awesome-icon :icon="service.icon"/>
        </template>

        <template #column_status="service">
            <span v-if="service.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_created_at="service">
            {{ moment(service.created_at) }}
        </template>

        <template #column_updated_at="service">
            {{ moment(service.updated_at) }}
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
        services:Object
    },
    computed:{
        settings(){
            return {
                collection:this.services,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Services',
                    create: 'Create Service',
                    export: 'Export Services',
                    import: 'Import Services',
                },
                routes:{
                    bind: 'service',
                    index: 'services.index',
                    create: 'services.create',
                    show: 'services.show',
                    edit: 'services.edit',
                    destroy: 'services.destroy',
                    import: 'services'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Icon',
                        key: 'icon',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Title',
                        key: 'title',
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