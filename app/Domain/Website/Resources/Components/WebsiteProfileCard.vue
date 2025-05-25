<template>
    <div class="card bg-light rounded-3">
        <div class="card-body">
            <table class="table text-center table-borderless">
                <tr>
                    <td class="w-50">
                        <ul class="m-0 p-0">
                            <li><p class="number">{{ number }}</p></li>
                            <li><p class="description">{{ description }}</p></li>
                        </ul>
                    </td>
                    <td class="w-50 icon">
                        <font-awesome-icon :icon="icon" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        number: String,
        description: String,
        icon: String,
    }
}
</script>


<style scoped>
.number{
    font-weight: bolder;
    font-size: 32px;
    padding: 0;
    margin: 0;
}

.description{
    padding: 0;
    margin: 0;
    text-transform: uppercase;
    font-family: initial;
    font-size: 13px;
    color: #8e989d
}

.icon{
    font-size:44px
}
</style>