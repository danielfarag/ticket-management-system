<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <div class="card">
            <div class="card-header p-2">
                <SettingsNavbar @setTab="setTab" :tab="tab" :errors="errors_groups"/>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <GeneralSettings @onErrors="onError" :settings="settings" @updated="form.general = $event" :tab="tab" :errors="errors" :statuses="statuses" :severities="severities" />

                    <FooterSettings @onErrors="onError" :settings="settings" @updated="form.footer = $event" :tab="tab" :errors="errors" />

                    <SocialNetworkSettings @onErrors="onError" :settings="settings" @updated="form.social_network = $event" :tab="tab" :errors="errors" />

                    <TermsSettings @onErrors="onError" :settings="settings" @updated="form.terms = $event" :tab="tab" :errors="errors" />

                    <NotificationsSettings @onErrors="onError" :settings="settings" @updated="form.notifications = $event" :tab="tab" :errors="errors" />

                    <HomeSettings @onErrors="onError" :settings="settings" @updated="form.home = $event" :tab="tab" :errors="errors" />
                </div>
            </div>

            <div class="card-footer ">
                <button type="button" @click="save" class="btn btn-primary">Save Settings</button>
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import SettingsNavbar from '@/Components/SettingsNavbar.vue';
import GeneralSettings from '@/Components/GeneralSettings.vue';
import FooterSettings from '@/Components/FooterSettings.vue';
import SocialNetworkSettings from '@/Components/SocialNetworkSettings.vue';
import TermsSettings from '@/Components/TermsSettings.vue';
import NotificationsSettings from '@/Components/NotificationsSettings.vue';
import HomeSettings from '@/Components/HomeSettings.vue';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        InputError,
        SettingsNavbar,
        GeneralSettings,
        FooterSettings,
        SocialNetworkSettings,
        TermsSettings,
        NotificationsSettings,
        HomeSettings,
    },
    props:{
        errors: Object,
        settings: Object,
        statuses: Object,
        severities: Object,
    },
    data(){
        return {
            form:{
                general:{},
                footer:{},
                social_network:{},
                terms:{},
                notifications:{},
                home:{},
            },
            tab:'general',
            errors_groups:{
                general:false,
                footer:false,
                social_network:false,
                terms:false,
                notifications:false,
                home:false,
            }
        }
    },
    methods:{
        save(){
            this.$inertia.post(route('settings.store'), {
                ...this.form.general,
                ...this.form.footer,
                ...this.form.social_network,
                ...this.form.terms,
                ...this.form.notifications,
                ...this.form.home,
            })
        },
        onError({key,value}){
            this.errors_groups[key] = value
        },
        setTab(key){
            this.tab = key;
        }
    }
}
</script>
