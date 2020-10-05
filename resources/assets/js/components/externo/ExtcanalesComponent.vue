<template>
  <div>
    <section id="team" class="card_canales">
      <div class="container">
        <div class="section-header">
          <br />
          <h3>Canales de atencion</h3>
          <p></p>
        </div>
        <b-container class="bv-example-row">
          <b-row>
            <b-col></b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="voixbotweb/img/whatsapp.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Whatsapp</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="voixbotweb/img/instagram.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Instagram</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="voixbotweb/img/facebook.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Facebook</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="voixbotweb/img/telegram.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Telegram</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="voixbotweb/img/twitter.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4>Twitter</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col></b-col>
          </b-row>
        </b-container>
        <div class="section-footer">
          <h3></h3>
          <br />
          <br />
          <p class="w-95">
            Creemos que las empresas deben ofrecer experiencias valiosas a sus
            clientes con el canal que prefieran y de la forma que más les guste.
            Por eso, la plataforma de servicio al cliente de Voixbot te permite
            interactuar con los clientes a través de
            WhatsApp,Telegram,Instagram,Messenger,Twitter, Live chat o cualquier
            otro canal que pueda imaginar, todo en un sólo lugar. Además,
            nuestra plataforma concentra toda la historia de la conversación con
            tu cliente, independientemente del canal que utilice, garantizando
            una comunicación fluida, personalizada y eficiente.
          </p>
        </div>
      </div>
    </section>
    <!-- #team -->
  </div>
  <!-- #intro -->
</template>
<style>
.card_canales {
  margin: 0px;
  height: calc(100vh - 0px);
}
</style>
<script>
export default {
  data() {
    return {
      mainProps: {
        blank: true,
        blankColor: "#777",
        width: 75,
        height: 75,
        class: "m1",
      },
    };
  },

  mounted() {
    console.log("Component about.");
  },
};
</script>
