<template>
  <div>
    <intro_component
      class="card_style w-100"
      style="height=100%"
    ></intro_component>

    <main id="main">
      <!-- <about_component></about_component> -->
      <service_component class="card_style h-100"></service_component>
      <canales_component class="card_style h-100"></canales_component>
      <price_component class="card_style h-100"></price_component>
      <contactenos_component class="card_style h-100"></contactenos_component>
      <private_component class="card_style h-100"></private_component>
    </main>
  </div>
  <!-- #intro -->
</template>
<style>
.card_style {
  max-height: 100%;
  overflow-y: auto;
}
</style>
<script>
export default {
  mounted() {
    console.log("Component mounted. HOME ");
  },
};
</script>
