<template>
    <Head title="Dashboard - Announcement" />

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
        EntityShow
    },
    props:{
        announcement:Object
    }, 
    computed:{
        settings(){
            return {
                entity: this.announcement,
                lang: {
                    entity: 'Announcement',
                },
                routes:{
                    bind: 'announcement',
                    edit: 'announcements.edit',
                    destroy: 'announcements.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'In',
                        key:'in'
                    },
                    { 
                        label:'Content',
                        key:'content'
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
