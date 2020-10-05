<template>
  <div>
    <section class="pricing py-5 card_price" id="price">
      <div class="container">
        <header class="section-header">
          <br />
          <h3>Prices</h3>
          <p>
            La plataforma muticanal que simplifica y automatiza todo el servicio
            de atención al cliente y mejorar su experiencia de usuario.
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
                  $120<span class="period">/Mes</span>
                </h6>
                <hr />
                <ul class="fa-ul">
                  <li>
                    <span class="fa-li"></span><strong>2 Usuarios</strong>
                  </li>
                  <li><span class="fa-li"></span>3 Canales de la lista</li>
                  <ul>
                    <li class="text-muted">
                      <span class="fa-li"></span>Facebook Messenger
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Telegram
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Live chat
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Live chat
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Twitter
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Instagram
                    </li>
                  </ul>
                  <li>
                    <span class="fa-li"></span>**No incluido whatsapp**<br />
                    Este tiene un costo por linea de 100$ aplica costo por
                    mensaje
                  </li>
                  <li>
                    Mensajes Ilimitados( No aplica para whatsapp) Reportes
                    Basicos
                  </li>
                </ul>
                <a href="#" class="btn btn-block btn-primary text-uppercase"
                  >Contactenos</a
                >
              </div>
            </div>
          </div>
          <!-- Plus Tier -->
          <div class="col-lg-4">
            <div class="card mb-5 mb-lg-0">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">
                  Estandar
                </h5>
                <h6 class="card-price text-center">
                  $250<span class="period">/Mes</span>
                </h6>
                <hr />
                <ul class="fa-ul">
                  <li>
                    <span class="fa-li"></span><strong>5 Usuarios</strong>
                  </li>
                  <li><span class="fa-li"></span>4 Canales de la lista</li>
                  <ul>
                    <li class="text-muted">
                      <span class="fa-li"></span>Facebook Messenger
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Telegram
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Live chat
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Live chat
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Twitter
                    </li>
                    <li class="text-muted">
                      <span class="fa-li"></span>Instagram
                    </li>
                  </ul>
                  <li>
                    <span class="fa-li"></span>**No incluido whatsapp**<br />
                    Este tiene un costo por linea de 100$ aplica costo por
                    mensaje
                  </li>
                  <li>
                    Mensajes Ilimitados( No aplica para whatsapp) Reportes
                    Basicos
                  </li>
                </ul>
                <a href="#" class="btn btn-block btn-primary text-uppercase"
                  >Contactenos</a
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
                    Profesional
                  </h5>
                  <h6 class="card-price text-center">
                    $400<span class="period">/Mes</span>
                  </h6>
                  <hr />
                  <ul class="fa-ul">
                    <li>
                      <span class="fa-li"></span><strong>10 Usuarios</strong>
                    </li>
                    <li><span class="fa-li"></span>5 Canales de la lista</li>
                    <ul>
                      <li class="text-muted">
                        <span class="fa-li"></span>Facebook Messenger
                      </li>
                      <li class="text-muted">
                        <span class="fa-li"></span>Telegram
                      </li>
                      <li class="text-muted">
                        <span class="fa-li"></span>Live chat
                      </li>
                      <li class="text-muted">
                        <span class="fa-li"></span>Live chat
                      </li>
                      <li class="text-muted">
                        <span class="fa-li"></span>Twitter
                      </li>
                      <li class="text-muted">
                        <span class="fa-li"></span>Instagram
                      </li>
                    </ul>
                    <li>
                      <span class="fa-li"></span>**No incluido whatsapp**<br />
                      Este tiene un costo por linea de 100$ aplica costo por
                      mensaje
                    </li>
                    <li>
                      Mensajes Ilimitados( No aplica para whatsapp) Reportes
                      Basicos
                    </li>
                  </ul>
                  <a href="#" class="btn btn-block btn-primary text-uppercase"
                    >Contactenos</a
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
