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
        announcements:Object
    },
    computed:{
        settings(){
            return {
                collection:this.announcements,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Announcements',
                    create: 'Create Announcement',
                    export: 'Export Announcements',
                    import: 'Import Announcements',
                },
                routes:{
                    bind: 'announcement',
                    index: 'announcements.index',
                    create: 'announcements.create',
                    show: 'announcements.show',
                    edit: 'announcements.edit',
                    destroy: 'announcements.destroy',
                    import: 'announcements'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'In',
                        key: 'in',
                        searchable: {
                            type:'select',
                            options:[
                                {
                                    id:'Dashboard',
                                    text:'dashboard'
                                },{
                                    id:'Website',
                                    text:'website',
                                }
                            ]
                        },                       
                        sortable: true,
                    },
                    {
                        name: 'Content',
                        key: 'content',
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