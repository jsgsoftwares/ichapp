<template>
  <div>
    <section id="intro" class="clearfix card_intro">
      <div class="container">
        <div class="intro-img">
          <img src="ichapp/img/introimag.png"  class="img-fluid" />
        </div>

        <div class="intro-info" >
          <h3 >
           
            We Empower our clients,
            to create unique experiences through
            technology.
          </h3>
   

   
          <hr/>
          <div>
            <h3 >Connect all your favorite messaging channels</h3>
          
            <h5 style="color: #fff;">Invite your team and support your clients in</h5> 
            <ul style="color: #fff;">
              <li> WhatsApp</li>
              <li>Facebook Messenger</li>
              <li>Telegram</li>
              <li>DialogFlow</li>
            </ul>
               <!--  desde una única 
              solución integrada -->
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
