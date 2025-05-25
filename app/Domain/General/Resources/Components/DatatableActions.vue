<template>
    <Link class="btn btn-link" :href="$route(show_url, entity.id)">
        <font-awesome-icon icon="eye" />
    </Link>

    <button @click="deleteEntity()" class="btn btn-link text-danger">
        <font-awesome-icon icon="trash" />
    </button>

    <Link class="btn btn-link text-info" :href="$route(edit_url, entity.id)">
        <font-awesome-icon icon="edit" />
    </Link>
</template>

<script>
import {  Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Link
    },
    props:{
        entity:Object,
        show_url:String,
        edit_url:String,
        delete_url:String,
    },
    methods:{
        deleteEntity(){
            this.$inertia.delete(route(this.delete_url, this.entity.id))
        }
    }
}
</script>
