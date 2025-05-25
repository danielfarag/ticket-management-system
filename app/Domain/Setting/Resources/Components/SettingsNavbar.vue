<template>
    <ul class="nav nav-pills">
        <li class="nav-item"><a @click="setTab('general')" :class="{'active':tab == 'general', 'text-danger': errors.general == true}" class="nav-link" href="#general" data-toggle="tab">General</a></li>
        <li class="nav-item"><a @click="setTab('footer')" :class="{'active':tab == 'footer', 'text-danger': errors.footer == true}" class="nav-link" href="#footer" data-toggle="tab">Footer</a></li>
        <li class="nav-item"><a @click="setTab('social_network')" :class="{'active':tab == 'social_network', 'text-danger': errors.social_network == true}" class="nav-link" href="#social_network" data-toggle="tab">Social Network</a></li>
        <li class="nav-item"><a @click="setTab('terms')" :class="{'active':tab == 'terms', 'text-danger': errors.terms == true}" class="nav-link" href="#terms" data-toggle="tab">Terms & Conditions</a></li>
        <li class="nav-item"><a @click="setTab('notifications')" :class="{'active':tab == 'notifications', 'text-danger': errors.notifications == true}" class="nav-link" href="#notifications" data-toggle="tab">Notification</a></li>
        <li class="nav-item"><a @click="setTab('home')" :class="{'active':tab == 'home', 'text-danger': errors.home == true}" class="nav-link" href="#home" data-toggle="tab">Home</a></li>
        <li class="nav-item import">
            <Link class="btn btn-link mx-2" :href="$route('import', 'settings')">Import Settings</Link>
            <a class="btn btn-link" target="_blank" :href="$route('export', 'settings')">Export Settings</a>
        </li>
    </ul>
</template>


<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link,
    },
    props:{
        tab: String,
        errors: String,
    },
    methods:{
        setTab(tab){
            this.$emit('setTab', tab)
        }
    }
}
</script>

<style scoped>
    .import{
        position: absolute;
        right: 0;
    }
</style>