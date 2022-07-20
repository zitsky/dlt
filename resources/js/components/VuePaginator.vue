<template>
    <div class="paginator flex gap-3 p-4 justify-center" v-show="total > 0">
        <button v-for="pageItem of pageItems" class="p-1 pl-2 pr-2 rounded-full m-w-8 h-8 text-xs ring-gray-400 ring-1" :class="{'bg-blue-400 text-white ring-blue-500':current===pageItem}" @click="goPage(pageItem)">{{pageItem}}</button>
    </div>
</template>

<script>
import {ref, watch} from "vue";

export default {
    name: "VuePaginator",
    props:['per','total','delta','current'],
    emits:['pageChanged'],
    setup(props, {emit}) {
        const current = ref(props.current);
        const pageItems = ref([]);
        const delta = props.delta ?? 3;

        function buildItems() {
            let items = [], tmp = [];
            if(props.total > 0 && props.per > 0) {
                let pages = Math.ceil(props.total / props.per);
                let left = parseInt(current.value) + 1 - delta;
                let right = parseInt(current.value) + 1 + delta;
                let i = 0, l = 0;
                for (i = 1; i <= pages; i++) {
                    if (i === 1 || i === pages || i >= left && i <= right) {
                        tmp.push(i);
                    }
                }

                for (i = 0; i < tmp.length; i++) {
                    if (l) {
                        if (Math.abs(tmp[i] - l) > 2) {
                            items.push('...');
                        }
                    }
                    items.push(tmp[i]);
                    l = tmp[i];
                }
            }
            pageItems.value = items;
        }

        watch([props], ()=>{
            buildItems();

        });

        buildItems();

        function goPage(page) {
            if(page!=='...') {
                current.value = page;
                emit('pageChanged',page);
                buildItems();
            }
        }

        return {pageItems,current, goPage};
    }
}
</script>

<style scoped>

</style>
