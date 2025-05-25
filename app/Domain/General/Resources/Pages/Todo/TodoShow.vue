<template>
    <Head :title="'Dashboard - Todo - ' + todo.subject" />

    <AuthenticatedLayout>
        <EntityShow :settings="settings">
            <template #column_value_status="todo">
                <span :class="['badge', todoStatusClass(todo)]">{{ todo.status }}</span>
            </template>

            <template #column_value_priority="todo">
                <span :class="['badge', todoPriorityClass(todo)]">{{ todo.priority }}</span>
            </template>

            <template #column_value_agent="todo">
                {{ todo.agent.name }}
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
        todo:Object,
    },
    methods:{
        todoStatusClass(todo){
            switch (todo.status) {
                case 'done':
                    return 'badge-success';
                case 'idle':
                    return 'badge-info';
                case 'todo':
                    return 'badge-secondary';
                case 'in_progress':
                    return 'badge-warning';
                default:
                    return 'badge-danger';
            }
        },
        todoPriorityClass(todo){
            switch (todo.priority) {
                case 'high':
                    return 'badge-danger';
                case 'medium':
                    return 'badge-warning';
                case 'low':
                    return 'badge-primary';
            }
        }
    },
    computed:{
        settings(){
            return {
                entity: this.todo,
                lang: {
                    entity: 'Todo',
                    title: 'subject',
                },
                routes:{
                    bind: 'todo',
                    edit: 'todos.edit',
                    destroy: 'todos.destroy',
                },
                columns:[
                    { 
                        label:'ID',
                        key:'id'
                    },
                    { 
                        label:'Subject',
                        key:'subject'
                    },
                    { 
                        label:'Body',
                        key:'body'
                    },
                    { 
                        label:'Priority',
                        key:'priority'
                    },
                    { 
                        label:'Status',
                        key:'status'
                    },
                    { 
                        label:'Due Date',
                        key:'due_at'
                    },
                    { 
                        label:'Agent',
                        key:'agent'
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
    }
}
</script>
