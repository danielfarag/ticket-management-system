<template>
    <div class="card bg-light rounded-3">
        <div class="card-header">
            <p class="m-0 fw-bolder">Latest Notifications</p>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row mb-4"  v-for="notification in notifications" :key="notification.id">
                    <div class="col-1 text-center icon">
                        <img :src="notification.data.icon" alt="img">
                    </div>
                    <div class="col">
                        <p class="h5 m-0"><Link :href="notification.data.entity.url + '?notification=' + notification.id" class="notification-title">{{ notification.data.title }}</Link></p>
                        <p class="h5 m-0">{{ notification.data.description }}</p>
                        <span class="notification-date">{{ moment(notification.created_at) }}</span>
                    </div>
                </div>
                <div class="row" v-if="notifications.length == 0">
                    <div class="col">
                        <p class="h5 m-0 no-notifications">No notifications are available</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link,
    },
    computed:{
        notifications() {
            return this.$page.props.notifications
        },
    },
}
</script>

<style scoped>
    .notification-title{
        color: #171717;
        font-family: initial;
        font-style: italic;
    }
    .notification-date{
        font-family: initial;
        color: #a2a2a2;
    }

    .no-notifications{
        color: #a2a2a2;
        text-transform: capitalize
    }

    .icon{
        font-size: 30px;
    }
</style>