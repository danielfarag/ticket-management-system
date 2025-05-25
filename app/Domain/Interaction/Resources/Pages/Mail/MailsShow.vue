<template>
    <Head :title="'Dashboard - Mail - ' + mail.subject" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_send_at="mail">
                {{ moment(mail.send_at) }}
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
        mail:Object
    },
    computed:{
        settings(){
            return {
                entity: this.mail,
                lang: {
                    entity: 'Mail',
                    title: 'subject',
                },
                routes:{
                    bind: 'mail',
                    edit: 'mails.edit',
                    destroy: 'mails.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Email',
                        key:'email'
                    },
                    { 
                        label:'Subject',
                        key:'subject'
                    },
                    { 
                        label:'Body',
                        key:'body'
                    },
                    { 
                        label:'Status',
                        key:'status'
                    },
                    { 
                        label:'Send At',
                        key:'send_at'
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
