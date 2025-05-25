<template>

    <Head title="Profile Page" />

    <WebsiteProfileLayout>
        <div class="row mt-4">
            <div class="col">
                <UserNotificationsList />
            </div>
        </div>
    </WebsiteProfileLayout>

</template>


<script>
import WebsiteProfileLayout from '@/Layouts/WebsiteProfile.vue'
import { Head } from '@inertiajs/inertia-vue3';
import UserNotificationsList from '@/Components/UserNotificationsList.vue'

export default {
    components: {
        Head,
        WebsiteProfileLayout,
        UserNotificationsList,
    },
    computed:{
        user:function(){
            return this.$page.props.auth.user
        },
    },
}
</script>

