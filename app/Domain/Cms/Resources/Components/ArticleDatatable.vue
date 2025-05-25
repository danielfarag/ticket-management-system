<template>
    <Datatable :settings="settings">
        <template #column_status="article">
            <span v-if="article.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_created_at="article">
            {{ moment(article.created_at) }}
        </template>

        <template #column_updated_at="article">
            {{ moment(article.updated_at) }}
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
        articles:Object
    },
    computed:{
        settings(){
            return {
                collection:this.articles,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Articles',
                    create: 'Create Article',
                    export: 'Export Articles',
                    import: 'Import Articles',
                },
                routes:{
                    bind: 'article',
                    index: 'articles.index',
                    create: 'articles.create',
                    show: 'articles.show',
                    edit: 'articles.edit',
                    destroy: 'articles.destroy',
                    import: 'articles'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                        width:"10"
                    },
                    {
                        name: 'title',
                        key: 'title',
                        searchable: true,
                        sortable: true,
                        width:"20"
                    },
                    {
                        name: 'Author',
                        key: 'author_name',
                        searchable: true,
                        sortable: true,
                        width:"10"
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
                        width:"10"
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