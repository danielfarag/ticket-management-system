<template>
    <Datatable :settings="settings">
        <template #column_created_at="user">
            {{ moment(user.created_at) }}
        </template>

        <template #column_updated_at="user">
            {{ moment(user.updated_at) }}
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
        contacts:Object
    },
    computed:{
        settings(){
            return {
                collection:this.contacts,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Contacts',
                    create: 'Create Contact',
                    export: 'Export Contacts',
                    import: 'Import Contacts',
                },
                routes:{
                    bind: 'contact',
                    index: 'contacts.index',
                    create: 'contacts.create',
                    show: 'contacts.show',
                    edit: 'contacts.edit',
                    destroy: 'contacts.destroy',
                    import: 'contacts'
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
                        name: 'Email',
                        key: 'email',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Phone Number',
                        key: 'phone_number',
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