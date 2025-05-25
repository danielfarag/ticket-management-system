<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Surveys</h3>
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
                '#f154d6',
                '#f23456',
            ]
        };
    },
    computed:{
        _statuses(){
            return {
                labels: Object.keys(this.statuses),
                datasets: [
                    {
                        label: 'Survey Statuses',
                        data: Object.values(this.statuses),
                        backgroundColor: this.colors,
                    },
                ]
            }
        }
    }
}
</script>