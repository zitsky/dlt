<template>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
            {{ $t("users.form.last_name") }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" type="text" :placeholder="$t('users.form.last_name')">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
            {{ $t("users.form.first_name") }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="first_name" type="text" :placeholder="$t('users.form.first_name')">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
            {{ $t("users.form.country") }}
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="country" type="text" :placeholder="$t('users.form.country')">
    </div>
    <div class="mb-4" v-for="(item,index) in model.emails">
        <label class="block text-gray-700 text-sm font-bold mb-2" :for="`email_${index}`">
            {{ $t("users.form.email") + (model.emails.length > 1 ? ` #${index + 1}` : '')}}
        </label>
        <div class="flex">
            <input v-model="item.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="`email_${index}`" type="email" :placeholder="$t('users.form.email')">
            <label v-if="model.emails.length > 1" class="flex items-center"><input type="checkbox" v-model="item.default" @change="changeDefEmail(index)" value="true" class="ml-3 mr-2 w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/> {{$t("users.form.checkbox_def")}}</label>
            <button v-if="model.emails.length > 1" class="ml-3" @click="dropEmailAt(index)">X</button>
        </div>
    </div>
    <div class="flex justify-end" v-if="model.emails.length < 5">
        <button class="bg-blue-600 ring-1 ring-blue-700 hover:ring-blue-600 hover:bg-blue-500 focus:ring-blue-800 focus:ring-2 focus:bg-blue-700 text-white py-2 px-4 text-sm rounded" @click="addEmail">{{$t("users.form.add_email")}}</button>
    </div>

    <div class="mb-4" v-for="(item,index) in model.websites">
        <label class="block text-gray-700 text-sm font-bold mb-2" :for="`website_${index}`">
            {{ $t("users.form.website") + (model.websites.length > 1 ? `#${index + 1}` : '')}}
        </label>
        <div class="flex">
            <input v-model="item.website" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="`website_${index}`" type="email" :placeholder="$t('users.form.website')">
            <label v-if="model.websites.length > 1" class="flex items-center shrink-0"><input type="checkbox" v-model="item.default" @change="changeDefWebsite(index)" value="true" class="outline-0 ml-3 mr-2 w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/> {{$t("users.form.checkbox_def")}}</label>
            <button v-if="model.websites.length > 1" class="ml-3" @click="dropWebsiteAt(index)">X</button>
        </div>
    </div>
    <div class="flex justify-end" v-if="model.websites.length < 5">
        <button class="bg-blue-600 ring-1 ring-blue-700 hover:ring-blue-600 hover:bg-blue-500 focus:ring-blue-800 focus:ring-2 focus:bg-blue-700 text-white py-2 px-4 text-sm rounded" @click="addWebsite">{{$t("users.form.add_website")}}</button>
    </div>
    {{model}}
</template>

<script>
import {reactive} from "vue";

export default {
    name: "UsersForm",
    props:['model'],
    setup(props, {emit}) {
        let model = reactive({
            id:null,
            first_name:'',
            last_name:'',
            country_id:'RU',
            emails:[
                {email:'',default:true}
            ],
            websites:[
                {website:'',default:true}
            ]

        });

        if(props.model) {
            model = {...model,...props.model};
        }

        const addEmail = () => {
            model.emails = [...model.emails,{
                email:'',
                default:model.emails.length === 0,
            }];
        }
        const addWebsite = () => {
            model.websites = [...model.websites,{
                website:'',
                default:model.websites.length === 0,
            }];
        }

        const dropEmailAt = (at) => {
            let emails = [...model.emails];
            emails.splice(at,1);
            model.emails = emails;
        }

        const dropWebsiteAt = (at) => {
            let websites = [...model.websites];
            websites.splice(at,1);
            model.websites = websites;
        }

        const changeDefWebsite = (at) => {
            let websites = [...model.websites].map((i)=>{ i.default = false; return i;});
            websites[at].default = true;
            model.websites = websites;
        }

        const changeDefEmail = (at) => {
            let emails = [...model.emails].map((i)=>{ i.default = false; return i;});
            emails[at].default = true;
            model.emails = emails;
        }

        return {
            addEmail,
            addWebsite,
            dropEmailAt,
            dropWebsiteAt,
            model,
            changeDefWebsite,
            changeDefEmail
        }
    }
}
</script>

<style scoped>

</style>
