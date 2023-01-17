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
            itemsList: data
        }
    },
    methods: {
        setDragTrue(event) {},
        setDragFalse(event) {},
    },
})
</script>


<template>
    <div>
        <draggable 
            v-model="itemsList" 
            group="people" 
            @start="setDragTrue" 
            @end="setDragFalse" 
            item-key="priority"
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