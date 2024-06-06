<script  setup>

import Tasks from "@/Components/Tasks.vue";
import Trips from "@/Components/Trips.vue";


</script>

<script>
export default {
    data() {
        return {
            show : false
        }
    } ,

}
</script>

<template >

    <LeftPanel ><Tasks  /></LeftPanel>
    <RightPanel > <button @click="show=true" >show</button><div ><Trips />  </div></RightPanel>
</template>




<style scoped>

</style>


