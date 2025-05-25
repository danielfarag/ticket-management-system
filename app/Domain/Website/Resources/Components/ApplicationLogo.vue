<template>
    <Link :href="$route('home')" class="navbar-brand d-flex align-items-center col-md-2 mb-2 mb-md-0 text-dark text-decoration-none">
        <img :src="logo" alt="Supporter support ticket system">
    </Link>
</template>


<script>
export default {
    
    computed:{
        logo(){
            const logo = this.settings.logo;
            return logo == '' || logo == null ? '/images/logo.png' : this.settings.logo 
        },
        settings() {
            return this.$page.props.settings
        },
    }

}
</script>