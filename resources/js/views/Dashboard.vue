<template>
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-xl">
            {{$t("dashboard.title")}}
        </h4>
        <div class="flex justify-end" style="width:50%">
            <select v-model="slice" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block grow p-2.5 mr-5">
                <option value="day">{{$t('dashboard.slice.day')}}</option>
                <option value="week">{{$t('dashboard.slice.week')}}</option>
                <option value="month">{{$t('dashboard.slice.month')}}</option>
            </select>
            <Datepicker v-model="fromTo" range :maxDate="new Date()" class="grow"
                        :locale="locale" format="Y-MM-dd"
                        :clearable="false"
                        :enableTimePicker="false"
                        :cancelText="$t('defaults.cancel')" :selectText="$t('defaults.select')"/>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div class="shadow p-4">
            <h3 class="text-md mb-2">{{$t("dashboard.payments")}}</h3>
            <dashboard-payments :data="payments" class="mb-4"></dashboard-payments>
            <VueTable :columns="['key','val']" :prefix="'dashboard.payment_table.'" :items="payments" :total="100" :per="0"></VueTable>
        </div>
        <div class="shadow p-4">
            <h3 class="text-md mb-2">{{$t("dashboard.users")}}</h3>
            <dashboard-users-chart :data="customers" class="mb-4"></dashboard-users-chart>
            <VueTable :columns="['key','val']" :prefix="'dashboard.customer_table.'" :items="customers"  :total="100" :per="0"></VueTable>
        </div>

    </div>
</template>

<script>
import DashboardPayments from "../components/DashboardPaymentsChart";
import DashboardUsersChart from "../components/DashboardUsersChart";
import DashboardPaymentsTable from "../components/DashboardPaymentsTable";
import DashboardUsersTable from "../components/DashboardUsersTable";
import DashboardService from '../services/dashboard-service';

import {inject, onMounted, ref, watch} from "vue";
import moment from "moment";
import {useI18n} from "vue-i18n";
import VueTable from "../components/VueTable";

export default {
    name: "Dashboard",
    components: {DashboardUsersTable, DashboardPaymentsTable, DashboardUsersChart, DashboardPayments,VueTable},
    async setup() {
        const {locale} = useI18n();
        const payments = ref([]);
        const customers = ref([]);
        const slice = ref('day');
        const fromTo = ref([new Date().setDate(new Date().getDate()-30),new Date()]);
       // watch(slice, fromTo)
        onMounted(()=>{
            reload();
        });
        async function reload() {
            payments.value = (await DashboardService.getPayments(getFromDate(0),getFromDate(1),slice.value)).data;
            customers.value = (await DashboardService.getCustomers(getFromDate(0),getFromDate(1),slice.value)).data;
        }

        function getFromDate(i) {
            return moment(fromTo.value[i]).format("yyyy-MM-DD");
        }

        watch([fromTo,slice], () => {
            reload();
        });

        return {payments, customers,slice, fromTo,locale};
    },


}
</script>

<style scoped>

</style>
