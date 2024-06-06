
<script >
import Button from "@/Components/Button.vue";

import {reactive} from 'vue';
import axios from "axios";
export default {
    components : {Button} ,


    data() {
        return {
            form:{
                title : null,
                driver_id : null,
                truck_id : null,
            } ,
            drivers: [],
            trucks: [],
            dialog  : false ,
            errors: {
                render : null ,
                register  : null ,
            } ,
            loading: {
                render : false   ,
                register  : false ,
            } ,
        }
    },
    methods: {
        openDialog(){
            this.dialog = true ;
            this.form = {
                title : null,
                driver_id : null,
                truck_id : null,
            }

        },
        async register(){

            this.loading.register = true

            try {
                 let response = (await axios.post(route('api.trips.create') , this.form )).data
                 this.dialog = false
                 this.resourceManager.updateResources([
                   'api.trips'
                 ]);
            } catch (error) {
                this.errors.register  = error.response.data.message || error.toString()
                this.loading.register = false
            } finally {
                this.loading.register = false
            }
        },

    },
    created() {

        this.resourceManager.registerResoures( 'CreateTask' , [
            { resource : 'drivers' , route : {name : 'api.drivers'} },
            { resource : 'trucks' , route : { name : 'api.trucks' } },
        ])

        this.emitter.on("resourceRendered", (response) => {

            let findResource    = this.resourceManager.findResource('CreateTask' , response.route)

            if(findResource)
            {
                this[findResource.resource] = response.resource.data
            }
        });
    },


}
</script>



<template>
    <Button @click="openDialog()"  color="surface-variant"  text="Create A Trip" variant="flat"/>

    <v-dialog v-model="dialog"  max-width="500">
        <v-alert v-if="errors.render"
                 :text="error"
                 title="Error"
                 type="warning"
        ></v-alert>

        <v-card v-if="!errors.render" title="Create a New Trip ....">
            <v-card-text>

                <v-sheet class="mx-auto" width="300">

                    <v-alert v-if="errors.register"
                             :text="errors.register"
                             type="error"
                    ></v-alert>

                    <v-form @submit.prevent>

                        <v-text-field
                            v-model="form.title"
                            label="Title"
                        ></v-text-field>

                        <v-select
                            label="Driver"
                            v-model="form.driver_id"
                            :items="drivers"
                            item-title="name"
                            item-value="id"
                        ></v-select>

                        <v-select
                            label="Truck"
                            v-model="form.truck_id"
                            :items="trucks"
                            item-title="title"
                            item-value="id"
                        ></v-select>

                        <Button :loading="loading.register" text="Create"   v-on:buttonClick="register"/>

                    </v-form>
                </v-sheet>

            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                    text="Close Dialog"
                    @click="isActive.value = false"
                ></v-btn>
            </v-card-actions>
        </v-card>

    </v-dialog>


</template>

<style scoped>

</style>

