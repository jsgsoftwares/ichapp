/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import dashboard_store from "./dashboard_store";
import dashboards from "./components/dashboard/app_dashboard.js";
import ai from "./components/dashboard/ai/app_ai.js";
import dashboard_home from "./components/dashboard/home/app_home.js";
import dashboard_users from "./components/dashboard/users/app_users.js";
import dashboard_layout from "./components/dashboard/layout/app_layout.js";
import chats from "./components/chat/app_chat.js";
import externos from "./components/externo/app_externo.js";
import integraciones from "./components/dashboard/integraciones/app_integra.js";


import layoutchat_Component from "./components/chat/layoutChatComponent";
import messenger_Component from "./components/chat/MessengerComponent";
import example_component from "./components/ExampleComponent.vue";
import dashboard_component from "./components/dashboard/DashboardComponent.vue";


import multiselect from 'vue-multiselect'
import Vue from "vue";
import qs from 'qs';
import store from "./store.js"
import VueRouter from "vue-router";
import BootstrapVue from "bootstrap-vue";
import VueGoogleCharts from "vue-google-charts";
import VueClipboard from "vue-clipboard2";
import LoadScript from 'vue-plugin-load-script';
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import VueSpinners from 'vue-spinners';
import Overlay from 'vuejs-overlay';
Vue.use(qs);
Vue.use(LoadScript);
Vue.use(VueSpinners)
Vue.use(VueClipboard);
Vue.use(multiselect);
Vue.use(VueGoogleCharts);
Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(Overlay);
Vue.component("spinner", require("./components/spinner"));
const routes = [

    { path: "/chat", component: messenger_Component },
    { path: "/dashboard", component: dashboard_component },
    { path: "/chat/:conversationId", name: 'chatid', component: messenger_Component },

];

const router = new VueRouter({
    routes,
    mode: "history",
});
const app = new Vue({
    el: "#app",
    store,
    dashboard_store,
    integraciones,
    dashboards,
    chats,
    externos,
    dashboard_home,
    dashboard_users,
    dashboard_layout,
    ai,
    router,
    methods: {
        logout() {
            document.getElementById("logout-form").submit();
        },
    },
});