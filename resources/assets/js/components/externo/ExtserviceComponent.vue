<template>
  <div>
    <section id="services" class="section-bg card_producto">
      <div class="container">
        <header class="section-header">
          <br />
          <h3>Producto</h3>
          <p>
            La plataforma muticanal que simplifica y automatiza todo el servicio
            de atención al cliente y mejorar su experiencia de usuario.
          </p>
        </header>
        <b-container class="bv-example-row">
          <b-row>
            <b-col>
              <div class="box">
                <div class="icon">
                  <b-img
                    src="voixbotweb/img/inteligencia_onmicanal.png"
                    width="80px"
                    height="80px"
                  />
                </div>
                <h5 class="title">
                  <a href>Servicio inteligente y multicanal</a>
                </h5>
                <p class="description">
                  Único frente de atención con un agente Virtual enrutando los
                  mensajes de acuerdo a la disponibilidad de los
                  agentes,historial de contactos y Respuestas rápidas. Habla con
                  tus clientes en el canal principal que utilizan VoixBot tiene
                  conexión directa con las APIs de
                  WhatsApp,Telegram,Facebook,Twitter e Instagram para envíos a
                  través de cuentas verificadas. Potencializa tus relaciones con
                  los clientes mediante su canal favorito.
                </p>
              </div>
              <!--   <div class="box">
              <div class="icon"><i class="ion-ios-bookmarks-outline" style="color: #e9bf06;"></i></div>
              <h4 class="title"><a href="">Dolor Sitema</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
              -->
            </b-col>
            <b-col>
              <div>
                <div class="intro-img">
                  <img src="voixbotweb/img/voix.png" alt class="img-fluid" />
                </div>
                <!--     <b-embed
          type="iframe"
          aspect="16by9"
          src="https://www.youtube.com/embed/yT58gTXdQb8?rel=0"
          allowfullscreen
                ></b-embed>-->
              </div>
            </b-col>
          </b-row>
        </b-container>
      </div>
    </section>
    <!-- #services -->
  </div>
  <!-- #intro -->
</template>
<style>
.card_producto {
  margin: 0px;
  height: calc(100vh - 0px);
}
</style>
<script>
export default {
  mounted() {
    console.log("Component service.");
  },
};
</script>
