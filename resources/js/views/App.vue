<template>
    <header class="w-full h-16 bg-gray-100 fixed top-0 p-3 justify-between flex z-20">
        <h3 class="text-3xl">{{ $t("header") }}</h3>
        <select v-model="locale">
            <option value="ru">{{ $t('langs.ru') }}</option>
            <option value="en">{{ $t('langs.en') }}</option>
        </select>
    </header>
    <div class="content py-20 px-4">
        <Suspense>
        <router-view/>
        </Suspense>
    </div>
    <footer class="w-full h-15 bg-gray-200 fixed bottom-0 flex justify-center z-20">
        <ul class="flex">
            <li class="p-2">
                <router-link to="/" class="block bg-gray-300 rounded p-1" active-class="!bg-blue-600 !text-white" :replace="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </router-link>
            </li>
            <li class="p-2">
                <router-link to="/users" class="block bg-gray-300 rounded p-1" active-class="!bg-blue-500 !text-white"  :replace="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </router-link>
            </li>
            <li class="p-2">
                <router-link to="/payments" class="block bg-gray-300 rounded p-1" active-class="!bg-blue-500 !text-white"  :replace="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </router-link>
            </li>
        </ul>
    </footer>
</template>
<script>

import Dashboard from "./Dashboard";
import Payments from "./Payments";
import Users from "./Users";
import {useI18n} from 'vue-i18n';
import {inject, watch} from "vue";


export default {
    name: 'App',
    components: {
        Dashboard,
        Payments,
        Users
    },
    setup() {
        const {locale} = useI18n();
        const config = inject(Symbol.for('FormKitConfig'))

        watch(locale, (next) => {
            config.locale = next;
        });
        return {locale};
    }
}
</script>
<style>

</style>
