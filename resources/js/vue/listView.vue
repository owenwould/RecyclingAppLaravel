<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <list-item 
            :item="item"
            class="item"
            />

        </div>
    </div>
</template>

<script>
import listItem from "./listItem.vue"

export default {
    props: ['items'],
    components: {
        listItem
    }
}
</script>

<style scoped>
.item{
    background: goldenrod;
    padding: 5px;
    margin-top: 5px;
}
</style>