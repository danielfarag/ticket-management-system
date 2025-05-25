<template>
    <div class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- <Loader></Loader> -->

            <Navbar />

            <Aside />
  
            <div class="content-wrapper">
              
                <Announcements type="dashboard" />

                <Breadcrumb />

                <section class="content">  <slot /> </section>
                
            </div>

            <Footer />

            <Control />

        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Loader from '@/Components/Loader.vue'
import Navbar from '@/Components/Navbar.vue'
import Aside from '@/Components/Aside.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import Announcements from '@/Components/Announcements.vue'
import Footer from '@/Components/Footer.vue'
import Control from '@/Components/Control.vue'

export default {
    components: {
        Link,
        Loader,
        Navbar,
        Aside,
        Breadcrumb,
        Announcements,
        Footer,
        Control,
    },

    computed: {
        message() {
            return this.$page.props.message
        }
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
