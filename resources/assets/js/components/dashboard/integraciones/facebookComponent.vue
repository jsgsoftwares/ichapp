<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">
                Facebook Messenger
              </h2>
            </div>
          </div>
        </div>
        <div
          class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none"
        ></div>
      </div>
      <div class="content-body">
        <div>
          <b-card-group deck>
            <b-card header-tag="header" footer-tag="footer">
              <template v-slot:header>
                <h6 class="mb-0"><div>An easier way to message.</div></h6>
                <div class="col-1">
                  <b-form-checkbox
                    align="right"
                    v-model="checked"
                    @change="activar_desactivar()"
                    name="check-button"
                    switch
                    >Enabled
                  </b-form-checkbox>
                </div>
              </template>
              <b-card-text>
                <div class="description">
                  <p>
                    Create and teach a conversational bot for Facebook
                    Messenger.
                  </p>
                  <p>
                    After you design and test your Dialogflow agent, you can
                    launch your Messenger bot
                  </p>
                  <ol>
                    <li>
                      Get your Facebook Page Access Token and insert it in the
                      field below.
                    </li>
                    <li>Create your own Verify Token (can be any string).</li>
                    <li>Click 'START' below.</li>
                    <li>
                      Use the Callback URL and Verify Token to create an event
                      in the Facebook Messenger Webhook Setup.
                    </li>
                  </ol>
                  <a
                    href="https://cloud.google.com/dialogflow/docs/integrations/facebook"
                    target="_blank"
                    >More in documentation.</a
                  >
                  <br />
                  <div class="mt-2">
                    <b-input-group prepend="Callback URL" class="mb-2">
                      <b-form-input
                        v-model="facebook_callback"
                        aria-label="Token"
                        :disabled="callback_url_check"
                      ></b-form-input>
                      <b-input-group-append>
                        <b-button
                          v-clipboard:copy="facebook_callback"
                          v-clipboard:success="onCopy"
                          v-clipboard:error="onError"
                          variant="outline-info"
                          >copy</b-button
                        >
                      </b-input-group-append>
                    </b-input-group>
                    <b-input-group prepend="Verify Token" class="mb-2">
                      <b-form-input
                        v-model="verify_input"
                        aria-label="Token"
                        :disabled="input_token"
                      ></b-form-input>
                    </b-input-group>
                    <b-input-group prepend="Page Access Token" class="mb-2">
                      <b-form-input
                        v-model="token_facebook"
                        aria-label="Token"
                        :disabled="input_token"
                      ></b-form-input>
                    </b-input-group>
                  </div>
                </div>
              </b-card-text>

              <template v-slot:footer>
                <div class="col-md-4 col-md-offset-4">
                  <b-button
                    size="sm"
                    :disabled="btn_stop"
                    variant="outline-danger"
                    @click="detener()"
                  >
                    Stop
                  </b-button>
                  <b-button
                    @click="iniciar()"
                    size="sm"
                    :disabled="btn_start"
                    variant="outline-success"
                  >
                    START
                  </b-button>
                  <!-- <button @click="showAlert">Hello worlds</button> -->
                </div>
              </template>
            </b-card>
          </b-card-group>
          <hr class="my-4" />
        </div>
        <div>
          <b-button block variant="primary" @click="back()">Back</b-button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      checked: false,
      verify_input: "",
      token_facebook: "",
      callback_url_check: true,
      facebook_callback: "callback url",
      state: {
        canal: null,
        detener: false,
        stop: false,
        telegrams: [],
        btn_start_b: true,
        btn_stop_b: true,
        input_token_b: true,
      },
    };
  },
  mounted() {
    this.$store
      .dispatch("PostIntegraciones", this.$store.state.user_id)
      .then(() => {
        if (this.facebook == null) {
          this.state.btn_start_b = true;
          this.state.btn_stop_b = true;
          this.state.input_token_b = true;
        } else {
          this.facebook_callback = this.facebook.webhook;
          if (this.facebook.enabled == 1) {
            this.state.btn_stop_b = false;
            this.checked = true;
          } else {
            this.checked = false;
            this.state.btn_start_b = true;
            this.state.btn_stop_b = true;
            this.state.input_token_b = true;
          }
          if (this.facebook.token == null) {
            this.token_facebook = "";
          } else {
            this.verify_input = this.facebook.verify;
            this.token_facebook = this.facebook.token;
          }
        }
      });
  },
  methods: {
    iniciar() {
      let valida = this.token_facebook.trim();

      if (valida.length > 0) {
        if (this.token_facebook.length > 1) {
          this.actualizabase(1, 1, true, true, false);
          this.$swal("Success", "Integration will start..", "success");
        } else {
          this.$swal({
            icon: "error",
            title: "Oops...",
            text: "The token field cannot be empty!",
          });
        }
      } else {
        this.$swal({
          icon: "error",
          title: "Oops...",
          text: "The token field cannot be empty!",
        });
      }
    },
    detener() {
      this.$swal({
        title: "Are you sure?",
        text: "Integration will stop!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Stop!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.actualizabase(1, 0, false, false, true);
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
    back() {
      this.$store
        .dispatch("PostIntegraciones", this.$store.state.user_id)
        .then(() => {
          let valida = this.token_facebook.trim();

          if (valida.length == 0 || this.token_facebook.length == 0) {
            this.checked = false;
            this.actualizabase(0, 0, true, true, true);
          } else if (this.facebook.start == 0) {
            this.checked = false;
            this.actualizabase(0, 0, true, true, true);
          }
          this.$store.dispatch("setpaginas", "integracion");
        });
    },
    activar_desactivar() {
      if (!this.checked) {
        //prender
        if (this.telegram == null) {
          this.actualizabase(1, 0, false, false, true);
        } else {
          this.actualizabase(1, 0, false, false, true);
        }
        this.checked = true;
      } else {
        //apagar
        this.checked = false;
        this.actualizabase(0, 0, true, true, true);
      }
    },
    onCopy: function(e) {
      this.$swal("Success", "copied", "success");
    },
    onError: function(e) {
      this.$swal("Stop", "Error copied", "warning");
    },
    actualizabase(enable, start, input, btn_start, btn_stop) {
      const params = {
        user_id: this.$store.state.user_id,
        token: this.token_facebook,
        verify: this.verify_input,
        enabled: enable,
        start: start,
      };
      this.state.btn_start_b = btn_start;
      this.state.btn_stop_b = btn_stop;
      this.state.input_token_b = input;

      this.$store.dispatch("PostUpdateFacebook", params).then(() => {
        this.$store
          .dispatch("PostIntegraciones", this.$store.state.user_id)
          .then(() => {
            this.facebook_callback = this.facebook.webhook;
          });
      });
    },
  },
  computed: {
    facebook() {
      return this.$store.state.integrados.facebook;
    },
    btn_start() {
      return this.state.btn_start_b;
    },
    btn_stop() {
      return this.state.btn_stop_b;
    },
    input_token() {
      return this.state.input_token_b;
    },
  },
};
</script>
