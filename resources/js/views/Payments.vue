<template>
    <h4 class="text-xl">{{$t("payments.title")}}</h4>
    <vue-table per="20" :columns="['id','cost','date','customer']" :items="items"
               :total="total" prefix="payments.table." :current="currentPage" @pageChanged="currentPage = $event">
        <template v-slot:actions="item">
            <button class="bg-gray-200 hover:bg-gray-100 text-gray-800 text-xs w-8 h-8 rounded"
            @click="showUser(item.customer_id)">
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </template>
    </vue-table>
    <modal :modal-active="currentUser !== null" @close="currentUser = null">
        <template v-slot:title>{{$t("payments.profile")}}</template>
        <div class="grid grid-cols-2 gap-4" v-if="currentUser">
            <span><label>{{$t("users.form.first_name")}}:</label> {{currentUser.first_name}}</span>
            <span><label>{{$t("users.form.last_name")}}:</label> {{currentUser.last_name}}</span>
            <span><label>{{$t("users.form.country")}}:</label> {{currentUser.country_name}}</span>
            <span v-for="(item,index) in currentUser.emails"><label>{{$t("users.form.email")}}:</label> {{item.email}}</span>
            <span v-for="(item,index) in currentUser.websites"><label>{{$t("users.form.website")}}:</label> {{item.website}}</span>
        </div>
    </modal>
</template>

<script>
import {ref, watch} from "vue";
import VueTable from "../components/VueTable";
import PaymentsService from "../services/payments-service";
import Modal from "../components/Modal";
import CustomersService from "../services/customers-service";

export default {
    name: "Payments",
    components:{
        VueTable,
        Modal
    },
    async setup() {
        const total = ref(0);
        const currentPage = ref(0);
        const items = ref([]);
        const currentUser = ref(null);

        const loadTable = async () => {
            let response =  await PaymentsService.list(currentPage.value);
            items.value =response.data;
            total.value = response.total;
        }

        const showUser = async (id) => {
            currentUser.value = (await CustomersService.show(id)).data;
        }

        watch(currentPage, ()=>{
            loadTable();
        });

        loadTable();

        return {total, currentPage,items,currentUser,showUser};
    }
}
</script>

<style scoped>

</style>
