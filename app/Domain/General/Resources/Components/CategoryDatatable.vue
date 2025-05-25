<template>
    <Datatable :settings="settings">
        <template #column_status="category">
            <span v-if="category.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_created_at="category">
            {{ moment(category.created_at) }}
        </template>

        <template #column_updated_at="category">
            {{ moment(category.updated_at) }}
        </template>

        <template #column_name="category">
            <font-awesome-icon :icon="category.icon"/> <span>{{ category.name }}</span>
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
        categories:Object
    },
    computed:{
        request(){
            return this.$page.props.request; 
        },
        settings(){
            return {
                collection:this.categories,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Categories',
                    create: 'Create Category',
                    export: 'Export Categories',
                    import: 'Import Categories',
                },
                routes:{
                    bind: 'category',
                    index: {
                        route:'categories.index',
                        args:{ type: this.request.type }
                    },
                    create: {
                        route:'categories.create',
                        args:{ type: this.request.type }
                    },
                    show: {
                        route:'categories.show',
                        args:{ type: this.request.type }
                    },
                    edit: {
                        route:'categories.edit',
                        args:{ type: this.request.type }
                    },
                    destroy: {
                        route:'categories.destroy',
                        args:{ type: this.request.type }
                    },
                    import: { type: 'categories', entity:this.request.type }
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