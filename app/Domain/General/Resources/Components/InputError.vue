<template>
    <div v-show="message" class="w-100">
        <p class="text-sm text-danger">
            {{ message }}
        </p>
    </div>

</template>

<script>
export default {
    props: ['message']
}
</script>
