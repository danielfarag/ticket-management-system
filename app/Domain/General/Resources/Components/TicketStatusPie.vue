<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tickets</h3>
        </div>
        <div class="card-body">
            <PieChart :chartData="_statuses"/>
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
        statuses:Object
    },
    data(){
        return {
            colors:[
                '#f1f5f4',
                '#f154d6',
                '#b2654f',
                '#a23456',
                '#f23456',
                '#e2aa12',
                '#da1245',
                '#aea941',
            ]
        };
    },
    computed:{
        _statuses(){
            return {
                labels: Object.keys(this.statuses),
                datasets: [
                    {
                        label: 'Ticket Statuses',
                        data: Object.values(this.statuses),
                        backgroundColor: this.colors.slice(0, this.colors.length),
                    },
                ]
            }
        }
    }
}
</script>