import VueRouter from "vue-router";
import Vue from 'vue';
import LeadList from "../components/LeadList.vue";
import History from "../components/History.vue";
import LinkContact from '../components/LinkContact.vue';

Vue.use(VueRouter);

const routes = [
    { path: '/leads', name: 'leads-list', component: LeadList },
    { path: '/history', name: 'change-history', component: History },
    { path: '/lead/:id', component: LinkContact, name: 'ContactBinding' },
    { path: '*', redirect: '/leads' },
];
const router = new VueRouter({
    mode: 'history',
    routes,
});

export default router