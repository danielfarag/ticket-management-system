<template>
    <Head :title="'Dashboard - Mail Template - ' + mailTemplate.subject" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings" />
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
        mailTemplate:Object
    }, 
    computed:{
        settings(){
            return {
                entity: this.mailTemplate,
                lang: {
                    entity: 'Mail Template',
                    title: 'subject',
                },
                routes:{
                    bind: 'mail_template',
                    edit: 'mail_templates.edit',
                    destroy: 'mail_templates.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Type',
                        key:'type'
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
                        label:'Default',
                        key:'default'
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
