<template>
    <div class="notifications text-left" id="box" :style="{height:height, opacity:opacity}">
        <h2>Notifications</h2>
        <Link :href="notification.data.entity.url + '?notification=' + notification.id" class="notifications-item" :class="{'unread':notification.read_at == null}" v-for="(notification,index) in notifications" :key="index">
            <img :src="notification.data.icon" alt="img">
            <div class="text">
                <h4>{{ notification.data.title }}</h4>
                <p>{{ notification.data.description }}</p>
            </div>
        </Link>

        <p class="no-notifications" v-if="notifications.length == 0">No notifications are available</p>
    </div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link,
    },
    data(){
        return {
            height: '0px',
            opacity: 0
        }
    },
    props:{
        notifications:Array
    },
    methods:{
        open(){
            this.height == 'auto' ? this.height = '0px' : this.height = 'auto';
            this.opacity == 0 ? this.opacity = 1 : this.opacity = 0;
        }
    }
}
</script>
<style scoped>

.notifications {
    width: 300px;
    height: 0px;
    opacity: 0;
    position: absolute;
    top: 122px;
    max-height: 281px;
    overflow-y: scroll;
    z-index: 1000;
    right: 62px;
    border-radius: 5px 0px 5px 5px;
    background-color: #fff;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}

.no-notifications {
    padding: 14px 0 0px 14px
}

.notifications h2 {
    font-size: 14px;
    padding: 10px;
    border-bottom: 1px solid #eee;
    color: #999;
    font-weight: bolder;
}

.notifications-item {
    text-decoration: none;
    display: flex;
    border-bottom: 1px solid #eee;
    padding: 6px 9px;
    margin-bottom: 0px;
    cursor: pointer;

}

.notifications-item.unread{
    background-color: #ffebeb;
}

.notifications-item:hover {
    background-color: #eee
}

.notifications-item img {
    display: block;
    width: 50px;
    height: 50px;
    margin-right: 9px;
    border-radius: 50%;
    margin-top: 2px
}

.notifications-item .text h4 {
    color: #777;
    font-size: 16px;
    margin-top: 3px
}

.notifications-item .text p {
    color: #aaa;
    font-size: 12px
}
</style>