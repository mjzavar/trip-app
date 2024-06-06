
<script >
import Button from "@/Components/Button.vue";

import {reactive} from 'vue';
import axios from "axios";
export default {
    components : {Button} ,


    data() {
        return {
            form: this.defaultForm() ,
            drivers : [],
            trucks  : [],
            dialog  : false ,
            error   : false  ,
            loading : false  ,
        }
    },
    methods: {
        openDialog(){
            this.dialog = true ;
            this.resetDialog();
        },
        closeDialog(){
            this.dialog = false ;
            this.resetDialog();
        },
        resetDialog(){
            this.error   = false
            this.loading = false
            this.form    = this.defaultForm()
        },


        defaultForm(){
            return {
                title : null,
                driver_id : null,
                truck_id : null,
            }
        },
        async register(){
            this.loading = true
            try {
                 let response = (await axios.post(route('api.trips.create') , this.form )).data
                 this.dialog = false
                 this.resourceManager.updateResources([
                   'api.trips'
                 ]);
            } catch (error) {
                this.error   = error.response.data.message || error.toString()
            } finally {
                this.loading = false
            }
        },

    },
    created() {

        this.resourceManager.registerResoures( this , [
            { resource : 'drivers' , route : {name : 'api.drivers'} },
            { resource : 'trucks' , route : { name : 'api.trucks' } },
        ])

    },
}
</script>

<template>
    <Button @click="openDialog()"  color="surface-variant"  text="create a trip" variant="flat"/>

    <v-dialog v-model="dialog"  max-width="500">


        <v-card  title="Create a New Trip">
            <v-card-text>

                <v-sheet class="mx-auto" width="300">

                    <v-alert v-if="error"
                             :text="error"
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

                        <Button :loading="loading" text="Create"   v-on:buttonClick="register"/>

                    </v-form>
                </v-sheet>

            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                    text="Close"
                    @click="closeDialog"
                ></v-btn>
            </v-card-actions>
        </v-card>

    </v-dialog>


</template>

<style scoped>

</style>

