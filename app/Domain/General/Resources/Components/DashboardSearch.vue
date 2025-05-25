<template>
    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
    </a>
    <div class="navbar-search-block">
        <div class="form-inline">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" v-model="subject" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button @click="search" class="btn btn-navbar" >
                        <i class="fas fa-search"></i>
                    </button>
                    <button @click="cancel" class="btn btn-navbar" type="button" data-widget="navbar-search">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            subject:null,
        }
    },
    methods:{
        cancel(){
            this.subject = null;
        },
        search(){
            this.$inertia.get(route('tickets.index', {
                page:1,
                order_by:'id',
                order:'desc',
                subjecct:this.subject
            }))
        }
    }
}
</script>