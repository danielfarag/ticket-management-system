<template>
    <Head :title="'Dashboard - Category - ' + category.name" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_icon="category">
                <font-awesome-icon :icon="category.icon"/>
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
        request:Object,
        category:Object
    },  
    computed:{
        settings(){
            return {
                entity: this.category,
                lang: {
                    entity: 'Category',
                    title: 'name',
                },
                routes:{
                    bind: 'category',
                    edit: {
                        route: 'categories.edit',
                        args: {
                            type:this.request.type
                        }
                    },
                    destroy: {
                        route: 'categories.destroy',
                        args: {
                            type:this.request.type
                        }
                    },
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
                        label:'Name',
                        key:'name'
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
