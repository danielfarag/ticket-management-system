<template>
    <div :class="['small-box', 'bg-primary', 'bg-' + color]">
        <div class="inner">
            <h3>{{ number }} <sup v-if="percentage">%</sup></h3>

            <p>{{ text }}</p>
        </div>
        <div class="icon">
            <i :class="['ion', 'ion-'+icon]"></i>
        </div>
        <Link :href="url" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link
    },
    props:{
        color:String,
        percentage:Boolean,
        number:Number,
        text:String,
        icon:String,
        url:String,
    }
}
</script>

<style scoped>
    sup{
       font-size: 20px 
    }
</style>