<template>

    <Head title="Profile Page" />

    <WebsiteProfileLayout>
        <div class="row">
            <div class="col">
                <WebsiteProfileCard :number="tickets_statistics.total" description="Total Tickets" icon="plus"/>
            </div>
            <div class="col">
                <WebsiteProfileCard :number="tickets_statistics.opened" description="Opened Tickets" icon="closed-captioning"/>
            </div>
            <div class="col">
                <WebsiteProfileCard :number="tickets_statistics.closed" description="Closed Tickets" icon="ticket-alt"/>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <UserTicketsStaticDatatable :tickets="tickets"/>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-6">
                <UserNotificationsList />
            </div>
        </div>
    </WebsiteProfileLayout>

</template>


<script>
import WebsiteProfileLayout from '@/Layouts/WebsiteProfile.vue'
import { Head } from '@inertiajs/inertia-vue3';

import WebsiteProfileCard from '@/Components/WebsiteProfileCard.vue'
import UserTicketsStaticDatatable from '@/Components/UserTicketsStaticDatatable.vue'
import UserNotificationsList from '@/Components/UserNotificationsList.vue'

export default {
    props:{
        tickets:Array,
        tickets_statistics:Object
    },
    components: {
        Head,
        WebsiteProfileLayout,
        WebsiteProfileCard,
        UserTicketsStaticDatatable,
        UserNotificationsList,
    },
    computed:{
        user:function(){
            return this.$page.props.auth.user
        },
    },
}
</script>


<style scoped>
    .ticket-color{
        color: 'white';
        padding: '3px 14px';
        border-radius: '20px'
    }

    .no-available{
        color: #a2a2a2;
        text-transform: capitalize;
    }

    .icon{
        font-size: 30px;
    }

    .notification-title{
        color: #171717;
        font-family: initial;
        font-style: italic;
    }

    .notification-date{
        font-family: initial;
        color: #a2a2a2;
    }

</style>