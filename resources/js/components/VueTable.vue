<template>
    <div>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th v-for="column of columns" class="py-3 px-6" :key="column">{{ $t(`${prefix ?? ""}${column}`) }}</th>
                <th v-if="$slots.actions">{{$t("defaults.actions")}}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b" v-for="item of items" :key="item">
                <td class="py-4 px-6" v-for="column of columns" :key="column">{{item[column]}}</td>
                <td v-if="$slots.actions">
                    <slot name="actions" v-bind="item"></slot>
                </td>
            </tr>
            </tbody>
            <tfoot class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th v-for="column of columns" class="py-3 px-6" :key="column">{{ $t(`${prefix ?? ""}${column}`) }}</th>
            </tr>
            </tfoot>
        </table>
        <vue-paginator :per="per" :total="total" v-show="total > 0 && per > 0" :delta="6" :current="current" @pageChanged="pageChanged($event)"></vue-paginator>
    </div>
</template>

<script>
import {ref} from "vue";
import VuePaginator from "./VuePaginator";
export default {
    name: "VueTable",
    components:{VuePaginator},
    props:['columns','prefix','items','total','per','current'],
    emits:['pageChanged'],
    setup(props, {emit}) {
        function pageChanged(page) {
            emit('pageChanged',page);
        }
        return {pageChanged};
    }
}
</script>

<style scoped>

</style>
