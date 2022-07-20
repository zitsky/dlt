import axios from "axios";

const CountriesService = {
    all() {
        return axios.get("/api/countries").then(r=>r.data.data);
    }
}

export default CountriesService;
