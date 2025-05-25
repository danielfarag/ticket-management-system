<template>
    <Head :title="'Dashboard - Block Ip - ' + blockIp.ip_address" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_blocker="blockIp">
                {{ blockIp.blocker.name }}
            </template>
        </EntityShow>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import EntityShow from '@/Components/EntityShow.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        EntityShow,
    },
    props:{
        blockIp:Object
    },
    computed:{
        settings(){
            return {
                entity: this.blockIp,
                lang: {
                    entity: 'Block IP',
                    title: 'ip_address',
                },
                routes:{
                    bind: 'block_ip',
                    edit: 'block_ips.edit',
                    destroy: 'block_ips.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'IP Address',
                        key:'ip_address'
                    },
                    { 
                        label:'Blocker',
                        key:'blocker'
                    },
                    { 
                        label:'Reason',
                        key:'reason'
                    },
                    { 
                        label:'Created At',
                        key:'created_at'
                    },
                    { 
                        label:'Updated At',
                        key:'updated_at'
                    },
                ]
            }
        }
    },
}
</script>
