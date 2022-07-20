<template>
    <div ref="container">
        <Chart
            :size="{ width: containerWidth, height: 360 }"
            :data="data ?? []"
        >
            <template #layers>
                <Grid strokeDasharray="2,2" />
                <Line :dataKeys="['key', 'val']" />
            </template>
        </Chart>
    </div>
</template>

<script>
import { Chart, Grid, Line } from 'vue3-charts'
import {ref} from "vue";
export default {
    name: "DashboardUsersChart",
    components: { Chart, Grid, Line },
    props:['data'],
    mounted() {
        this.containerWidth = this.$refs.container.clientWidth;
    },
    setup() {
        const containerWidth = ref(100);
        return { containerWidth};
    }
}
</script>

<style scoped>

</style>
