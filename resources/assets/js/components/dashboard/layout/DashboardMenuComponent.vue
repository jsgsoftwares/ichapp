<template>
  <div class="main-menu-content">
    <ul
      class="navigation navigation-main"
      id="main-menu-navigation"
      data-menu="menu-navigation"
    >
      <li class="nav-item">
        <a @click="inicio()"
          ><i class="feather icon-home"></i
          ><span class="menu-title" data-i18n="Dashboard">Dashboard</span>
        </a>
      </li>
      <li class="navigation-header"><span>Apps</span></li>
      <li class="nav-item">
        <a @click="integracion()"
          ><i class="feather icon-cpu"></i
          ><span class="menu-title" data-i18n="Integrations"
            >Integrations</span
          ></a
        >
      </li>
      <li class="nav-item">
        <a @click="usuarios()"
          ><i class="feather icon-users"></i
          ><span class="menu-title" data-i18n="user">Users</span></a
        >
      </li>
      <li class="nav-item">
        <a @click="upgrade()"
          ><i class="feather icon-arrow-up"></i
          ><span class="menu-title" data-i18n="upgrade">Upgrade plan</span></a
        >
      </li>
      <li class="nav-item">
        <a @click="change()"
          ><i class="feather icon-activity"></i
          ><span class="menu-title" data-i18n="changelog">Changelog</span></a
        >
      </li>

      <li class="navigation-header"><span>Support</span></li>
      <li class="nav-item">
        <a @click="documentation()"
          ><i class="feather icon-folder"></i
          ><span class="menu-title" data-i18n="Documentation"
            >Documentation</span
          ></a
        >
      </li>
      <li class="nav-item">
        <a @click="soporte()"
          ><i class="feather icon-life-buoy"></i
          ><span class="menu-title" data-i18n="Support">Support</span></a
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  methods: {
    inicio() {
      this.$store.dispatch("setpaginas", "inicio");
    },
    integracion() {
      this.$store.dispatch("setpaginas", "integracion");
    },
    usuarios() {
      this.$store.dispatch("setpaginas", "usuarios");
    },
    upgrade() {
      this.$store.dispatch("setpaginas", "upgrade");
    },
    change() {
      this.$store.dispatch("setpaginas", "change");
    },
    soporte() {
      this.$store.dispatch("setpaginas", "soporte");
    },
    documentation() {
      this.$store.dispatch("setpaginas", "doc");
    },
  },
};
</script>