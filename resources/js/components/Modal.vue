<template>
    <transition name="modal-animate">
        <div tabindex="-1" aria-hidden="true" v-show="modalActive" class=" overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex bg-gray-900 bg-opacity-50">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto ">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow" >
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            <slot name="title"></slot>
                        </h3>
                        <button @click="close" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-toggle="defaultModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">{{$t("defaults.close")}}</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6  overflow-y-auto" style="max-height:70vh">
                        <slot></slot>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 ">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "Modal",
    props:['modalActive'],
    setup(props, {emit}) {
        const close = () => {
            emit('close');
        }
        return {close};
    }
}
</script>

<style scoped>

</style>
