import axios from "axios";

const PaymentsService = {
    url: '/api/payments',
    async list(page = 1) {
        return  await axios.get(this.url,{params:{page}}).then(r=>r.data);
    },
};

export default PaymentsService;
