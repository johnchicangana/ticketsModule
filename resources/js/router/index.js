import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/HomePage.vue";
import Tickets from "../components/Tickets/index.vue";
import TicketCreate from "../components/Tickets/Create.vue";
import TicketUpdate from "../components/Tickets/Update.vue";
import Notfound from "../components/NotFoundPage.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/tickets",
        name: "tickets",
        component: Tickets,        
    },
    {
        path: "/tickets/create",
        name: "tickets.create",
        component: TicketCreate,
    },
    {
        path: "/tickets/update/:id",
        name: "tickets.update",
        component: TicketUpdate,
    },
    {
        path: "/:pathMatch(.*)*",
        component: Notfound,
    }
];

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: "active",
    routes,
});

export default router;