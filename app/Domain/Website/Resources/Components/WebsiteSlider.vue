<template>
    <splide :options="options" @splide:moved="moved" class="p-0">
        <splide-slide v-for="(slide,index) in slides" :key="index" :style="{backgroundImage: 'url('+slide.image+')'}">
            <div class="container">
                <div class="row">
                    <div class="col-5 offset-2 mt-3 text-left slide-section">
                        <p class="main-title">{{ slide.title }}</p>
                        <p class="sub-title">{{ slide.subtitle }}</p>
                        <a :href="slide.link" class="btn btn-info uppercase text-light">{{ slide.button }}</a>
                    </div>
                </div>
            </div>
        </splide-slide>
    </splide>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Splide,
        Link,
        SplideSlide,
    },
    props:{
        slides:Array
    },
    data() {
        return {
            options: {
                rewind      : true,
                perPage     : 1,
                gap         : '1rem',
                autoplay    : true,
                pauseOnHover: false,
                type        : 'fade',
                arrows      : 'slider',
                height      : 800
            },
        };
    },
    methods: {
        moved( splide, newIndex ) {
            // console.log( 'moved', newIndex );
        },
    },
}
</script>

<style>
    @import '@splidejs/splide/dist/css/splide.min.css';
    @import '@splidejs/splide/dist/css/themes/splide-default.min.css';
    @import '@splidejs/splide/dist/css/themes/splide-sea-green.min.css';
    @import '@splidejs/splide/dist/css/themes/splide-skyblue.min.css';

    .slide-section{
        background-color: #ffffffc2;
        box-shadow: 0px 0px 19px 1px #9f9f9f;
        padding: 37px;
        position: relative;
        top: 200px;
    }

    .main-title{
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        border-bottom: 1px dashed black;
        font-size:44px;
        padding: 1px 0 22px 0;
        margin-bottom: 22px;
    }
    .sub-title{
        margin-bottom: 22px;
        color: #7d7d7d;
        font-family: revert;
        font-style: oblique;
        font-size: 18px;
    }

</style>