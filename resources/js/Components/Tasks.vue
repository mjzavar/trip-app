<script setup>
import AssignTaskModal from "@/Components/Modals/AssignTask.vue";
</script>
<script >

import axios from "axios";
export default {
    data() {
        return {
            filters  : [{id : 'all' , title : 'all'} ,{id : 'assigned' , title : 'assigned'} , {id : 'not-assigned' , title : 'not assigned'} , ] ,
            filter   : 'all' ,
            tasks : [] ,
        }
    },
    created() {
        this.resourceManager.registerComponent(this ,  [
            { resource : 'tasks' , route : {name : 'api.tasks' } },
        ])
    },
    methods: {
        filterTasks: async function(){
            let filter = {filter : this.filter} ;
            this.tasks = (await axios.get( route('api.tasks' , filter) )).data ;
        },
        assigne: async function (task){
            this.emitter.emit("initAssignTask" ,  task);
        },
    },

}
</script>

<template>

    <AssignTaskModal  />


    <v-select
        label="Filter Tasks"
        v-model="filter"
        :items="filters"
        item-title="title"
        item-value="id"
        @update:modelValue="filterTasks"
    ></v-select>



    <ul class="list-inside divide-y divide-solid divide-gray ">
        <li class="py-2 font-bold">Tasks List :</li>
        <li v-for="(task, index) in tasks" class="p-2 text-gray-600 hover:bg-gray-100">
            <div class="grid grid-cols-2">
                <div>
                    {{task.id}} - {{task.title}}
                </div>
                <div class="text-right" >
                    <v-chip v-if="task.trip" prepend-icon="$vuetify" color="green" @click="assigne(task)" >
                        assigned to : {{ task.trip.title }}
                    </v-chip>
                    <v-chip v-else @click="assigne(task)"  color="red">
                        not assigned
                    </v-chip>
                </div>
            </div>
        </li>
    </ul>


</template>

<style scoped>

</style>

