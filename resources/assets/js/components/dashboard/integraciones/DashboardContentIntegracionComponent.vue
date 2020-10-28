<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">Integrations</h2>
            </div>
          </div>
        </div>
        <div
          class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none"
        ></div>
      </div>
      <div class="content-body">
        <!-- Basic example and Profile cards section start -->
        <section id="basic-examples">
          <div class="row match-height">
            <dashintegracioncanal_component
              v-for="integra in integraciones"
              :key="integra.id"
              :id="integra.id"
              :name="integra.name"
              :canal="integra.canal_id"
              :description="integra.description"
              :avatar="integra.avatar"

            />
          </div>
        </section>
        <!-- // Basic example and Profile cards section end -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      gray:'filter: grayscale(1)',
      state: {},
    };
  },
  mounted() {

  },
  methods:{
 
 },
  computed: {
    integraciones() {
      
      return this.$store.state.integraciones;
    },

  },
  methods: {
    selectCanal(integracion) {
      alert(integracion.name);
    },
  },
};
</script>