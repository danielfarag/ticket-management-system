<template>
    <Datatable :settings="settings">

        <template #column_status="department">
            <span v-if="department.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_created_at="department">
            {{ moment(department.created_at) }}
        </template>

        <template #column_categories="department">
            <span class="badge badge-primary mr-2" v-for="(category,index) in department.categories?.split(',')" :key="index">{{ category }}</span>
        </template>

        <template #column_updated_at="department">
            {{ moment(department.updated_at) }}
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
        departments:Object,
        categories: Array,
    },
    computed:{
        settings(){
            return {
                collection:this.departments,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Departments',
                    create: 'Create Department',
                    export: 'Export Departments',
                    import: 'Import Departments',
                },
                routes:{
                    bind: 'department',
                    index: 'departments.index',
                    create: 'departments.create',
                    show: 'departments.show',
                    edit: 'departments.edit',
                    destroy: 'departments.destroy',
                    import: 'departments'
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
                        name: 'Categories',
                        key: 'categories',
                        searchable: {
                            type:'select',
                            options: this.categories,
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

<style scoped>
    .color{
        display: inline-block;
        height: 30px;
        width: 110px;
    }
</style>