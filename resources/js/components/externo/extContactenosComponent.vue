<template>
  <div>
    <section id="contact" class="card_contact" style="background-color:#fff">
      <div class="container-fluid">
        <div class="section-header">
          <h3 style="color:#5f62a9">Contactenos</h3>
        </div>

        <div class="row wow fadeInUp">
          <div class="col-lg-6">
            <div class="map mb-4 mb-lg-0">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m17!1m8!1m3!1d15761.946109481816!2d-79.48894127259597!3d9.019303919967061!3m2!1i1024!2i768!4f13.1!4m6!3e0!4m0!4m3!3m2!1d9.018276!2d-79.485738!5e0!3m2!1sen!2sus!4v1581132388903!5m2!1sen!2sus"
                frameborder="0"
                style="border:0; width: 100%; height: 312px;"
                allowfullscreen
              ></iframe>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-5 info">
                <i class="ion-ios-location-outline"></i>
                <p style="color:#5f62a9">Panama,Parque lefevre</p>
              </div>
              <div class="col-md-4 info">
                <i class="ion-ios-email-outline"></i>
                <p style="color:#5f62a9">sales@ichapp.com</p>
              </div>
              <div class="col-md-3 info">
                <i class="ion-ios-telephone-outline"></i>
                <p style="color:#5f62a9">+50766261843</p>
              </div>
            </div>

            <div class="form">
              <div id="sendmessage" style="color:#5f62a9">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <!-- form -->
              <form
                class="contact-form"
                @submit.prevent="sendEmail"
                action=""
                method=""
              >
                <div class="form-row">
                  <div class="form-group col-lg-6">
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      id="name"
                      placeholder="Your Name"
                      data-rule="minlen:4"
                      data-msg="Please enter at least 4 chars"
                    />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group col-lg-6">
                    <input
                      type="email"
                      class="form-control"
                      name="email"
                      id="email"
                      placeholder="Your Email"
                      data-rule="email"
                      data-msg="Please enter a valid email"
                    />
                    <div class="validation"></div>
                  </div>
                </div>
                <div class="form-group">
                  <input
                    type="text"
                    class="form-control"
                    name="subject"
                    id="subject"
                    placeholder="Subject"
                    data-rule="minlen:4"
                    data-msg="Please enter at least 8 chars of subject"
                  />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea
                    class="form-control"
                    name="message"
                    rows="5"
                    data-rule="required"
                    data-msg="Please write something for us"
                    placeholder="Message"
                  ></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center">
                  <input class="btn btn-success" type="submit" variant="success" value="Send Message" />
                </div>
              </form>
              <!-- fomr -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- #contact -->
  </div>
  <!-- #intro -->
</template>
<style>
.card_contact {
  margin: 0px;
  height: calc(100vh - 0px);
}
</style>
<script>
import emailjs from "emailjs-com";
(function() {
  emailjs.init("user_SySmb1tctR0YhyLzSnJVS");
})();
export default {
  data() {
    return {
      name: "",
      email: "",
      message: "",
      subject: "",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    enviar() {
      /*     let data= {
                                service_id: 'gmail',
                                template_id: 'jjj',
                                user_id: 'jsgsoftwares',
                                template_params: {
                                    'username': 'jsgsoftwares',
                                    'g-recaptcha-response': '03AHJ_ASjnLA214KSNKFJAK12sfKASfehbmfd...'
                                }
                            };

                            axios.post('https://api.emailjs.com/api/v1.0/email/send',data)
                            .then((response)=> {
                               alert('respo',response);
                            
                            })
                            .catch(error => {
                                console.log(error.response)
                            }); */
      let data = {
        from_name: this.name,
        from_email: this.email,
        message: this.message,
        subject: this.subject,
      };

      emailjs.send("gmail", "template_Ie2teebt", data).then(
        function(response) {
          if (response.text === "OK") {
            alert("El correo se ha enviado de forma exitosa");
          }
          console.log(
            "SUCCESS. status=%d, text=%s",
            response.status,
            response.text
          );
        },
        function(err) {
          alert("Ocurrió un problema al enviar el correo");
          console.log("FAILED. error=", err);
        }
      );
    },
    sendEmail: (e) => {
      emailjs
        .sendForm(
          "gmail",
          "template_Ie2teebt",
          e.target,
          "user_SySmb1tctR0YhyLzSnJVS"
        )
        .then(
          (result) => {
            alert("El correo se ha enviado de forma exitosa");
            //console.log('SUCCESS!', result.status, result.text);
            e.target.reset();
          },
          (error) => {
            console.log("FAILED...", error);
          }
        );
    },
  },
};
</script>
