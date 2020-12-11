import Vue from "vue";
Vue.component(
    "dashusuarios_component",
    require("./DashboardContentUsuariosComponent").default
);
Vue.component(
    "dashusuariostabla_component",
    require("./DashboardContentUsuarioTableComponent").default
);
Vue.component(
    "dashusuariostablaedit_component",
    require("./DashboardContentUsuarioTableEditarComponent").default
);
export default new Vue({});