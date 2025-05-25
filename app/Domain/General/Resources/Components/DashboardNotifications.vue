<template>
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span v-if="count_unread_notifications > 0" class="badge badge-danger navbar-badge">{{ count_unread_notifications }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <Link
            :class="{'unread':notification.read_at == null}"
            :href="notification.data.entity.url + '?notification=' + notification.id"
            class="dropdown-item"
            v-for="(notification, index) in notifications"
            :key="index"
        >
            <div class="media">
                <img :src="notification.data.icon" :alt="notification.data.title" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                    <h3 class="dropdown-item-title">
                        {{ notification.data.title }}
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">{{ notification.data.description }}</p>
                    <p class="text-sm text-muted" :data-created_date="notification.created_at"><i class="far fa-clock mr-1"></i> {{ fromNow(notification.created_at) }}</p>
                </div>
            </div>
        </Link>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
</template>


<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    computed:{
        notifications(){
            return this.$page.props.notifications;
        },
        count_unread_notifications(){
            return this.notifications.filter(notification=>notification.read_at == null).length;
        }
    }
}
</script>

<style scoped>
.dropdown-item{
    border-bottom: 1px solid #e1e1e1;
}

.dropdown-item.unread{
    background-color: #ffebeb;
}

</style>