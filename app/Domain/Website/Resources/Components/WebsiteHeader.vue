<template>
    <header>
        <div class="bg-dark px-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8 text-left d-none  d-sm-none d-md-block">
                        <a :href="'mailto:' + settings.email" class="pl-0 btn btn-sm text-white "><i class="fas fa-envelope text-danger"></i> {{ settings.email }}</a>

                        <a :href="'tel:' + settings.phone_number" class="btn btn-sm text-white px-4 py-2"><i class="fas fa-phone-alt text-danger"></i> {{ settings.phone_number }}</a>

                        <a class="btn btn-sm text-white"><i class="fas fa-clock text-danger"></i> {{ settings.working_hours }}</a>
                    </div>
                    
                    <div class="col text-lg-end text-sm-center text-center">
                        <Link :href="$route('website.tickets.create')" class="text-white btn btn-success p-2 uppercase">Create Ticket</Link>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg px-5 d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
                <div class="container-fluid">
                    <ApplicationLogo />

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                        <font-awesome-icon icon="bars" />
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav m-auto my-2 my-lg-0 navbar-nav-scroll" >
                            <li class="nav-item"><Link :href="$route('home')" class="nav-link text-center px-2 link-dark" :class="{'active':  routeIs('home', route_name)}">Home</Link></li>
                            <li class="nav-item"><Link :href="$route('features')" class="nav-link text-center px-2 link-dark" :class="{'active':  routeIs('features', route_name)}">Features</Link></li>
                            <li class="nav-item"><Link :href="$route('knowledge.index')" class="nav-link text-center px-2 link-dark" :class="{'active':  routeIs('knowledge.*', route_name)}">Knoweldge Base</Link></li>
                            <li class="nav-item"><Link :href="$route('faqs.department')" class="nav-link text-center px-2 link-dark" :class="{'active':  routeIs('faqs.*', route_name)}">FAQs</Link></li>
                            <li class="nav-item"><Link :href="$route('about')" class="nav-link text-center px-2 link-dark" :class="{'active':  routeIs('about', route_name)}">About</Link></li>
                            <li class="nav-item"><Link :href="$route('contact')" class="nav-link text-center px-2 link-dark" :class="{'active':  routeIs('contact', route_name)}">Contact</Link></li>

                        </ul>
                        <div class="d-flex">
                            <Link v-if="!user" :href="$route('login')" class="btn btn-outline-primary mr-3">Login</Link>
                            <Link v-if="!user" :href="$route('register')" class="btn btn-primary">Sign Up</Link>

                            <Link v-if="user" :href="$route('me')" class="btn btn-outline-primary mr-3">Profile</Link>
                            <button @click="open" v-if="user" class="btn position-relative btn-outline-info mr-3">
                                <font-awesome-icon icon="bell" />
                                <span v-if="count_unread_notifications > 0" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count_unread_notifications }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>

                            <WebsiteDropdownNotificationList ref="notificationsPopup" :notifications="notifications"/>

                            <button v-if="user" @click="logout" class="btn btn-danger">
                                <font-awesome-icon icon="lock" />
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue'
import WebsiteDropdownNotificationList from '@/Components/WebsiteDropdownNotificationList.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

export default {
    components:{
        Link,
        InputError,
        WebsiteDropdownNotificationList,
        ApplicationLogo,
    },
    computed:{
        logo(){
            const logo = this.settings.logo;
            return logo == '' || logo == null ? '/images/logo.png' : this.settings.logo 
        },
        user() {
            return this.$page.props.auth.user
        },
        route_name() {
            return this.$page.props.route_name
        },
        settings() {
            return this.$page.props.settings
        },
        notification_namespaces() {
            return this.$page.props.notification_namespaces
        },
        count_unread_notifications(){
            return this.notifications.filter(notification=>notification.read_at == null).length;
        }
    },
    data(){
        return {
            notifications: []
        }
    },
    mounted(){
        this.notifications = this.$page.props.notifications

        if(this.user){
            // Echo.private(`users.${this.user.id}`)
            // .notification((notification) => {

            //     switch (notification.type) {
            //         case this.notification_namespaces.ticket_created:
            //             this.$toast.show('New Ticket has been created',{
            //                 type:'success'
            //             });
            //             this.notifications.push(notification)
            //             break;
                
            //         default:
            //             break;
            //     }
            // });
        }
    },
    methods:{
        logout(){
            this.$inertia.post(route('logout'))
        },
        open(){
            this.$refs.notificationsPopup.open()
        }
    }
}
</script>


<style  scoped>
    .active{
        color: blue !important
    }
</style>