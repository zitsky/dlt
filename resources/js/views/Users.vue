<template>
    <div class="flex justify-between mb-4">
        <h4 class="text-xl">{{ $t("users.title") }}</h4>
        <div class="flex">
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center"
                @click="addUser">{{ $t("users.add_user") }}
            </button>
        </div>
    </div>
    <vue-table per="20" :columns="['id','first_name','last_name','country','emails','websites']" :items="usersList"
               :total="usersTotal" prefix="users.table." :current="currentPage" @pageChanged="currentPage = $event">
        <template v-slot:actions="item">
            <button class=" hover:bg-gray-100 hover:ring-gray-200 rounded p-1 text-xs" @click="editUser(item.id)">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </button>
            <button
                class="bg-red-300 ring-1 ring-red-400 hover:bg-red-400 hover:ring-red-500 rounded text-xs text-white p-1 ml-2" @click="destroyUser(item.id)">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </template>
    </vue-table>
    <users-modal :modalActive="addUserModal" @close="closeUserModal" :type="currentUserId ? 'edit' : 'add'" :customer-id="currentUserId" :model="editUserModel"></users-modal>
    <modal :modalActive="activeDestroyModal" @close="activeDestroyModal = false">
        <template v-slot:title>{{ $t("defaults.modal.destroy.title") }}</template>
        <template v-slot:footer>
            <fine-button type="danger" @click="destroyUserReal">{{ $t("defaults.destroy") }}</fine-button>
            <fine-button @click="activeDestroyModal = false">{{ $t("defaults.cancel") }}</fine-button>
        </template>
        <p>
            {{ $t("defaults.modal.destroy.content") }}
        </p>
    </modal>

</template>

<script>
import UsersListTable from "../components/UsersListTable";
import UsersModal from "../components/UsersModal";
import {reactive, ref, watch} from "vue";
import VueTable from "../components/VueTable";
import CustomersService from "../services/customers-service";
import FineButton from "../components/FineButton";
import Modal from "../components/Modal";

export default {
    name: "Users",
    components: {
        VueTable,
        UsersListTable,
        Modal,
        UsersModal,
        FineButton,

    },
    setup() {
        const addUserModal = ref(false);
        const currentPage = ref(1);
        const usersList = ref([]);
        const usersTotal = ref(0);
        const activeDestroyModal = ref(false);
        const currentUserId = ref(null);
        const editUserModel = ref(null);

        const addUser = () => {
            currentUserId.value = null;
            addUserModal.value = true;
        }

        const closeUserModal = () => {
            addUserModal.value = false;
            loadTable();
        }

        const editUser = async (id) => {
            currentUserId.value = id;
            let response = await CustomersService.show(id);
            editUserModel.value = response.data;
            addUserModal.value = true;
        }

        const destroyUser = (id) => {
            activeDestroyModal.value = true;
            currentUserId.value = id;
        }

        const destroyUserReal = async () => {
            activeDestroyModal.value = false;
            await CustomersService.remove(currentUserId.value);
            loadTable();
        }


        async function loadTable() {
            const resp = await CustomersService.list(currentPage.value - 1);
            usersList.value = resp.data;
            usersTotal.value = resp.total;
        }

        watch(currentPage, () => {
            console.log("page changed");
            loadTable();
        });

        loadTable();
        return {
            addUserModal,
            addUser,
            closeUserModal,
            usersList,
            usersTotal,
            currentPage,
            activeDestroyModal,
            editUser,
            destroyUser,
            destroyUserReal,
            currentUserId,
            editUserModel
        };
    }
}
</script>

<style scoped>

</style>
