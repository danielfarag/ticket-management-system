<template>
    <Head :title="'Dashboard - Status - ' + status.name" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_color="status">
                <ColorSquare :color="status.color"/>
            </template>
        </EntityShow>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import EntityShow from '@/Components/EntityShow.vue'
import ColorSquare from '@/Components/ColorSquare.vue'

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        EntityShow,
        ColorSquare,
    },
    props:{
        status:Object
    },
    computed:{
        settings(){
            return {
                entity: this.status,
                lang: {
                    entity: 'Status',
                    title: 'name',
                },
                routes:{
                    bind: 'status',
                    edit: 'statuses.edit',
                    destroy: 'statuses.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Name',
                        key:'name'
                    },
                    { 
                        label:'Priority',
                        key:'priority'
                    },
                    { 
                        label:'Color',
                        key:'color'
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
