<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Todos</h3>
        </div>
        <div class="card-body">
            <PieChart :chartData="_todos"/>
        </div>
    </div>
</template>

<script>
import PieChart from '@/Components/PieChart.vue'

export default {
    components:{
        PieChart,
    },
    props:{
        todos:Object
    },
    computed:{
        _todos(){
            return {
                labels: ['Done', 'Idle', 'Todo', 'In Progress', 'Urget'],
                datasets: [
                    {
                        label: 'Todo Todos',
                        data: [
                            this.todos.done,
                            this.todos.idle,
                            this.todos.todo,
                            this.todos.in_progress,
                            this.todos.urget,
                        ],
                        backgroundColor: [
                            '#267b26',
                            '#ea4b4b',
                            '#b54878',
                            '#a5a874',
                            '#0d6598',
                        ]
                    },
                ]
            }
        }
    }
}
</script>