<template>
    <div class="recycleListContainer">
        <div class="heading">
            <h2 id="title">Recycling App  </h2>
            <add-item-form />
            <h3 id="recyclecount"> Total Recycled items {{  total }}</h3>
        </div>
         
        <list-view :items="items"
        v-on:reloadlist="getList()"
        />
    </div>
</template>

<script>
import addItemForm from './addItemForm.vue'
import ListView from './listView.vue'

export default {
    components: {
        addItemForm,
        ListView
    },
    data: function () {
        return {
            items : [],
            total : 0
        }
    },
    methods: {
        getList () {
            axios.get('api/items')
            .then(reponse => {
                this.items = reponse.data;
            })
            .catch( error => {
                console.log(error);
            })
        },
        getTotalRecycled () {
            axios.get('api/totalItems')
            .then(response => {
                this.total = response.data;
            })
            .catch( error=> {
                console.log(error);
            })
        }
    },
    created() {
        this.getList();
        this.getTotalRecycled();
    }
}
</script>

<style scoped>
.recycleListContainer{
    width: 350px;
    margin: auto;
}
.heading {
    background: goldenrod;
    padding:10px;
}
#title{
    text-align: center;
}
</style>