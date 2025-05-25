<template>
    <div class="lucky">
        <div class="container text-center">
            <div class="row mb-4">
                <div class="col text-light">
                    <img src="https://img.freepik.com/free-vector/yellow-background-with-halftone-lines-design_1017-30148.jpg?size=626&ext=jpg"/>

                    <div class="content">
                        <p class="h1 ">Need help ?!</p>
                        <p class="h6">Speak with one of our representatives.</p>
                        <Link :href="$route('contact')" class="btn btn-light mt-4 btn-lg px-5 py-2"> <i class="fas fa-envelope"></i> Send Email </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link
    },
    methods:{
    }
}
</script>


<style scoped>
.lucky{
    padding:120px 80px;
    background:#4d244a;
    position:relative
}

.lucky img{
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.3;
}

.lucky a{
    color:#f2435a;
    transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -o-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -webkit-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -ms-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -moz-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
}

.content{
    z-index: 1;
    position: relative;
}
</style>