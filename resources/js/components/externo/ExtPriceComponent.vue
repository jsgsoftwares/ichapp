<template>
  <div>
    <section class="pricing  " id="price" style="background-color:#5f62a9">
      <div class="container">
        <header class="section-header">
          <br />
          <br />
          <br />
          <h3 style="color:#fff">Prices</h3>
          <p style="color:#fff">
           
            The multi-channel platform that simplifies and automates the entire service
            customer service and improve your user experience.
          </p>
        </header>
        <div class="row">
          <!-- Free Tier -->
          <div class="col-lg-4">
            <div class="card mb-5 mb-lg-0">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">
                  Basico
                </h5>
                <h6 class="card-price text-center">
                  free<span class="period"></span>
                </h6>
                <hr />
                <ul class="fa-ul">
                  <li>
                    <span class="fa-li"></span><strong>2 Users</strong>
                  </li>
                  <li><span class="fa-li"></span>2 Channels</li>
                  <ul>
                    <li class="text-muted">
                      <span class="fa" style="color:green;"></span>Facebook Messenger
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Telegram
                    </li>
                    <li class="text-muted" style=" text-decoration:line-through;">
                      <span class="fa-li"></span>DialogFlow
                    </li>
    
                    <li class="text-muted" style=" text-decoration:line-through;" >
                      <span class="fa-li"></span>Whatsapp with waping
                    </li>
      
                  </ul>

                </ul>
                <a href="/register" class="btn btn-block btn-primary text-uppercase"
                  >Register</a
                >
              </div>
            </div>
          </div>
          <!-- Plus Tier -->
          <div class="col-lg-4">
            <div class="card mb-5 mb-lg-0">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">
                  Chat management
                </h5>
                <h6 class="card-price text-center">
                  $15
                  <br/><span style="font-size:13px">per user/<strong>per month </strong></span>
                  
                  
                </h6>
                <hr />
                <ul class="fa-ul">
                  <li>
                    <span class="fa-li"></span><strong>Manage the chats of your messaging channels</strong>
                  </li>
                  <li><span class="fa-li"></span>3 Canales</li>
                  <ul>
                    <li class="text-muted">
                      <span class="fa" style="color:green;"></span>Facebook Messenger
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Telegram
                    </li>
                    <li class="text-muted" >
                      <span class="fa-li"></span>Dialogflow
                    </li>
    
                    <li class="text-muted"  >
                      <span class="fa-li"></span>Whatsapp with waping
                       <strong>integration (30$/month)</strong>
                    </li>
          
                  </ul>

                </ul>
                <a href="/register" class="btn btn-block btn-primary text-uppercase"
                  >Register</a
                >
          
              </div>
            </div>
          </div>
          <!-- Pro Tier -->
          <div class="col-lg-4">
            <div class="card">
              <div class="card mb-5 mb-lg-0">
                <div class="card-body">
                  <h5 class="card-title text-muted text-uppercase text-center">
                    Enterprise
                  </h5>
                  <h6 class="card-price text-center">
                    Custom<span class="period"></span>
                  </h6>
                  <hr />
                  <ul class="fa-ul">

                   <li><span class="fa-li"></span>For companies of all sizes</li>
                  <ul>
                    <li class="text-muted">
                      <span class="fa" style="color:green;"></span>Facebook Messenger
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Telegram
                    </li>
                    <li class="text-muted" style=" text-decoration:line-through;">
                      <span class="fa-li"></span>Dialogflow
                    </li>
    
                    <li class="text-muted"  >
                      <span class="fa-li"></span>Whatsapp with waping
                    </li>

                    <li class="text-muted">
                      <span class="fa-li"></span><strong>Dedicated support</strong>
                  </li> 
                  </ul>

                </ul>
                <a href="/#contact" class="btn btn-block btn-primary text-uppercase"
                  >Contact</a
                >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="section-footer">
          <h3></h3>
          <br />
          <br />
          <p>
            Si sus necesidades son mayores a la ofrecida en nuestros planes
            puede comunicarse con nuestro equipo .
          </p>
        </div>
      </div>
    </section>
  </div>
  <!-- #intro -->
</template>
<style>
.card_price {
  margin: 10px;
  height: calc(100vh - 0px);
}
</style>
<script>
export default {
  mounted() {
    console.log("Component prices.");
  },
};
</script>
