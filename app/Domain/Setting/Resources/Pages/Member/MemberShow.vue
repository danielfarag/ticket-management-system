<template>
    <Head :title="'Dashboard - Member - ' + member.name" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_image="slider">
                <img width="150" :src="slider.image"/>
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
        member:Object,
    },
    computed:{
        settings(){
            return {
                entity: this.member,
                lang: {
                    entity: 'Member',
                    title: 'name',
                },
                routes:{
                    bind: 'member',
                    edit: 'members.edit',
                    destroy: 'members.destroy',
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
                        label:'Title',
                        key:'title'
                    },
                    { 
                        label:'Description',
                        key:'description'
                    },
                    { 
                        label:'Image',
                        key:'image'
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
