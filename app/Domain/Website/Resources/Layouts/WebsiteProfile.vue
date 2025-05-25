<template>

    <WebsiteLayout>
        <div class="head">
            <div class="container-fluid px-5 py-2">
                <div class="row">
                    <div class="col-6">
                        <h1>Hello {{ user.name }}</h1>
                        <p>This is your profile page. You can Edit Your Profile on this Page and Check Your Statics on this Page.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body">
            <div class="container-fluid px-5">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 mb-4 order-lg-1  order-sm-2 order-md-2">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-3">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                                        <li class="nav-item mr-5">
                                            <Link class="nav-link" :class="{'active bg-primary text-light rounded-3': routeIs('me', route_name)}" :href="$route('me')">Home</Link>
                                        </li>
                                        <li class="nav-item mr-5">
                                            <Link class="nav-link" :class="{'active bg-primary text-light rounded-3': routeIs('website.tickets.*', route_name)}"  :href="$route('website.tickets.index')">Tickets</Link>
                                        </li>

                                        <li class="nav-item mr-5">
                                            <Link class="nav-link" :class="{'active bg-primary text-light rounded-3': routeIs('notifications', route_name)}"  :href="$route('notifications')">Notifications</Link>
                                        </li>

                                        <li class="nav-item mr-5">
                                            <Link class="nav-link" :class="{'active bg-primary text-light rounded-3': routeIs('me.update', route_name)}"  :href="$route('me.update')">Update Profile</Link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <div class="mt-4">
                            <slot />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 mb-4 order-lg-2 order-sm-1 order-md-1">
                        <div class="card text-center bg-light rounded-3">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <img width="180" src="https://picsum.photos/id/180/180" class="rounded-circle d-inline-block" alt="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-md-3"></div>

                                        <div class="col text-center">
                                            <p class="stat-number">{{ tickets_statistics.total }}</p>
                                            <p class="stat-desc">Total Tickets</p>
                                        </div>
                                        <div class="col text-center">
                                            <p class="stat-number">{{ tickets_statistics.closed }}</p>
                                            <p class="stat-desc">Closed Tickets</p>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col text-center">
                                            <p class="h2 mb-3">{{ user.name }}</p>
                                            <p class="m-0 p-0">Last Update: {{ moment(user.updated_at) }}</p>
                                            <p class="m-0 p-0">Account Created: {{ moment(user.created_at) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </WebsiteLayout>

</template>


<script>
import WebsiteLayout from '@/Layouts/Website.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
        Link,
        WebsiteLayout,
    },
    computed:{
        user:function(){
            return this.$page.props.auth.user
        },
        route_name:function(){
            return this.$page.props.route_name
        },
        tickets_statistics(){
            return this.$page.props.tickets_statistics;
        }
    },
}
</script>

<style scoped>
    nav{
        box-shadow: 0px 1px 13px -5px #1f4961;
    }

    .head{
        background: rgb(31, 73, 97);
        color: white;
        padding: 50px 0;
    }

    .head h1{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-style: oblique;
    }
    .body{
        position: relative;
        top:-32px;
    }

    .stat-number{
        font-weight: bolder;
        font-size: 23px;
        padding: 0;
        margin: 0;
    }

    .stat-desc{
        padding: 0;
        margin: 0;
        text-transform: uppercase;
        font-family: initial;
        font-size: 13px;
        color: #8e989d;
    }

</style>