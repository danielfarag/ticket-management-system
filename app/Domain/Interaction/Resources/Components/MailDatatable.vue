<template>
    <Datatable :settings="settings">
        <template #column_status="mail">
            <span v-if="mail.status == 'pending'" class="badge badge-info">Pending</span>
            <span v-else-if="mail.status == 'cancelled'" class="badge badge-danger">Cancelled</span>
            <span v-else class="badge badge-success">Sent</span>
        </template>

        <template #column_email="mail">
            <span v-for="(email,index) in mail.email.split(',')" :key="index" class="badge badge-primary m-1">{{ email }}</span>
        </template>

        <template #column_send_at="mail">
            {{ moment(mail.send_at) }}
        </template>

        <template #column_created_at="mail">
            {{ moment(mail.created_at) }}
        </template>

        <template #column_updated_at="mail">
            {{ moment(mail.updated_at) }}
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
        mails:Object
    },
    computed:{
        settings(){
            return {
                collection:this.mails,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Mails',
                    create: 'Create Mail',
                    export: 'Export Mails',
                    import: 'Import Mails',
                },
                routes:{
                    bind: 'mail',
                    index: 'mails.index',
                    create: 'mails.create',
                    show: 'mails.show',
                    edit: 'mails.edit',
                    destroy: 'mails.destroy',
                    import: 'mails'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
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
                        name: 'Subject',
                        key: 'subject',
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
                                    id:'pending',
                                    text:'Pending'
                                },{
                                    id:'sent',
                                    text:'Sent',
                                },{
                                    id:'cancelled',
                                    text:'Cancelled',
                                }
                            ]
                        },
                        sortable: true,
                    },
                    {
                        name: 'Send At',
                        key: 'send_at',
                        searchable: {
                            type: "date-range"
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