<script>
import axios from 'axios';
import DragListView from './DragListView.vue';
export default {
    name: "App",
    components: {DragListView},
    data() {
        return {
            newTask: '',
            rerenderForm: 0,
            selected: 'A'
        };
    },
    methods: {
        async addTask(newText) {
            const url = `http://localhost:8000/task/add`;
            const response = await axios.post(url, {name: newText, group: this.selected});
            this.itemsList = await response.data;
            alert('Task Added Successfully');
            this.newTask = '';
            this.rerenderForm++;
        },
        onChange() {
            this.rerenderForm++;
        }
    }
};
</script>

<template>
    <h2 class="title">Draggable list</h2>
    <div class="sub-header">
        <div class="add-task">
            <input v-model="newTask"/>
            <button class="btn" @click="addTask(newTask)">Add Task</button>
        </div>
        <select class="select-box" v-model="selected"  @change="onChange()">
            <option value="A" text="Group A"/>
            <option value="B" text="Group B"/>
        </select>
    </div>
    <Suspense>
        <template #fallback>
          <div>loading</div>
        </template>
        <DragListView :group="selected" :key="rerenderForm"/>
      </Suspense>
</template>

<style scoped>
.title {
    display: flex;
    justify-content: center;
}

.add-task {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
    margin-bottom: 30px;
}

.sub-header {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.select-box {
    margin-bottom: 70px;
}

.btn {
    margin-top: 15px;
}
</style>