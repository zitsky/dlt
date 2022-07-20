<template>

</template>

<script>

import {onMounted, ref} from "vue";

export default {
    name: "UsersListTable",
    setup() {
        const data = ref(null);
        const loading = ref(true);

        function fetchData() {
            loading.value = true;
            return fetch('/api/users')
                .then(res=>{
                    return res.json();
                })
                .then(json=>{
                    data.value = json;
                    loading.value = false;
                }).catch(e=>{
                    this.$toast.show('TEST');
                });
        }

        onMounted(()=>{
            fetchData();
        });
        return {
            data,loading
        }
    }
}
</script>

<style scoped>

</style>
