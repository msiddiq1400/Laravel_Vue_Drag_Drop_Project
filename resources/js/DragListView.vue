<script lang="ts">
import axios from "axios";
import { defineComponent } from "vue";
import draggable from "vuedraggable";

export default defineComponent({
    components: {draggable},
    props: {
        group: String
    },
    async setup(props) {
        let data;
        try {
            console.log("seyup called")
            const url = `http://localhost:8000/tasks?group=${props.group}`;
            const response = await axios.get(url);
            data = await response.data;
        } catch (err) {
            data = []
        }
        return {
            dataArray: data,
        }
    },
    data() {
        return {
            selectedGroup: this.group,
            itemsList: this.dataArray
        }
    },
    methods: {
        async setDragFalse(event) {
            try {
                const prevIndex = event.oldIndex + 1;
                const newIndex = event.newIndex + 1;
                const url = `http://localhost:8000/update/order?newIndex=${newIndex}&prevIndex=${prevIndex}&group=${this.selectedGroup}`;
                const response = await axios.get(url);
                this.itemsList = await response.data;
            } catch (err) {
                console.log(err)
                alert('Something went wrong 2')
            }
        },

        async updateTask(id, newText) {
            try {
                const url = `http://localhost:8000/task/update?group=${this.group}`;
                const response = await axios.post(url, {id, name: newText});
                this.itemsList = await response.data;
                alert('Task updated Successfully')
            } catch (err) {
                alert('Something went wrong')
            }
        },

        async deleteTask(id) {
            try {
                const url = `http://localhost:8000/task/delete?group=${this.group}`;
                const response = await axios.post(url, {id});
                this.itemsList = await response.data;
                alert('Task Deleted Successfully')
            } catch (err) {
                alert('Something went wrong')
            }
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
                <input :id="element.id" v-model="element.name"/>
                <text class="group-style">{{element.group}}</text>
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
.group-style {
    margin-left: 5px;
    margin-right : 5px;
    background-color: antiquewhite;
}
</style>