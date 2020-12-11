import Vue from "vue";

Vue.component("home_component", require("./ExtHomeComponent").default);
Vue.component("intro_component", require("./ExtintoComponent").default);
Vue.component("service_component", require("./ExtserviceComponent").default);
Vue.component("canales_component", require("./ExtcanalesComponent").default);
Vue.component("price_component", require("./ExtPriceComponent").default);
Vue.component("contactenos_component", require("./extContactenosComponent").default);
Vue.component("private_component", require("./ExtprivateComponent").default);

export default new Vue({});