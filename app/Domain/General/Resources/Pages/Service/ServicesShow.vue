<template>
    <Head :title="'Dashboard - Service - ' + service.title" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_icon="service">
                <font-awesome-icon :icon="service.icon"/>
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
        service:Object
    },
    computed:{
        settings(){
            return {
                entity: this.service,
                lang: {
                    entity: 'Service',
                    title: 'title',
                },
                routes:{
                    bind: 'service',
                    edit: 'services.edit',
                    destroy: 'services.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Icon',
                        key:'icon'
                    },
                    { 
                        label:'Title',
                        key:'title'
                    },
                    { 
                        label:'Description',
                        key:'description'
                    },
                    { 
                        label:'Status',
                        key:'status'
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
