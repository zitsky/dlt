import axios from 'axios';

import { useToast } from 'vue-toastification'
const toast = useToast();

const DashboardService = {
    async getPayments(from,to,slice) {
        const resp = await axios.get("/api/dashboard/payments",{params:{from,to,slice}}).catch((err)=>{
            toast.error(err);
        });
        return resp.data;
    },
    async getCustomers(from,to,slice) {
        const resp = await axios.get("/api/dashboard/customers",{params:{from,to,slice}}).catch((err)=>{
            toast.error(err);
        });
        return resp.data;
    }
}

export default DashboardService;
