import Vue from "vue";

Vue.component("dashboarmenu_component", require("./DashboardMenuComponent"));
Vue.component("dashboardbox_component", require("./DashboardBoxComponent"));
Vue.component("dashboardgraph_component", require("./DashboardGraphComponent"));
Vue.component(
  "dashboardfooter_component",
  require("./DashboardFooterComponent")
);
Vue.component(
  "dashboardmensajesrecibidos_component",
  require("./DashboardMensajesRecibidosComponent")
);
Vue.component("dashboardmapa_component", require("./DashboardMapaComponent"));
Vue.component(
  "dashboardgrafico_component",
  require("./DashboardGraficoComponent")
);
Vue.component(
  "dashboardtipo_component",
  require("./DashboardTipoConsultasComponent")
);
Vue.component("dashboardnav_component", require("./DashboardNavComponent"));
Vue.component("dashboardrangetime_component", require("./DashboardDaterange"));
Vue.component(
  "dashlanguage_component",
  require("./DashboardLanguageComponent")
);
Vue.component(
  "dashmenumain_component",
  require("./DashboardMenuMasterComponent")
);
export default new Vue({});
