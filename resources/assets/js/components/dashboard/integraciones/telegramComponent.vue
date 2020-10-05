<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">Telegram</h2>
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
                <h6 class="mb-0"><div>A new era of messaging.</div></h6>
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
                    When your Dialogflow agent is ready, follow these
                    instructions to connect it to your Telegram bot:
                  </p>
                  <ul>
                    <li>
                      Get a Telegram access token from BotFather and insert it
                      in the ‘Telegram Token’ field.
                    </li>
                    <li>Click 'START' below.</li>
                  </ul>
                  <a
                    href="https://cloud.google.com/dialogflow/docs/integrations/telegram"
                    target="_blank"
                    >More in documentation.</a
                  >
                  <br />
                  <div class="mt-2">
                    <b-input-group prepend="Telegram token" class="mb-2">
                      <b-form-input
                        v-model="token_telegram"
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
      token_telegram: "",

      disable: false,
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
        if (this.telegram == null) {
          this.state.btn_start_b = true;
          this.state.btn_stop_b = true;
          this.state.input_token_b = true;
        } else {
          if (this.telegram.enabled == 1) {
            this.state.btn_stop_b = false;
            this.checked = true;
          } else {
            this.checked = false;
            this.state.btn_start_b = true;
            this.state.btn_stop_b = true;
            this.state.input_token_b = true;
          }
          if (this.telegram.token == null) {
            this.token_telegram = "";
          } else {
            this.token_telegram = this.telegram.token;
          }
        }
      });
  },
  methods: {
    iniciar() {
      let valida = this.token_telegram.trim();

      if (valida.length > 0) {
        if (this.token_telegram.length > 1) {
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
    actualizabase(enable, start, input, btn_start, btn_stop) {
      const params = {
        user_id: this.$store.state.user_id,
        token: this.token_telegram,
        enabled: enable,
        start: start,
      };
      this.state.btn_start_b = btn_start;
      this.state.btn_stop_b = btn_stop;
      this.state.input_token_b = input;

      this.$store.dispatch("PostUpdateTelegram", params);
      this.$store.dispatch("PostIntegraciones", this.$store.state.user_id);
    },
    back() {
      this.$store
        .dispatch("PostIntegraciones", this.$store.state.user_id)
        .then(() => {
          let valida = this.token_telegram.trim();

          if (valida.length == 0 || this.token_telegram.length == 0) {
            this.checked = false;
            this.actualizabase(0, 0, true, true, true);
          } else if (this.telegram.start == 0) {
            this.checked = false;
            this.actualizabase(0, 0, true, true, true);
          }
          this.$store.dispatch("setpaginas", "integracion");
        });
    },
  },
  computed: {
    telegram() {
      return this.$store.state.integrados.telegram;
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
