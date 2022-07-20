<template>
    <modal :modalActive="activeModal" @close="close">
        <FormKit
            type="form"
            ref="customerFormRef"
            id="customerForm"
            :actions="false"
            @submit="handleSubmit"
            :errors="formErrors"
        >
            <FormKit type="text" :label="$t('users.form.last_name')" validation="required" v-model="form.last_name"/>
            <FormKit type="text" :label="$t('users.form.first_name')" validation="required" v-model="form.first_name"/>
            <FormKit type="select" :label="$t('users.form.country')" validation="required" v-model="form.country_id"
                     :options="countries"/>
            <FormKit type="list" :label="$t('users.table.emails')">
                <FormKit type="email" v-for="(item,index) in form.emails"
                         :label="`${$t('users.form.email')} ${form.emails.length > 1 ? '#' + (index + 1) : ''}`"
                         v-model="item.email" validation="required|email"
                        :errors="formInputErrors[`emails.${index}.email`]??[]"
                >
                    <template v-slot:prefix>
                        <div class="flex items-center h-full pl-2">
                            <div class="h-5">
                                <FormKit type="checkbox" v-model="item.default" v-if="form.emails.length > 1"
                                         style="margin-bottom:0;" @change="changeDefEmail(index)"></FormKit>
                            </div>
                        </div>
                    </template>
                    <template v-slot:suffix>
                        <button @click="dropEmailAt(index)" class="mr-2" v-if="form.emails.length>1">X</button>
                    </template>
                </FormKit>
                <FormKit type="button" @click="addEmail">{{ $t("users.add_email") }}</FormKit>
            </FormKit>

            <FormKit type="list" :label="$t('users.table.websites')">
                <FormKit type="email" v-for="(item,index) in form.websites"
                         :label="`${$t('users.form.website')} ${form.emails.length > 1 ? '#' + (index + 1) : ''}`"
                         v-model="item.website" validation="required|domainName"
                         :errors="formInputErrors[`websites.${index}.website`]??[]">
                    <template v-slot:prefix>
                        <div class="flex items-center h-full pl-2">
                            <div class="h-5">
                                <FormKit type="checkbox" v-model="item.default" v-if="form.websites.length > 1"
                                         style="margin-bottom:0;" @change="changeDefWebsite(index)"></FormKit>
                            </div>
                        </div>
                    </template>
                    <template v-slot:suffix>
                        <button @click="dropWebsiteAt(index)" class="mr-2" v-if="form.websites.length>1">X</button>
                    </template>
                </FormKit>
                <FormKit type="button" @click="addWebsite">{{ $t("users.add_website") }}</FormKit>
            </FormKit>
        </FormKit>

        <template v-slot:title>{{ $t(title) }}</template>
        <template v-slot:footer>
            <fine-button type="primary" @click="submitForm('customerForm')" :disabled="submitting">
                {{ $t(primaryButton) }}
            </fine-button>
            <fine-button @click="close" :disabled="submitting">{{ $t("defaults.cancel") }}</fine-button>
        </template>
    </modal>
</template>

<script>

import Modal from "./Modal";
import FineButton from "./FineButton";
import {onMounted, reactive, ref, watch} from "vue";
import UsersForm from "./UsersForm";
import CountriesService from "../services/countries-service";
import {reset,submitForm} from '@formkit/core';
import {$t} from '../locale';
import CustomersService from "../services/customers-service";


export default {
    name: "UsersModal",
    props: ['activeModal', 'type', 'model', 'customerId'],
    components: {
        UsersForm,
        Modal,
        FineButton
    },
    computed: {
        title(props) {
            return props.type === 'edit' ? 'users.modal.edit_title' : 'users.modal.add_title';
        },
        primaryButton(props) {
            return props.type === 'edit' ? 'defaults.update' : 'defaults.create';
        }
    },
    async setup(props, {emit}) {
        const customerFormRef = ref(null);
        const submitting = ref(false);
        const countries = (await CountriesService.all()).map(i => {
            return {label: i.name, value: i.id}
        });

        const form = ref({
            first_name: 'test',
            last_name: 'test',
            country_id: 'RU',
            emails: [
                {email: 'test@test.te', default: true}
            ],
            websites: [
                {website: 'http://test', default: true}
            ]
        });



        const formErrors = ref([]);
        const formInputErrors = ref({});

        const addEmail = () => {
            form.value.emails = [...form.value.emails, {
                email: '',
                default: form.value.emails.length === 0,
            }];
        }
        const addWebsite = () => {
            form.value.websites = [...form.value.websites, {
                website: '',
                default: form.value.websites.length === 0,
            }];
        }

        const dropEmailAt = (at) => {
            let emails = [...form.value.emails];
            let out = emails.splice(at, 1);
            if (out[0].default) {
                emails[0].default = true;
            }
            form.value.emails = emails;
        }

        const dropWebsiteAt = (at) => {
            let websites = [...form.value.websites];
            let out = websites.splice(at, 1);
            if (out[0].default) {
                websites[0].default = true;
            }
            form.value.websites = websites;
        }

        const changeDefWebsite = (at) => {
            let websites = [...form.value.websites].map((i) => {
                i.default = false;
                return i;
            });
            websites[at].default = true;
            form.value.websites = websites;
        }

        const changeDefEmail = (at) => {
            let emails = [...form.value.emails].map((i) => {
                i.default = false;
                return i;
            });
            emails[at].default = true;
            form.value.emails = emails;
        }

        const handleSubmit = () => {
            if(submitting.value) { return ;}
            submitting.value = true;
            return props.customerId ? handleUpdateSubmit() : handleAddSubmit();


        }

        const handleAddSubmit = () => {
            return new Promise((res,rej)=>{
                CustomersService.add(form.value).then(response=>{
                    submitting.value = false;
                    if(!response.success) {
                        formErrors.value = response.data.map(i=>$t(i));
                        res();
                    }else{
                        console.log(response);
                        res();
                        close();
                    }
                }).catch(err=>{
                    submitting.value = false;
                    formInputErrors.value = {};
                    for(let [key,error] of Object.entries(err.response.data.errors)) {
                        formInputErrors.value[key] = [];
                        for(let errSelf of error) {
                            formInputErrors.value[key].push($t(errSelf));
                        }
                    }

                    res();
                });
            });
        }

        const handleUpdateSubmit = () => {
            return new Promise((res,rej)=>{
                CustomersService.update(props.customerId,form.value).then(response=>{
                    submitting.value = false;
                    if(!response.success) {
                        formErrors.value = response.data.map(i=>$t(i));
                        res();
                    }else{
                        console.log(response);
                        res();
                        close();
                    }
                }).catch(err=>{
                    submitting.value = false;
                    formInputErrors.value = {};
                    for(let [key,error] of Object.entries(err.response.data.errors)) {
                        formInputErrors.value[key] = [];
                        for(let errSelf of error) {
                            formInputErrors.value[key].push($t(errSelf));
                        }
                    }
                    res();
                });
            });
        }


        const close = () => {
            reset('customerForm');
            emit('close');
        }

        watch(props, ()=>{
            if(props.model) {
                form.value = props.model;
            }
        });

        return {
            close,
            form,
            countries,
            addEmail,
            addWebsite,
            dropEmailAt,
            dropWebsiteAt,
            changeDefWebsite,
            changeDefEmail,
            customerFormRef,
            handleSubmit,
            submitForm,
            submitting,
            formErrors,
            formInputErrors
        };
    }
}
</script>

<style scoped>

</style>
