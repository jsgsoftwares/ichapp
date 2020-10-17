import Vue from "vue";
Vue.component(
  "dashusuarios_component",
  require("./DashboardContentUsuariosComponent")
);
Vue.component(
  "dashusuariostabla_component",
  require("./DashboardContentUsuarioTableComponent")
);
Vue.component(
  "dashusuariostablaedit_component",
  require("./DashboardContentUsuarioTableEditarComponent")
);
export default new Vue({});
