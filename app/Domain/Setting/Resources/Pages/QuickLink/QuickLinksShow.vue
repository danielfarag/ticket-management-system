<template>
    <Head :title="'Dashboard - Quick Link - ' + quickLink.title" />

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
        quickLink:Object
    }, 
    computed:{
        settings(){
            return {
                entity: this.quickLink,
                lang: {
                    entity: 'Quick Link',
                    title: 'title',
                },
                routes:{
                    bind: 'quick_link',
                    edit: 'quick_links.edit',
                    destroy: 'quick_links.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Title',
                        key:'title'
                    },
                    { 
                        label:'URL',
                        key:'url'
                    },
                    { 
                        label:'Priority',
                        key:'priority'
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
