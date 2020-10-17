<template>
  <div>
    <section id="team" class="card_canales" style="background-color:#5f62a9">
      <div class="container">
        <div class="section-header">
          <br />
          <h3 style="color:#fff">Integrations</h3>
          <p></p>
        </div>
        <b-container class="bv-example-row" style="color:#fff">
          <b-row>
            <b-col></b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="ichapp/img/whatsapp.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4 style="color:#fff">Whatsapp</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="ichapp/img/instagram.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4 style="color:#fff">Instagram</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="ichapp/img/facebook.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4 style="color:#fff">Facebook</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="ichapp/img/telegram.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4 style="color:#fff">Telegram</h4>
                  </div>
                </div>
              </div>
            </b-col>
            <b-col>
              <div class="member">
                <b-img
                  src="ichapp/img/twitter.png"
                  rounded="circle"
                  alt="Circle image"
                  width="120px"
                  height="120px"
                ></b-img>
                <div class="member-info">
                  <div class="member-info-content">
                    <h4 style="color:#fff">Twitter</h4>
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
          <p class="w-95" style="color:#fff">
            We believe that companies should offer valuable experiences to their
            customers with the channel they prefer and in the way they like the most.
            That is why the IChapp customer service platform allows you to
            interact with customers through
            WhatsApp, Telegram, Instagram, Messenger, Twitter, Live chat or any
            another channel you can imagine, all in one place. Further,
            our platform concentrates the entire history of the conversation with
            your client, regardless of the channel they use, guaranteeing
            a fluid, personalized and efficient communication.
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
