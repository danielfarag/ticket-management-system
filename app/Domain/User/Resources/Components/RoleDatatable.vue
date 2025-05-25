<template>
    <Datatable :settings="settings">
        <template #column_created_at="role">
            {{ moment(role.created_at) }}
        </template>

        <template #column_updated_at="role">
            {{ moment(role.updated_at) }}
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
        roles:Object
    },
    computed:{
        settings(){
            return {
                collection:this.roles,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Roles',
                    create: 'Create Role',
                    export: 'Export Roles',
                    import: 'Import Roles',
                },
                routes:{
                    bind: 'role',
                    index: 'roles.index',
                    create: 'roles.create',
                    show: 'roles.show',
                    edit: 'roles.edit',
                    destroy: 'roles.destroy',
                    import: 'roles'
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