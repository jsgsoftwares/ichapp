import Vue from "vue";
Vue.component("home_component", require("./ExtHomeComponent"));
Vue.component("intro_component", require("./ExtintoComponent"));
Vue.component("service_component", require("./ExtserviceComponent"));
Vue.component("canales_component", require("./ExtcanalesComponent"));
Vue.component("price_component", require("./ExtPriceComponent"));
Vue.component("contactenos_component", require("./extContactenosComponent"));
Vue.component("private_component", require("./ExtprivateComponent"));

export default new Vue({});