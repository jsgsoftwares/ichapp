import Vue from "vue";

Vue.component("integraTelegram", require("./telegramComponent.vue").default);
Vue.component("integraFacebook", require("./facebookComponent.vue").default);
Vue.component("integraWaping", require("./wapingComponent.vue").default);
Vue.component(
    "dashintegracion_component",
    require("./DashboardContentIntegracionComponent").default
);
Vue.component(
    "dashintegracioncanal_component",
    require("./DashboardContentIntegracionCanalComponent").default
);
Vue.component("AIDialogflow", require("./dialogflowComponent.vue").default);

export default new Vue({});