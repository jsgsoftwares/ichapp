import Vue from "vue";

Vue.component(
    "dashinicio_component",
    require("./DashboardContentInicioComponent").default
);
Vue.component(
    "dashiniciolineauno_component",
    require("./DashboardContentInicioLineaUnoComponent").default
);
Vue.component(
    "dashiniciolineados_component",
    require("./DashboardContentInicioLineaDosComponent").default
);
Vue.component(
    "dashiniciolineatres_component",
    require("./DashboardContentInicioLineaTresComponent").default
);
Vue.component(
    "dashiniciolineacuatro_component",
    require("./DashboardContentInicioLineaCuatroComponent").default
);
export default new Vue({});