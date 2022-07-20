
import {createApp} from "vue";
import '../css/tailwind.css';
import {createRouter, createWebHistory} from "vue-router";
import routes from "./routes";
import App from "./views/App";
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {i18n} from "./locale";
import { createDynamicForms } from '@asigloo/vue-dynamic-forms';
import '@asigloo/vue-dynamic-forms/dist/themes/default.scss';
import { plugin, defaultConfig } from '@formkit/vue'
import { ru as fkru, en as fken } from '@formkit/i18n'

const router = createRouter({
    history: createWebHistory(),
    routes
});

const dynamicForms = createDynamicForms({
    // Global Options go here
});

function domainName(node) {
    return /[a-zA-Z0-9][a-zA-Z0-9-]{0,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+/.test(node.value);
}

const app = createApp(App);

app.component('Datepicker', Datepicker);
app.use(router);
app.use(i18n);
app.use(plugin, defaultConfig({
    theme: 'genesis',
    locales: { ru : fkru, en: fken },
    // Define the active locale
    locale: 'ru',
    rules: { domainName },
}));
app.use(Toast,{});
app.use(dynamicForms);
app.provide('i18n',i18n);

//app.component('welcome',Welcome);
app.mount('#app');
