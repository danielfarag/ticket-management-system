<script>
import { defineComponent } from 'vue'
import { Pie } from 'vue3-chart-v2'

export default defineComponent({
  name: 'PieChart',
  extends: Pie,
  data() {
    return {
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  },
  props:{
    chartData:Object
  },
  mounted() {
    this.renderChart(this.chartData, this.chartOptions)
  }
})
</script>