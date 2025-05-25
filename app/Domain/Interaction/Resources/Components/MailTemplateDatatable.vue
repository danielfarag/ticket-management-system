<template>
    <Datatable :settings="settings">

        <template #column_default="user">
            <span v-if="user.default" class="badge badge-success">Default</span>
            <span v-else class="badge badge-danger">Not Default</span>
        </template>

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
        mailTemplates:Object
    },
    computed:{
        settings(){
            return {
                collection:this.mailTemplates,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Mail Templates',
                    create: 'Create Mail Template',
                    export: 'Export Mail Templates',
                    import: 'Import Mail Templates',
                },
                routes:{
                    bind: 'mail_template',
                    index: 'mail_templates.index',
                    create: 'mail_templates.create',
                    show: 'mail_templates.show',
                    edit: 'mail_templates.edit',
                    destroy: 'mail_templates.destroy',
                    import: 'mail_templates'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Type',
                        key: 'type',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Subject',
                        key: 'subject',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Default',
                        key: 'default',
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