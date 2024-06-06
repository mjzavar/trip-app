<script >
import Modal from "@/Components/Modals/CreateTask.vue";
import {defineComponent, reactive} from "vue";

export default defineComponent({
    components: {Modal}
})

</script>

<template>


    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full text-sm">
        <nav class="relative max-w-[85rem] w-full mx-auto bg-white border-b border-gray-200 py-3 px-4 sm:py-0 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 xl:border-x dark:bg-neutral-800 dark:border-neutral-700" aria-label="Global">
            <div class="flex items-center justify-between">
                <Modal />
            </div>
            <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end py-2 md:py-0 sm:ps-7">
                    <Link class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-blue-600 dark:text-blue-500" :href="route('about')" aria-current="page">Landing</Link>
                    <Link class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-blue-600 dark:text-blue-500" :href="route('home')" aria-current="page">Home</Link>
                    <span class="py-3 ps-px sm:px-3 sm:py-6 font-medium text-black-600 dark:text-white-500" >{{ $page.props.auth.user?.name || 'guest' }}</span>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" class="relative max-w-[85rem] mx-auto">
        <div class="grid grid-cols-2 gap-0 ">
                <slot  />
        </div>


<!--        <div class="flex flex-row max-w-[85rem] w-full mx-auto bg-white border-b border-gray-200 py-3 px-4 sm:py-0 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8 xl:border-x">-->
<!--            <div class="flex-col sm:flex-none bg-black  py-10 px-4 sm:px-6 lg:px-8  dark:bg-neutral-800 ">01</div>-->
<!--            <div class="flex-col sm:flex-none bg-blue-700  py-10 px-4 sm:px-6 lg:px-8  dark:bg-neutral-800 border-l">02</div>-->
<!--        </div>-->


    </main>


</template>

<style scoped>

</style>
