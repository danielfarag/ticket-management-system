<template>

    <Head title="My Tickets Page" />

    <WebsiteProfileLayout>
        <UserTicketsDatatable :tickets="tickets" :statuses="statuses" :severities="severities" :categories="categories"/>
    </WebsiteProfileLayout>

</template>


<script>
import WebsiteProfileLayout from '@/Layouts/WebsiteProfile.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import UserTicketsDatatable from '@/Components/UserTicketsDatatable.vue'

export default {
    props:{
        tickets:Object,
        statuses:Array,
        categories:Array,
        severities:Array,
    },
    components: {
        Head,
        UserTicketsDatatable,
        Link,
        WebsiteProfileLayout,
    },
    computed:{
        user:function(){
            return this.$page.props.auth.user
        }
    },
}
</script>

<style scoped>
.ticket-color{
    color: 'white';
    padding: '3px 14px';
    border-radius: '20px'
}

.not-available{
    color: #a2a2a2;
    text-transform: capitalize;
}
</style>