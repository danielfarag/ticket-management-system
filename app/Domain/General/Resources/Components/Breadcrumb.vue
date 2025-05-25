<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ breadcrumb.title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li v-for="(item,index) in breadcrumb.items" :key="index" class="breadcrumb-item" :class="{'active':item.active}">
                            <Link :href="item.url">{{ item.label }}</Link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link
    },
    computed:{
        breadcrumb(){
            return this.$page.props.breadcrumb;
        }
    }
}
</script>

<style scoped>
.breadcrumb .breadcrumb-item.active a{
    text-decoration: none;
    color:#6c757d;
}
</style>