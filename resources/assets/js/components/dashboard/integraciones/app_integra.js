import Vue from "vue";

Vue.component("integraTelegram", require("./telegramComponent.vue"));
Vue.component("integraFacebook", require("./facebookComponent.vue"));
Vue.component(
  "dashintegracion_component",
  require("./DashboardContentIntegracionComponent")
);
Vue.component(
  "dashintegracioncanal_component",
  require("./DashboardContentIntegracionCanalComponent")
);
export default new Vue({});
