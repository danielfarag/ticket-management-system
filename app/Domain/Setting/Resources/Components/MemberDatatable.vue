<template>
    <Datatable :settings="settings">
        <template #column_description="member">
            <p>{{ member.description.substr(0,20) }}</p>
        </template>

        <template #column_created_at="member">
            {{ moment(member.created_at) }}
        </template>

        <template #column_updated_at="member">
            {{ moment(member.updated_at) }}
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
        members: Object,
    },
    computed:{
        settings(){
            return {
                collection:this.members,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Members',
                    create: 'Create Member',
                    export: 'Export Members',
                    import: 'Import Members',
                },
                routes:{
                    bind: 'member',
                    index: 'members.index',
                    create: 'members.create',
                    show: 'members.show',
                    edit: 'members.edit',
                    destroy: 'members.destroy',
                    import: 'members'
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
                        name: 'Title',
                        key: 'title',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Description',
                        key: 'description',
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