import {createI18n} from "vue-i18n";
import en from "./langs/en";
import ru from "./langs/ru";

const i18n = createI18n({
    legacy:false,
    globalInjection:true,
    locale: 'ru', // set locale
    fallbackLocale: 'en',
    messages: {
        en: en,
        ru: ru
    }
})
const $t = i18n.global.t;
export {i18n,$t};
