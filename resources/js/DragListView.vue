<script lang="ts">
import axios from "axios";
import { defineComponent } from "vue";
import draggable from "vuedraggable";

export default defineComponent({
    components: {draggable},
    async setup() {
        const url = 'http://localhost:8000/tasks';
        const response = await axios.get(url);
        const data = await response.data;
        return {
            dataArray: data,
        }
    },
    data() {
        return {
            itemsList: this.dataArray
        }
    },
    methods: {
        async setDragFalse(event) {
            const prevIndex = event.oldIndex + 1;
            const newIndex = event.newIndex + 1;
            const url = `http://localhost:8000/update/order?newIndex=${newIndex}&prevIndex=${prevIndex}`;
            const response = await axios.get(url);
            this.itemsList = await response.data;
        },

        async updateTask(id, newText) {
            const url = 'http://localhost:8000/task/update';
            const response = await axios.post(url, {id, name: newText});
            this.itemsList = await response.data;
            alert('Task updated Successfully')
        },

        async deleteTask(id) {
            const url = 'http://localhost:8000/task/delete';
            const response = await axios.post(url, {id});
            this.itemsList = await response.data;
            alert('Task Deleted Successfully')
        }
    },
})
</script>


<template>
    <div>
        <draggable 
            v-model="this.itemsList" 
            group="people" 
            @end="setDragFalse" 
            item-key="id"
        >
        <template #item="{element}">
            <div class="name-style">
                <input :id="element.id" class="text-style" v-model="element.name"/>
                <button @click="updateTask(element.id, element.name)">Update</button>
                <button @click="deleteTask(element.id)">Delete</button>
            </div>
        </template>
        </draggable>
    </div>
</template>

<style scoped>
.name-style {
    font-size: 24px;
    display: flex;
    justify-content: center;
}
.text-style {
    
}
</style>