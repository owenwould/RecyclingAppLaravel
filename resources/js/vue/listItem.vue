<template>
    <div>
        <div class="item">
             <span> {{ item.item_name  }}:{{ item.item_count }} </span>
        
        </div>
    </div>
</template>

<script>
export default {
    props: ['item']
}
</script>

<style scoped>
.item{
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>