<template>
    <Head :title="'Dashboard - User - ' + user.name" />

    <AuthenticatedLayout>

        <EntityShow :settings="settings">
            <template #column_value_role="user">
                {{ user.role?.name }}
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
        user:Object
    },
    computed:{
        settings(){
            return {
                entity: this.user,
                lang: {
                    entity: 'User',
                    title: 'name',
                },
                routes:{
                    bind: 'user',
                    edit: 'users.edit',
                    destroy: 'users.destroy',
                },
                columns:[
                    {
                        label: 'ID',
                        key: 'id'
                    },
                    {
                        label: 'Name',
                        key: 'name'
                    },
                    {
                        label: 'Email',
                        key: 'email'
                    },
                    {
                        label: 'Phone Number',
                        key: 'phone_number'
                    },
                    {
                        label: 'Status',
                        key: 'status'
                    },
                    {
                        label: 'Type',
                        key: 'type'
                    },
                    {
                        label: 'Role',
                        key: 'role'
                    },
                    {
                        label: 'Created At',
                        key: 'created_at'
                    },
                    {
                        label: 'Updated At',
                        key: 'updated_at'
                    }
                ]
            }
        }
    },
}
</script>
