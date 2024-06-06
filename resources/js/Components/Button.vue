<script>
export default {
    props: ['loading' , 'text'],
    methods : {
        emitAction : function(){
            console.log(this.loading)
            this.$emit('buttonClick')
        }
    }
}
</script>

<template>
    <v-btn class="mt-2" type="submit"   @click="emitAction()"  :disabled="loading" block>
        <v-progress-circular
            v-if="loading"
            color="primary"
            indeterminate="disable-shrink"
            size="16"
            width="2"
        ></v-progress-circular>
        <span v-else >{{text || 'click'}} </span>
    </v-btn>
</template>

<style scoped>

</style>
