<template>
    <div class="addItem">
        <input type="radio" id="Paper" name="recycledItem" value="Paper"  v-model="item.item_name">
        <label for="paper">Paper</label><br>
        <input type="radio" id="plastic_bottles" name="recycledItem" value="Plastic Bottles"  v-model="item.item_name">
        <label for="plastic_bottles">Plastic Bottles</label><br>
        <input type="radio" id="metal_tin" name="recycledItem" value="Metal Tin"  v-model="item.item_name">
        <label for="metal_tin">Metal Tin</label><br>
        <button type="button" v-on:click="addItem"> Submit </button>

    </div>



</template>

<script>
export default {
    data: function () {
       return {
           item: {
               item_name: '',
           }

       }
    },
    methods: {
        addItem() {
            if (this.item.full_name == '') {
                return;
            }
            axios.post('api/item/add',{
                item: this.item
            }).then(reponse => {
                if (reponse.status == 201 || reponse.status == 200){
                    console.log("success");
                    this.$emit('reloadlist');
                }
                
            }).catch(error => {
                console.log(error);
            })
        }
    }

}
</script>

<style scoped>
.addItem{
    justify-content: center;
    align-items: center;
    
}
input[type="radio"]{
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
}
</style>