<template>
    <Head>
        <meta name="description" :content="settings.description">
        <meta name="keywords" :content="settings.keywords?.split('|').join(', ')">
    </Head>
    <WebsiteHeader />
    <main>
        <Announcements type="website" />
        <slot />
    </main>
    <WebsiteFooter />
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import WebsiteHeader from '@/Components/WebsiteHeader.vue'
import WebsiteFooter from '@/Components/WebsiteFooter.vue'
import Announcements from '@/Components/Announcements.vue'
export default {
    components: {
        WebsiteHeader,
        WebsiteFooter,
        Announcements,
        Head,
    },
    computed: {
        message() {
            return this.$page.props.message
        },
        settings() {
            return this.$page.props.settings
        },
    },
    watch:{
        message(toast){
            if(toast && toast.message != null){
                this.$toast.show(toast.message,{
                    type:toast.type
                });
            }
        }
    },
}
</script>


<style>
    main{
        background-color: #eef4f8;
    }
</style>