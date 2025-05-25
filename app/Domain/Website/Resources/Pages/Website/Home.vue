<template>

    <Head title="Home Page" />

    <WebsiteLayout>
            
        <WebsiteSlider v-if="slides.length > 0 && settings.show_slider == true" :slides="slides" />

        <WebsiteSearch v-if="settings.show_search == true" />


        <WebsiteDepartments v-if="departments.length > 0 && settings.show_departments == true" :departments="departments" />



        <WebsiteSubmitTicket v-if="settings.show_submit_ticket == true" />



        <WebsiteFaq v-if="faqs.length > 0 && settings.show_faq == true" :faqs="faqs" />



        <WebsiteSupport v-if="settings.show_help == true" />
        
    </WebsiteLayout>


</template>


<script>
import WebsiteLayout from '@/Layouts/Website.vue'
import WebsiteSlider from '@/Components/WebsiteSlider.vue'
import WebsiteSearch from '@/Components/WebsiteSearch.vue'
import WebsiteDepartments from '@/Components/WebsiteDepartments.vue'
import WebsiteSubmitTicket from '@/Components/WebsiteSubmitTicket.vue'
import WebsiteFaq from '@/Components/WebsiteFaq.vue'
import WebsiteSupport from '@/Components/WebsiteSupport.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    
    components: {
        Head,
        WebsiteLayout,
        WebsiteSlider,
        WebsiteSearch,
        WebsiteDepartments,
        WebsiteSubmitTicket,
        WebsiteFaq,
        WebsiteSupport,
    },
    props:{
        slides: Array,
        departments: Array,
        faqs: Array,
    },
    computed:{
        settings(){
            return this.$page.props.settings;
        }
    }
}
</script>