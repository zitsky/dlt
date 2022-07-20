<template>
    <button :class="classForButton" :disabled="disabled"><slot></slot></button>
</template>

<script>
export default {
    name: "FineButton",
    props: ['type','disabled'],
    computed:{
        classForButton: (props)=>{
            let base = 'font-medium rounded-lg text-sm px-5 py-2.5 text-center ';
            switch (props.type) {
                case "primary":
                    base+="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300";
                    break;
                case "danger":
                    base+="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300";
                    break;
                default:
                    base+="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300";
                    break;
            }
            return base;
        }
    }

}
</script>

<style scoped>

</style>
