<template>
    <div class="search">
        <div class="container text-center">
            <div class="row mb-4">
                <div class="col">
                    <p class="h3 uppercase">What are you looking for ?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <font-awesome-icon icon="search" />
                        </div>
                        <input v-model="key" v-on:keyup.enter="search" type="text" class="form-control" placeholder="Write anything...." aria-label="Write anything...." aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            key: null
        }
    },
    methods:{
        search(){
            this.$inertia.get(route('knowledge.search', {key: this.key}))
        }
    }
}
</script>


<style scoped>
    .search{
        padding:80px;
        background:#f4f4f4
    }
    .input-group-prepend{
        position: relative;
        right:-30px;
        top:8px;
        z-index:10
    }

    .form-control{
        border-radius: 20px !important;
        padding-left: 35px
    }
</style>