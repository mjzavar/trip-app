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

        this.resourceManager.registerResoures('Trips'  ,  [
            { resource : 'trips' , route : { name : 'api.trips' } }
        ])

        this.emitter.on("resourceRendered", (response) => {
            let findResource    = this.resourceManager.findResource('Trips' , response.route)
            if(findResource)
            {
                this[findResource.resource] = response.resource.data
            }
        });
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
                <v-tab prepend-icon="mdi-account" v-for="(trip,index) in trips" :text="trip.title" :value="index"></v-tab>
            </v-tabs>

            <v-tabs-window v-model="tab">

                <v-tabs-window-item v-for="(trip,index) in trips" :value="index">
                    <v-card flat>
                        <v-card-text>
                            <div class="border rounded overflow-hidden bg-gray-100 p-10">
                                <v-table >
                                    <thead>
                                    <tr>
                                        <th class="font-bold text-blue-600">Trip</th>
                                        <th  > {{trip.title}}</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <th class="font-bold text-blue-600">Driver</th>
                                        <td>{{ trip.driver?.name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="font-bold  text-blue-600">Truck</th>
                                        <td>{{ trip.truck?.title }}</td>
                                    </tr>
                                    <tr>
                                        <th class="font-bold  text-blue-600">Task</th>
                                        <td>{{ trip.task?.title || '-' }}</td>
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
