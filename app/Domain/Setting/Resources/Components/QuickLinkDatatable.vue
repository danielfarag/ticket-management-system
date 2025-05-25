<template>
    <Datatable :settings="settings">
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
        quickLinks:Object
    },
    computed:{
        settings(){
            return {
                collection:this.quickLinks,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Quick Links',
                    create: 'Create Quick Link',
                    export: 'Export Quick Links',
                    import: 'Import Quick Links',
                },
                routes:{
                    bind: 'quick_link',
                    index: 'quick_links.index',
                    create: 'quick_links.create',
                    show: 'quick_links.show',
                    edit: 'quick_links.edit',
                    destroy: 'quick_links.destroy',
                    import: 'quick_links'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
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
                        name: 'Url',
                        key: 'url',
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