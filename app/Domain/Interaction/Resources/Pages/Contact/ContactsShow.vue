<template>
    <Head :title="'Dashboard - Contact - ' + contact.name" />

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
        contact:Object
    },
    computed:{
        settings(){
            return {
                entity: this.contact,
                lang: {
                    entity: 'Contact',
                    title: 'email',
                },
                routes:{
                    bind: 'contact',
                    edit: 'contacts.edit',
                    destroy: 'contacts.destroy',
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
                        label:'Email',
                        key:'email'
                    },
                    { 
                        label:'Phone Number',
                        key:'phone_number'
                    },
                    { 
                        label:'Message',
                        key:'message'
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
