
<script >
import Button from "@/Components/Button.vue";

import {reactive} from 'vue';
import axios from "axios";
export default {
    components : {Button} ,

    data() {
        return {
            dialog:  false   ,
            trips : [],
            task: null,
            trip_id: null,
            overwrite : false ,
            loading : false  ,
            errors : this.defaultErrors() ,
        }
    },
    created() {

        this.resourceManager.registerResoures(this,  [
            { resource : 'trips' , route : {name : 'api.trips' } },
        ])


        this.emitter.on("initAssignTask", (task) => {
            this.errors = this.defaultErrors()
            this.dialog    =   true
            this.overwrite =   0
            this.trip_id   =   task.trip?.id || null
            this.task      =  task
        });
    },

    methods: {
        async register(){
            this.errors = this.defaultErrors()
            this.loading = true
            let payload  = {trip:this.trip_id , task : this.task?.id , overwrite : this.overwrite} ;

            try {

                await axios.patch(route('api.trips.tasks.assign' , payload )  )
                this.resourceManager.updateResources([
                     'api.tasks',
                     'api.trips',
                ]);

                this.closeDialog()

            } catch (error) {

                this.errors.text  = error.response?.data?.message || error.toString()
                this.errors.code  =  error.response.status
                this.loading = false
            } finally {
                this.loading = false
            }
        },
        closeDialog : function (){
            this.dialog = false
            this.task = null
            this.errors = this.defaultErrors()
        } ,

        defaultErrors : function(){
            return { text : null, code : 0  }
        }

    }


}
</script>

<template>


    <div class="text-center pa-4">

        <v-dialog
            v-model="dialog"
            width="auto"
        >

            <v-card  >
                <v-card-text>

                    <v-sheet class="mx-auto" width="300">

                        <div class="mb-2">
                            assign "{{task?.title}}"  to a trip :
                        </div>

                        <v-form @submit.prevent>

                            <v-select
                                label="Trip"
                                v-model="trip_id"
                                :items="trips"
                                item-title="title"
                                item-value="id"
                            ></v-select>

                            <div v-if="errors.text" class="p-4 text-red-600" >
                                {{ errors.text }}
                                <div v-if="errors.code === 409" class="flex items-center mb-4">
                                    <input v-model="overwrite" id="overwrite-checkbox" type="checkbox" value="1"  class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="overwrite-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">overwrite</label>
                                </div>
                            </div>

                            <Button   text="Assign" :loading="loading"  v-on:buttonClick="register" />

                        </v-form>
                    </v-sheet>

                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        text="Close Dialog"
                        @click="closeDialog"
                    ></v-btn>
                </v-card-actions>
            </v-card>


        </v-dialog>
    </div>

</template>


<style scoped>

</style>
