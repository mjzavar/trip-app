<script setup>

</script>
<script>
import Button from "@/Components/Button.vue";


export default {
    components : {Button} ,
    data() {
        return {
            tab: 0,
            trips : []
        }
    },
    created() {
        this.resourceManager.registerComponent(this  ,  [
            { resource : 'trips' , route : { name : 'api.trips' } }
        ])
    }

}

</script>

<template>
    <v-card>
        <v-toolbar color="primary" title="Trips List :">
        </v-toolbar>

        <div class="d-flex flex-row">
            <v-tabs
                v-model="tab"
                color="primary"
                direction="vertical"
            >
                <v-tab prepend-icon="mdi-account" v-for="(trip,index) in trips" :text="`${trip.title}  (${trip.task_count})`" :value="index"></v-tab>
            </v-tabs>

            <v-tabs-window v-model="tab">

                <v-tabs-window-item v-for="(trip,index) in trips" :value="index">
                    <v-card flat>
                        <v-card-text>
                            <div class="border rounded overflow-hidden bg-gray-100 p-10">
                                <v-table >
                                    <thead>
                                    <tr>
                                        <th class="font-bold text-blue-600">Trip:</th>
                                        <th  > {{trip.title}} </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <th class="font-bold text-blue-600">Driver:</th>
                                        <td>{{ trip.driver?.name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="font-bold  text-blue-600">Truck:</th>
                                        <td>{{ trip.truck?.title }}</td>
                                    </tr>
                                    <tr>
                                        <th class="font-bold  text-blue-600">Tasks:</th>
                                        <td>

                                            <ul class="list-inside divide-y divide-solid divide-gray ">
                                                <li v-for="(task, index) in trip.tasks" class="p-2 text-gray-600 hover:bg-gray-100">
                                                    <div class="grid grid-cols-2">
                                                        <div>
                                                           {{task.title}}
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>


                                        </td>
                                    </tr>
                                    </tbody>
                                </v-table>
                            </div>

                        </v-card-text>
                    </v-card>
                </v-tabs-window-item>

            </v-tabs-window>
        </div>
    </v-card>
</template>

<style scoped>
.v-slide-group__container button {
    border: solid 1px #eaeaea;

}

</style>
