<template>
    <div class="support">
        <div class="container text-center">
            <div class="row mb-4">
                <div class="col text-light">
                    <img src="https://img.freepik.com/free-vector/yellow-background-with-halftone-lines-design_1017-30148.jpg?size=626&ext=jpg"/>

                    <div class="content">
                        <p class="h1 ">Still can't find a solution? We can help!</p>
                        <p class="h6">Submit a new ticket and we’ll get back to you as soon as possible</p>
                        <Link :href="$route('website.tickets.create')" class="btn btn-light mt-4 btn-lg px-5 py-2"> <i class="fas fa-ticket-alt"></i> Submit a Ticket</Link>
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
    }
}
</script>


<style scoped>
.support{
    padding:120px 80px;
    background:#f2435a;
    position:relative
}

.support .btn{
    color:#f2435a;
    transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -o-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -webkit-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -ms-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
    -moz-transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
}

.support img{
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.3;
}

.content{
    z-index: 1;
    position: relative;
}
</style>