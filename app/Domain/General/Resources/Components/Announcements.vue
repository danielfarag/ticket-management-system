<template>
    <div v-if="announcements.length > 0" class="alert alert-info m-0" role="alert">
        <p class="h3"><u>Annonucements</u></p>
        <ul>
            <li v-for="(announcement,index) in announcements" :key="index">
                <p v-html="announcement.content"></p>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    computed:{
        announcements() {
            if(this.type == 'dashboard'){
                return this.$page.props.dashboard_announcements
            }else{
                return this.$page.props.website_announcements
            }
        }
    },
    props:{
        type: String,
    }

}
</script>
