import Vue from "vue";
Vue.component(
  "dashusuarios_component",
  require("./DashboardContentUsuariosComponent")
);
Vue.component(
  "dashusuariostabla_component",
  require("./DashboardContentUsuarioTableComponent")
);
export default new Vue({});
