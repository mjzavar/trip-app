<script  setup>
import Tasks      from "@/Components/Tasks.vue";
import Trips      from "@/Components/Trips.vue";
import LeftPanel  from "@/Components/LeftPanel.vue";
import RightPanel from "@/Components/RightPanel.vue";
</script>

<template >
    <LeftPanel>  <Tasks />  </LeftPanel>
    <RightPanel> <Trips />  </RightPanel>
</template>

<style scoped>

</style>


