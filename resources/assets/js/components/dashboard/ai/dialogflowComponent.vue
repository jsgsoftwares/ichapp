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
                Dialogflow Artificial Intelligence
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
                    <b-input-group prepend="File json" class="mb-2">
                      <b-form-file
                        id="file-default"
                        v-model="filename"
                        :disabled="input_token"
                        :placeholder="nombre_json"
                        @change="previewFiles"
                      ></b-form-file>
                    </b-input-group>
                    <b-input-group prepend="Project ID" class="mb-2">
                      <b-form-input
                        v-model="project_id"
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
                    variant="outline-danger"
                    :disabled="btn_stop"
                    @click="detener()"
                  >
                    Stop
                  </b-button>
                  <b-button
                    size="sm"
                    variant="outline-success"
                    :disabled="btn_start"
                    @click="iniciar()"
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
      url: 0,
      filename: null,
      nombre_json: "File.json",
      project_id: "",
      newMessage: "",
      state: {
        canal: null,
        detener: false,
        stop: false,
        dialog: [],
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
        if (this.dialogflow == null) {
          this.state.btn_start_b = true;
          this.state.btn_stop_b = true;
          this.state.input_token_b = true;
        } else {
          if (this.dialogflow.enabled == 1) {
            this.state.btn_stop_b = false;
            this.checked = true;
          } else {
            this.checked = false;
            this.state.btn_start_b = true;
            this.state.btn_stop_b = true;
            this.state.input_token_b = true;
          }
          if (this.dialogflow.filename == null) {
            this.nombre_json = "file";
          } else {
            this.nombre_json = this.dialogflow.filename;
            this.project_id = this.dialogflow.project_id;
          }
        }
      });
  },
  methods: {
    back() {
      this.$store
        .dispatch("PostIntegraciones", this.$store.state.user_id)
        .then(() => {
          if (this.dialogflow == null || this.dialogflow.start == 0) {
            this.checked = false;
            this.actualizabase(0, 0, true, true, true);
          }
          this.$store.dispatch("setpaginas", "integracion");
        });
    },
    iniciar() {
      this.$store
        .dispatch("PostIntegraciones", this.$store.state.user_id)
        .then(() => {
          if (this.url != 0) {
            if (this.project_id.length != 0) {
              this.subirfile();
            } else {
              this.$swal({
                icon: "error",
                title: "Oops...",
                text: "The projectID field cannot be empty!",
              });
            }
          } else {
            if (this.dialogflow.filename == null) {
              this.$swal({
                icon: "error",
                title: "Oops...",
                text: "The file field cannot be empty!",
              });
            } else {
              this.actualizabase(1, 1, true, true, false);
              this.$swal("Success", "Integration will start..", "success");
            }
          }
        });
    },
    previewFiles(event) {
      this.url = 0;
      this.url = event.target.files["length"];
    },
    subirfile() {
      let formData = new FormData();
      setTimeout(() => this.cargar, 2000);

      formData.append("file", this.filename);
      axios
        .post("/api/v1/upload/json", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.nombre_json = response.data.imagen;
          this.actualizabase(1, 1, true, true, false);
          this.$swal("Success", "Integration will start..", "success");
        })
        .catch((error) => {
          this.$swal({
            icon: "error",
            title: "Oops...",
            text: error,
          });
        });
    },
    activar_desactivar() {
      if (!this.checked) {
        //prender
        if (this.dialogflow == null) {
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
    actualizabase(enable, start, input, btn_start, btn_stop) {
      const params = {
        user_id: this.$store.state.user_id,
        filename: this.nombre_json,
        project_id: this.project_id,
        enabled: enable,
        start: start,
      };
      this.state.btn_start_b = btn_start;
      this.state.btn_stop_b = btn_stop;
      this.state.input_token_b = input;

      this.$store.dispatch("PostUpdateDialogflow", params);
      this.$store.dispatch("PostIntegraciones", this.$store.state.user_id);
    },
  },
  computed: {
    dialogflow() {
      return this.$store.state.integrados.dialogflow;
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
