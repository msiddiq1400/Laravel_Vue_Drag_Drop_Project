<script>
import items from './constants';
import draggable from "vuedraggable";
console.log(items)
export default {
    name: "App",
    components: {draggable},
    data() {
        return {
            itemsList: items,
        };
    },
    methods: {},
};
</script>

<template>
    <h2 class="title">Draggable list</h2>
    <draggable 
        v-model="itemsList" 
        group="people" 
        @start="drag=true" 
        @end="drag=false" 
        item-key="id"
    >
    <template #item="{element}">
        <div class="name-style">{{element.name}}</div>
    </template>
    </draggable>
</template>

<style scoped>
.name-style {
    border: 1px solid black;
    font-size: 24px;
    display: flex;
    justify-content: center;
}

.title {
    display: flex;
    justify-content: center;
}
</style>