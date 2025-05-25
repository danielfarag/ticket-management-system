<template>
    <Head :title="'Dashboard - Role - ' + role.name" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings" />

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Permissions</h3>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Permissions</label>
                    <div class="row">
                        <div class="col-3 mb-4" v-for="(per,index) in permissions" :key="index">
                            <h3 class="permission_name">{{ per.name }}</h3>
                            <div class="form-group" v-for="(value, name) in per.permissions" :key="name">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" disabled class="custom-control-input" v-model="form.permissions[name]">
                                    <label class="custom-control-label">{{ value }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        role:Object,
        permissions:Object,
    },
    data(){
        return {
            form:{
                permissions:{}
            },
        }
    },

    mounted(){
        this.role.permissions.map(permission=>this.form.permissions[permission.name] = true)
    },
    computed:{
        settings(){
            return {
                entity: this.role,
                lang: {
                    entity: 'Role',
                    title: 'name',
                },
                routes:{
                    bind: 'role',
                    edit: 'roles.edit',
                    destroy: 'roles.destroy',
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
