<template>
    <Datatable :settings="settings">
        <template #column_status="todo">
            <span :class="['badge', todoStatusClass(todo)]">{{ todo.status }}</span>
        </template>

        <template #column_priority="todo">
            <span :class="['badge', todoPriorityClass(todo)]">{{ todo.priority }}</span>
        </template>

        <template #column_due_at="todo">
            {{ moment(todo.due_at) }}
        </template>

        <template #column_created_at="todo">
            {{ moment(todo.created_at) }}
        </template>

        <template #column_updated_at="todo">
            {{ moment(todo.updated_at) }}
        </template>

    </Datatable>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import Datatable from '@/Components/Datatable.vue'

export default {
    components:{
        Pagination,
        Datatable
    },
    props:{
        todos: Object,
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
                collection:this.todos,
                hasActions: true,
                hasHeaderActions:true,
                lang: {
                    title: 'List Todos',
                    create: 'Create Todo',
                    export: 'Export Todos',
                    import: 'Import Todos',
                },
                routes:{
                    bind: 'todo',
                    index: 'todos.index',
                    create: 'todos.create',
                    show: 'todos.show',
                    edit: 'todos.edit',
                    destroy: 'todos.destroy',
                    import: 'todos'
                },
                columns:[
                    {
                        name: 'ID',
                        key: 'id',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Subject',
                        key: 'subject',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Priority',
                        key: 'priority',
                        searchable: {
                            type:'select',
                            options:[
                                {
                                    id:'low',
                                    text:'Low'
                                },
                                {
                                    id:'medium',
                                    text:'Medium',
                                },
                                {
                                    id:'high',
                                    text:'High',
                                }
                            ]
                        },
                        sortable: true,
                    },
                    {
                        name: 'Status',
                        key: 'status',
                        searchable: {
                            type:'select',
                            options:[
                                {
                                    id:'done',
                                    text:'Done'
                                },
                                {
                                    id:'idle',
                                    text:'Idle',
                                },
                                {
                                    id:'todo',
                                    text:'Todo'
                                },
                                {
                                    id:'in_progress',
                                    text:'In Progress'
                                },
                                {
                                    id:'urget',
                                    text:'Urget'
                                },
                            ]
                        },
                        sortable: true,
                    },
                    {
                        name: 'Agent Name',
                        key: 'agent_name',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        name: 'Due At',
                        key: 'due_at',
                        searchable: {
                            type: "date-range"
                        },
                        sortable: true,
                    },
                    {
                        name: 'Created At',
                        key: 'created_at',
                        searchable: {
                            type: "date-range"
                        },
                        sortable: true,
                    },
                    {
                        name: 'Updated At',
                        key: 'updated_at',
                        searchable: {
                            type: "date"
                        },
                        sortable: true,
                    }
                ]
            }
        }
    },
}
</script>