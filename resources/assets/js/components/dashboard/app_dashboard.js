import Vue from "vue";

Vue.component(
  "dashupgrade_component",
  require("./DashboardContentUpgradeComponent")
);
Vue.component(
  "dashsoporte_component",
  require("./DashboardContentSoporteComponent")
);
Vue.component(
  "dashchange_component",
  require("./DashboardContentChangeComponent")
);
Vue.component("dashdoc_component", require("./DashboardContentDocComponent"));

export default new Vue({});
