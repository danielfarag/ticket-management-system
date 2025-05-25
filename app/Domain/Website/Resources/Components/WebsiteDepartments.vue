<template>
    
    <div class="departments">
        <div class="container text-center">
            <div class="row mb-4">
                <div class="col">
                    <p class="h3 uppercase">Select a Department</p>
                    <p class="h6 uppercase">Do You Want to Know</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12" v-for="(department, index) in departments" :key="index">
                    <Link class="department_link" :href="$route('faqs.department', department.id)">
                        <ul class="department border mb-4 p-3" >
                            <li class="text-center"><img :src="department.image"/></li>
                            <li class="my-4"><p class="h3">{{ department.name }}</p></li>
                            <li><p>{{ department.description }}</p></li>
                        </ul>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props:{
        departments: Array,
    }
}
</script>

<style scoped>
.departments{
    padding:80px 0;
}

.departments .department{
    background-color: rgb(240, 246, 255);
    transition: background-color 0.5s ease-in-out;
    -o-transition: background-color 0.5s ease-in-out;
    -webkit-transition: background-color 0.5s ease-in-out;
    -ms-transition: background-color 0.5s ease-in-out;
    -moz-transition: background-color 0.5s ease-in-out;

    border: 2px dashed black;
}

.department_link{
    text-decoration: none;
    color: black;
}

.department img{
    display: inline;
    width:150px;
    height:150px
}

.departments .department:hover{
    cursor: pointer;
    background-color:#f3f3f3;
}


</style>
