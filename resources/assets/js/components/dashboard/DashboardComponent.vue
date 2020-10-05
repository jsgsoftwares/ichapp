<template>
  <div>
    <dashboardnav_component />

    <dashmenumain_component />

    <keep-alive>
      <component v-bind:is="currentView"> </component>
    </keep-alive>

    <dashboardfooter_component />
  </div>
</template>

<script>
export default {
  props: {
    user_id: Number,
    url_app: String,
  },
  data() {
    return {};
  },
  components: {
    inicio: {
      template: "<dashinicio_component/>",
    },
    soporte: {
      template: "<dashsoporte_component/>",
    },
    integracion: {
      template: "<dashintegracion_component/>",
    },
    usuarios: {
      template: "<dashusuarios_component/>",
    },
    upgrade: {
      template: "<dashupgrade_component/>",
    },
    change: {
      template: "<dashchange_component/>",
    },
    doc: {
      template: "<dashdoc_component/>",
    },
    integraTelegram: {
      template: "<integraTelegram/>",
    },
    integraFacebook: {
      template: "<integraFacebook/>",
    },
    aidialogflow: {
      template: "<AIDialogflow/>",
    },
  },
  mounted() {
    this.$store.dispatch("setpaginas", "inicio");
    this.$store.dispatch("getIntegraciones");
    this.$store.commit("setUser", this.user_id);
    this.$store.dispatch("getUserCompanie_dash", this.$store.state.user_id);
    this.$store.dispatch("getCompanie_dash", this.$store.state.user_id);
    this.$store.dispatch("getRols_dash");
    this.$store.commit("setUrl", this.url_app);
    this.$store.dispatch("PostIntegraciones", this.user_id);
  },
  computed: {
    currentView() {
      //console.log("estado", this.$store.state.paginascontent);
      return this.$store.state.paginascontent;
    },
  },
};
</script>
