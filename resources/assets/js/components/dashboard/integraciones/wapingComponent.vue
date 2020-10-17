<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">Whatsapp with Waping</h2>
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
                <h6 class="mb-0"><div>Integrate Waping With Your favorite services.</div></h6>
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
                  <div class="mt-2" style="width:60%">
                    <div>
                      <label class="typo__label">Select country</label>
                      <multiselect :disabled="input_token" v-model="value" @select="dispatchAction" :options="options" :custom-label="nameWithLang" placeholder="Select one" label="text" track-by="text"></multiselect>

                    </div>
                  </div>
                  <div class="mt-2" style="width:60%">
                    <b-input-group :prepend="codigo" class="mb-2 " >
                      <b-form-input
                        v-model="phonenumber"
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
                     @click="detener()"
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
import Multiselect from 'vue-multiselect'
export default {
  components: {
    Multiselect
  },
  data() {
    return {
      checked: false,
      phonenumber: "",
      codigo:"(+93)",
      codigo_limpio:93,
      pais_id:1,
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
    value: {value: 1,text: "AFGHANISTAN",phonecode:93},
      options: []
    };
  },
  mounted() {

    this.$store.dispatch('getPaises').then(()=>{
      this.options=('paises',this.$store.state.paises);
 
    
    this.$store
      .dispatch("PostIntegraciones", this.$store.state.user_id)
      .then(() => {
    
        if (this.waping == null) {
          this.state.btn_start_b = true;
          this.state.btn_stop_b = true;
          this.state.input_token_b = true;
        } else {
          if (this.waping.enabled == 1) {
            this.state.btn_stop_b = false;
            this.checked = true;
          } else {
            this.checked = false;
            this.state.btn_start_b = true;
            this.state.btn_stop_b = true;
            this.state.input_token_b = true;
          }
          if (this.waping.phone == null) {
            this.phonenumber = "";
          } else {

         
            this.phonenumber = this.waping.phone;
            this.pais_id= this.waping.pais_id
             this.options.map((res) => {
              if (res.value == this.waping.pais_id) {
                
               this.codigo=`(+${res.phonecode})`;
               this.codigo_limpio=res.phonecode;
               this.value  = res;
               }
              });
          }
        }
      });
      });
  },
  methods: {
    dispatchAction( options) {
      
      this.codigo=`(+${options.phonecode})`;
      this.codigo_limpio=options.phonecode;
      this.pais_id=options.value;
   
    },
      nameWithLang ({ text, phonecode }) {
      return `(${phonecode}) - ${text} `
    },
    iniciar() {
      let valida = this.phonenumber.trim();

      if (valida.length > 0) {
        if (this.phonenumber.length > 1) {
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

        this.actualizabase(1, 0, false, false, true);
        
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
        phone:`${this.phonenumber}`,
        phone_code:`${this.codigo_limpio}${this.phonenumber}`,
        pais_id:this.pais_id,
        enabled: enable,
        start: start,
      };

      this.state.btn_start_b = btn_start;
      this.state.btn_stop_b = btn_stop;
      this.state.input_token_b = input;

      this.$store.dispatch("PostUpdatewaping", params);
      this.$store.dispatch("PostIntegraciones", this.$store.state.user_id);
    },
    back() {
      this.$store
        .dispatch("PostIntegraciones", this.$store.state.user_id)
        .then(() => {
          let valida = this.phonenumber.trim();

          if (valida.length == 0 || this.phonenumber.length == 0) {
            this.checked = false;
            this.actualizabase(0, 0, true, true, true);
          } else if (this.waping.start == 0) {
            this.checked = false;
            this.actualizabase(0, 0, true, true, true);
          }
          this.$store.dispatch("setpaginas", "integracion");
        });
    },
  },

  computed: {
    waping() {
      return this.$store.state.integrados.waping;
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
