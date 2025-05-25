<template>
    <Datatable :settings="settings">
        <template #column_type="user">
            <span v-if="user.type == 'user'" class="badge badge-success">{{ user.type }}</span>
            <span v-else-if="user.type =='agent'" class="badge badge-info">{{ user.type }}</span>
            <span v-else class="badge badge-danger">{{ user.type }}</span>
        </template>

        <template #column_status="user">
            <span v-if="user.status == 'active'" class="badge badge-success">Active</span>
            <span v-else class="badge badge-danger">Inactive</span>
        </template>

        <template #column_roles="user">
            <span class="badge badge-primary mr-2" v-for="(role,index) in user.roles?.split(',')" :key="index">{{ role }}</span>
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
        users: Object,
        roles: Array,
    },
    computed:{
        settings(){
            return {
                collection:this.users,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Users',
                    create: 'Create User',
                    export: 'Export Users',
                    import: 'Import Users',
                },
                routes:{
                    bind: 'user',
                    index: 'users.index',
                    create: 'users.create',
                    show: 'users.show',
                    edit: 'users.edit',
                    destroy: 'users.destroy',
                    import: 'users'
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
                        name: 'Type',
                        key: 'type',
                        searchable: {
                            type:'select',
                            options:[
                                {
                                    id:'admin',
                                    text:'Admin'
                                },{
                                    id:'agent',
                                    text:'Agent'
                                },{
                                    id:'user',
                                    text:'User'
                                }
                            ]
                        },
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
                        name: 'Roles',
                        key: 'roles',
                        searchable: {
                            type:'select',
                            options: this.roles,
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