<script>
import DragListView from './DragListView.vue';
export default {
    name: "App",
    components: {DragListView},
    data() {
        return {};
    }
};
</script>

<template>
    <h2 class="title">Draggable list</h2>
    <Suspense>
        <template #fallback>
          <div>loading</div>
        </template>
        <DragListView />
      </Suspense>
</template>

<style scoped>
.title {
    display: flex;
    justify-content: center;
}
</style>