<script>
import items from './constants';
import draggable from "vuedraggable";
import axios from 'axios';

console.log(items)
export default {
    name: "App",
    components: {draggable},
    data() {
        return {
            itemsList: items,
        };
    },
    methods: {
        checkMove(event) {},

        setDragTrue(event) {
        },

        setDragFalse(event) {
            console.log("111")
            console.log(event.newIndex)
            console.log(event.oldIndex)
            console.log(this.getAllTasks())
        },

        async getAllTasks() {
            const url = 'http://localhost:8000/tasks';
            const response = await axios.get(url);
            const data = await response.data
            console.log(data)   
        }
    },
};
</script>

<template>
    <h2 class="title">Draggable list</h2>
    <draggable 
        v-model="itemsList" 
        group="people" 
        @start="setDragTrue" 
        @end="setDragFalse" 
        item-key="id"
        :move="checkMove"
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