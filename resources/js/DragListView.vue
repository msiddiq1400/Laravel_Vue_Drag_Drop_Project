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
                {{element.name}}
            </div>
        </template>
        </draggable>
    </div>
</template>

<style scoped>
.name-style {
    border: 1px solid black;
    font-size: 24px;
    display: flex;
    justify-content: center;
}
</style>