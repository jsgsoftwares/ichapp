<template>
  <div>
    <section id="services" class="section-bg card_producto">
      <div class="container">
        <header class="section-header">
          <br />
          <h3 style="color: #fff;">Product</h3>
          <p style="color: #fff;">
            The multi-channel platform that simplifies and automates the entire service
            customer service and improve your user experience.
          </p>
        </header>
        <b-container class="bv-example-row">
          <b-row>
            <b-col>
              <div class="box">
                <div class="icon">
                  <b-img
                    src="ichapp/img/inteligencia_onmicanal.png"
                    width="80%"
                    height="80%"
                  />
                </div>
                <h5 class="title" style="color:#5f62a9">
                  Intelligent and multi-channel service
                </h5>
                <p class="description" >
                  
                  Single service front with a Virtual agent routing the
                  messages according to the availability of
                  agents, contact history and quick responses. Talk to
                  your customers on the main channel that use ichapp have
                  direct connection to APIs
                  WhatsApp, Telegram, Facebook, Twitter and Instagram for sending to
                  through verified accounts. Potentiate your relationships with
                  customers through their favorite channel.
                </p>
              </div>

            </b-col>
            <b-col>
              <div>
                <div class="intro-img">
                  <img src="ichapp/img/voix.png" alt class="img-fluid" />
                </div>

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
