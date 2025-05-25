<template>
    <a class="nav-link" href="#" @click.prevent="logout" role="button">
        <i class="fas fa-key"></i>
    </a>
</template>

<script>
export default {
    methods:{
        logout(){
            this.$inertia.post(route('dashboard.logout'))
        }
    }
}
</script>