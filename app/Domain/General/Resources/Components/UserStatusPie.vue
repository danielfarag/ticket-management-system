<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
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
    computed:{
        _statuses(){
            return {
                labels: ['Active', 'Inactive'],
                datasets: [
                    {
                        label: 'User Statuses',
                        data: [this.statuses.active, this.statuses.inactive],
                        backgroundColor: ['#267b26', '#ea4b4b']
                    },
                ]
            }
        }
    }
}
</script>