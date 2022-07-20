import Dashboard from "./views/Dashboard";
import Users from "./views/Users";
import Payments from "./views/Payments";

const routes = [
    {path: '/', name: 'Dashboard', component: Dashboard},
    {path: '/users', name: 'Users', component: Users},
    {path: '/payments', name: 'Payments', component: Payments},
];

export default routes;
