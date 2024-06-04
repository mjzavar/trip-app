<script setup>
import {reactive} from 'vue';
const  form = reactive({
    title : null
});
function create(){
    console.log(form);
}
</script>

<template>

    <input v-model="form.title">
    <button @click="create">create</button>


</template>

<style scoped>

</style>

<script>


</script>
