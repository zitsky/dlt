import axios from "axios";
import {useToast} from "vue-toastification";
const toast = useToast();
import {$t} from '../locale';

const CustomersService = {
    url: '/api/customers',
    async list(page = 1) {
        return  await axios.get(this.url,{params:{page}}).then(r=>r.data).then(r=>{
            return r;
        });
    },

    async add(model) {
        return await axios.post(this.url,model).then(r=>r.data).then(res=>{
            if(res.success) {
                toast.success($t('defaults.success_create'));
            }
            return res;
        });
    },

    async update(id, model) {
        return await axios.post(`${this.url}/${id}`,model).then(r=>r.data).then(res=>{
            if(res.success) {
                toast.success($t('defaults.success_update'));
            }
            return res;
        });
    },

    async remove(id) {
        return await axios.delete(`${this.url}/${id}`).then(r=>r.data).then(res=>{
            if(res.success) {
                toast.success($t('defaults.success_delete'));
            }
            return res;
        });
    },

    async show(id) {
        return await axios.get(`${this.url}/${id}`).then(r=>r.data).then(res=>{
            return res;
        });
    }
};


export default CustomersService;
