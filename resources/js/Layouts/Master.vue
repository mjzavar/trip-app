<script>

import CreateTripModal from "@/Components/Modals/CreateTrip.vue";
export default {
    components : {CreateTripModal} ,
    data() {
        return {
            resourceProgress : false ,
        }
    },
    created() {
        this.emitter.on("resourceProgress", (status) => {
            this.resourceProgress = status
        });
    }
}
</script>

<template>
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full text-sm">
        <nav class="relative max-w-[85rem] w-full mx-auto bg-white border-b border-gray-200 py-3 px-4 sm:py-0 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 xl:border-x dark:bg-neutral-800 dark:border-neutral-700" aria-label="Global">
            <div class="flex items-center justify-between">
                <CreateTripModal />
            </div>
            <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end py-2 md:py-0 sm:ps-7">
                    <span class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-black-600 dark:text-white-500" >{{ $page.props.auth.user?.name || 'guest' }}</span>
                </div>
            </div>
        </nav>
    </header>

    <main id="content" class="relative max-w-[85rem] mx-auto">
        <v-progress-linear
            v-if="resourceProgress"
            color="yellow-darken-2"
            indeterminate
        ></v-progress-linear>

        <div class="grid grid-cols-2 gap-0 ">
                <slot  />
        </div>
    </main>

</template>

<style scoped>

</style>
