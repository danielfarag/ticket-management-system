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
        blockIps:Object
    },
    computed:{
        settings(){
            return {
                collection:this.blockIps,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Block Ips',
                    create: 'Create Block Ip',
                    export: 'Export Block Ips',
                    import: 'Import Block Ips',
                },
                routes:{
                    bind: 'block_ip',
                    index: 'block_ips.index',
                    create: 'block_ips.create',
                    show: 'block_ips.show',
                    edit: 'block_ips.edit',
                    destroy: 'block_ips.destroy',
                    import: 'block_ips'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Blocker',
                        key: 'blocker_name',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'IP Address',
                        key: 'ip_address',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Reason',
                        key: 'reason',
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