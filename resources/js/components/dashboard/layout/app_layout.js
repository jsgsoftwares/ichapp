import Vue from "vue";

Vue.component("dashboarmenu_component", require("./DashboardMenuComponent").default);
Vue.component("dashboardbox_component", require("./DashboardBoxComponent").default);
Vue.component("dashboardgraph_component", require("./DashboardGraphComponent").default);
Vue.component(
    "dashboardfooter_component",
    require("./DashboardFooterComponent").default
);
Vue.component(
    "dashboardmensajesrecibidos_component",
    require("./DashboardMensajesRecibidosComponent").default
);
Vue.component("dashboardmapa_component", require("./DashboardMapaComponent").default);
Vue.component(
    "dashboardgrafico_component",
    require("./DashboardGraficoComponent").default
);
Vue.component(
    "dashboardtipo_component",
    require("./DashboardTipoConsultasComponent").default
);
Vue.component("dashboardnav_component", require("./DashboardNavComponent").default);
Vue.component("dashboardrangetime_component", require("./DashboardDaterange").default);
Vue.component(
    "dashlanguage_component",
    require("./DashboardLanguageComponent").default
);
Vue.component(
    "dashmenumain_component",
    require("./DashboardMenuMasterComponent").default
);
export default new Vue({});