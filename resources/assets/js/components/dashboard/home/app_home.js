import Vue from "vue";

Vue.component(
  "dashinicio_component",
  require("./DashboardContentInicioComponent")
);
Vue.component(
  "dashiniciolineauno_component",
  require("./DashboardContentInicioLineaUnoComponent")
);
Vue.component(
  "dashiniciolineados_component",
  require("./DashboardContentInicioLineaDosComponent")
);
Vue.component(
  "dashiniciolineatres_component",
  require("./DashboardContentInicioLineaTresComponent")
);
Vue.component(
  "dashiniciolineacuatro_component",
  require("./DashboardContentInicioLineaCuatroComponent")
);
export default new Vue({});
