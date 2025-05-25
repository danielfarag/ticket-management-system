<template>
    <Datatable :settings="settings">
        <template #column_status="faq">
            <span v-if="faq.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_question="faq">
            {{ faq.question.substr(0,50) }}
        </template>

        <template #column_answer="faq">
            {{ faq.answer.substr(0,50) }}
        </template>

        <template #column_created_at="faq">
            {{ moment(faq.created_at) }}
        </template>

        <template #column_updated_at="faq">
            {{ moment(faq.updated_at) }}
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
        faqs:Object
    },
    computed:{
        settings(){
            return {
                collection:this.faqs,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Faqs',
                    create: 'Create Faq',
                    export: 'Export Faqs',
                    import: 'Import Faqs',
                },
                routes:{
                    bind: 'faq',
                    index: 'faqs.index',
                    create: 'faqs.create',
                    show: 'faqs.show',
                    edit: 'faqs.edit',
                    destroy: 'faqs.destroy',
                    import: 'faqs'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Question',
                        key: 'question',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Answer',
                        key: 'answer',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Department',
                        key: 'department_name',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Article',
                        key: 'article_title',
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