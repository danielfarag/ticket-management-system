<template>
    <Head :title="'Dashboard - Department - ' + department.name" />

    <AuthenticatedLayout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <EntityShow :settings="settings">
                    <template #column_value_image="department">
                        <img :src="department.image" />
                    </template>
                    <template #column_value_categories="department">
                        <span class="badge badge-primary mx-2" v-for="(category,i) in department.categories" :key="i">{{ category.name }}</span>
                    </template>
                </EntityShow>
            </div>
            
            <div class="col-md-8">
                <div class="card card-primary">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="card-title">Agents</h3>
                            </div>
                            <div class="col-md-2 float-right">
                                <AgentModal @assignAgents="assignAgents" :agents="agents" :errors="errors"/>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <AgentDepartmentTable @deassignAgent="deassignAgent" :agents="department.agents"/>
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
import AgentModal from '@/Components/AgentModal.vue'
import AgentDepartmentTable from '@/Components/AgentDepartmentTable.vue'
import EntityShow from '@/Components/EntityShow.vue'


export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        AgentModal,
        AgentDepartmentTable,
        EntityShow,
    },
    props:{
        department:Object,
        agents:Array,
        errors:Object,
    },
    computed:{
        settings(){
            return {
                entity: this.department,
                lang: {
                    entity: 'Department',
                    title: 'name',
                },
                routes:{
                    bind: 'department',
                    edit: 'departments.edit',
                    destroy: 'departments.destroy',
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
                        label:'Description',
                        key:'description'
                    },
                    { 
                        label:'Image',
                        key:'image'
                    },
                    { 
                        label:'Categories',
                        key:'categories'
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

    methods:{
        assignAgents(agents){
            this.$inertia.post(route('departments.assign_agents', this.department.id), {agents})
        },
        deassignAgent(agents){
            this.$inertia.post(route('departments.deassign_agents', this.department.id), {agents})
        }
    }
}
</script>


<style scoped>
img{
    width:150px
}
</style>