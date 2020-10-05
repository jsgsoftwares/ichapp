<template>
  <div>
    <section id="intro" class="clearfix card_intro">
      <div class="container">
        <div class="intro-img">
          <img src="voixbotweb/img/introimag.png" alt="" class="img-fluid" />
        </div>

        <div class="intro-info">
          <h3>
            Empoderamos a nuestros clientes,
            <span>para crear experiencias únicas</span><br />a través de la
            tecnología.
          </h3>
          <div>
            <!-- <a href="#about" class="btn-get-started scrollto">Quienes somos</a> -->
            <a href="#services" class="btn-services scrollto"
              >Nuestro servicios</a
            >
          </div>
        </div>
      </div>
    </section>
    <!-- #intro -->
  </div>
  <!-- #intro -->
</template>
<style>
.card_intro {
  margin: 0px;
  height: calc(100vh - 0px);
}
</style>
<script>
export default {
  mounted() {
    const el = document.querySelector(".card_intro");
    el.height = $(window).innerHeight();
  },
};
</script>
