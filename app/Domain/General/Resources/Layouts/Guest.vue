<template>
    <div class="hold-transition login-page">
        <slot />
    </div>
</template>

<script>
export default {
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
