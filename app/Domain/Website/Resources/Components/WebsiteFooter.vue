<template>
    <footer class="text-light">
        <div class="container-fluid" v-if="(settings.show_about || settings.show_quick_links || settings.show_social_networks || settings.show_address) == true">
            <div class="row p-5">
                <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12 about" v-if="settings.show_about == true">
                    <img class="footer_logo" :src="logo" alt="Supporter support ticket system">
                    <p class="about-content">
                        {{ settings.footer_about }}
                    </p>
                </div>

                <div class="col-md-12 col-lg-3 col-sm-12 col-xs-12 quick-links" v-if="settings.show_quick_links == true">
                    <p class="h3 uppercase section_title">quick links</p>
                    <ul class="m-0 p-0">
                        <li v-for="(link, index) in quick_links" :key="index"><a target="_blank" :href="link.url">{{ link.title }}</a></li>
                    </ul>
                </div>

                <div class="col-md-12 col-lg-3 col-sm-12 col-xs-12 text-center social-links">
                    <div v-if="settings.show_social_networks == true">
                        <p class="h3 uppercase section_title">Social Links</p>
                        <a v-if="settings.facebook_url" class="social" :href="settings.facebook_url" target="_blank">
                            <font-awesome-icon :icon="['fab', 'facebook-f']"/>
                        </a>
                        <a v-if="settings.twitter_url" class="social" :href="settings.twitter_url" target="_blank">
                            <font-awesome-icon :icon="['fab', 'twitter']"/>
                        </a>
                        <a v-if="settings.instagram_url" class="social" :href="settings.instagram_url" target="_blank">
                            <font-awesome-icon :icon="['fab', 'instagram']"/>
                        </a>
                        <a v-if="settings.linkedin_url" class="social" :href="settings.linkedin_url" target="_blank">
                            <font-awesome-icon :icon="['fab', 'linkedin']"/>
                        </a>
                    </div>
                <p class="mt-5" v-if="settings.show_address == true">{{ settings.address }}</p>
                </div>
            </div>
        </div>
        <div class="line"></div>
        <div class="container-fluid terms">
            <div class="row p-4">
                <div class="col">
                    <Link class="text-light links" :href="$route('terms')">Terms & Condition</Link>
                    <Link class="text-light links mx-4" :href="$route('privacy')">Privacy Policy</Link>
                    <Link class="text-light links" :href="$route('team_members')">Member terms</Link>
                </div>
                <div class="col text-right">
                    <a href="#" class="text-light links copyright">{{ settings.copyrights }}</a>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link
    },
    computed:{
        logo(){
            const logo = this.settings.footer_logo;
            return logo == '' || logo == null ? '/images/footer_logo.png' : this.settings.footer_logo 
        },
        settings() {
            return this.$page.props.settings
        },
        quick_links() {
            return this.$page.props.quick_links
        },
    },
}
</script>

<style scoped>

    footer{
        background-color: black;
    }

    .footer_logo{
        width: 150px;
        height: 110px;
        margin-bottom: 22px;
    }
    footer .social{
        background-color: #373737;
        padding: 11px 15px;
        border-radius: 50%;
        margin:0 7px;
        cursor: pointer;
        color: white;;
        transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
        -o-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
        -webkit-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
        -ms-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
        -moz-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    }

    footer .social:hover{
        background-color: #f2435a;
    }

    footer .line{
        border:1px solid white;
        border-color: rgba(238, 238, 238, 0.25); 
    }


    .about .about-content{
        color:rgb(224, 224, 224);
    }

    .quick-links li{
        margin-top: 16px;
    }
    .quick-links li a{
        border-bottom: 1px dashed rgb(179, 179, 179);
        text-decoration: none;
        color:rgb(224, 224, 224);
    }

    .social-links p{
        margin-bottom: 25px;
    }

    .section_title{
        font-size: 1.75rem;
        color: #686868;
        text-transform: uppercase;
        font-family: initial;
        text-align: inherit;
    }
</style>