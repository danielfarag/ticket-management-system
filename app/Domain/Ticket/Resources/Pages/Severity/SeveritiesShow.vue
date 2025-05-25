<template>
    <Head :title="'Dashboard - Severity - ' + severity.name" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_color="severity">
                <ColorSquare :color="severity.color"/>
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
        severity:Object
    },
    computed:{
        settings(){
            return {
                entity: this.severity,
                lang: {
                    entity: 'Severity',
                    title: 'name',
                },
                routes:{
                    bind: 'severity',
                    edit: 'severities.edit',
                    destroy: 'severities.destroy',
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
