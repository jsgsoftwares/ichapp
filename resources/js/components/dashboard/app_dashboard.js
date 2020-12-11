import Vue from "vue";

Vue.component(
    "dashupgrade_component",
    require("./DashboardContentSubscriptionComponent").default
);
Vue.component(
    "dasheditplan_component",
    require("./DashboardContentUpgradeComponent").default
);

Vue.component(
    "dashsoporte_component",
    require("./DashboardContentSoporteComponent").default
);
Vue.component(
    "dashchange_component",
    require("./DashboardContentChangeComponent").default
);
Vue.component("dashdoc_component", require("./DashboardContentDocComponent").default);

export default new Vue({});