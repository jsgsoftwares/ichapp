<template>
  <div class="chat-rightbar">
    <div class="chat-detail">
      <div class="chat-head">
        <div class="row align-items-center">
          <div class="col-4">
            <ul class="list-unstyled mb-0">
              <li class="media">
                <div class="user-status"></div>
                <img
                  class="align-self-center rounded-circle"
                  :src="icono_perfil"
                  alt="Generic placeholder image"
                  v-if="status"
                />
                <img
                  class="align-self-center rounded-circle"
                  src="assets/images/empty-logo.png"
                  alt="Generic placeholder image"
                  v-else
                />
                <div class="media-body" v-if="status">
                  <h5>{{contacto}}</h5>
                  <p class="mb-0">Online</p>
                </div>
                <div class="media-body" v-else>
                  <h5>No users</h5>
                  <p class="mb-0">Offline</p>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-8">
            <ul class="list-inline float-right mb-0">
              <li class="list-inline-item">
                <b-button @click="abrirmodaltranferir()" variant="transparent" v-if="status">
                  <i class="feather icon-share"></i>
                  <span class="badge text-uppercase badge-success">Transferir</span>
                </b-button>
              </li>
              <li class="list-inline-item">
                <b-button @click="finalizar()" variant="transparent" v-if="status">
                  <i class="feather icon-x"></i>
                  <span class="badge text-uppercase badge-danger">Finalizar</span>
                </b-button>
              </li>
              <li class="list-inline-item">
                <div class="dropdown">
                  <a
                    href="#"
                    class
                    id="chatDropdown"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    v-if="status"
                  >
                    <i class="feather icon-more-vertical-"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chatDropdown">
                    <a class="dropdown-item font-14" href="#" id="view-user-info">View User Info</a>
                    <a class="dropdown-item font-14" @click="modalhistory()">View history</a>
                    <!--   <a class="dropdown-item font-14" href="#">Archive</a>
                    <a class="dropdown-item font-14" href="#">Clear Message</a>-->
                  </div>
                </div>
              </li>
              <li class="list-inline-item">
                <a href="#" class="back-arrow">
                  <i class="feather icon-x"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="chat-body" style="height: calc(100vh - 86px);">
        <div class="tab-content card_style" :id="contactId" v-if="status">
          <vxchatbody_component
            v-for="messages in messages"
            :key="messages.id"
            :receptor="messages.receptor"
            :variant="messages.variant"
            :tipo="messages.tipo"
            :icono="messages.imagen"
            :dialogo="messages.content"
            :hora="messages.created_at"
          ></vxchatbody_component>
        </div>
        <div class="tab-content card_style" id="chat-listContent" v-else>
          <vxchatbodynada_component></vxchatbodynada_component>
        </div>
      </div>

      <div class="chat-bottom">
        <div class="chat-messagebar">
          <b-form class="mb-0" @submit.prevent="postMessages" autocomplete="off" lg="*">
            <div class="input-group">
              <div class="input-group-prepend">
                <a href="#" id="button-addonmic" @click="modalpredefinidas()">
                  <span
                    class="badge text-uppercase badge-success"
                    style="font-size:11px"
                  >Mensaje Pre</span>
                  <i class="feather icon-zap"></i> |
                </a>
              </div>
              <b-form-input
                type="text"
                class="form-control"
                placeholder="Type a message..."
                aria-label="Text"
                id="txt_mensaje"
                v-model="newMessage"
              >|</b-form-input>
              <div class="input-group-append">
                <div>
                  <b-dropdown
                    id="dropdown-dropup"
                    dropup
                    variant="transparent"
                    style="background-color:transparent"
                  >
                    <template v-slot:button-content>
                      <i class="feather icon-paperclip"></i>
                      <span class="sr-only">Search</span>
                    </template>
                    <b-dropdown-item @click="upload()">
                      <i class="feather icon-image"></i> Imagen
                    </b-dropdown-item>
                    <b-dropdown-item @click="uploadvideo()">
                      <i class="feather icon-film"></i> Video
                    </b-dropdown-item>
                    <b-dropdown-item @click="uploadfile()">
                      <i class="feather icon-file"></i> Document
                    </b-dropdown-item>
                  </b-dropdown>
                </div>

                <b-button type="submit" variant="transparent">
                  <i class="feather icon-send"></i>
                </b-button>
              </div>
            </div>
          </b-form>
        </div>
      </div>
    </div>

    <vxchatuserinfo_component :icono_perfil="icono_perfil" />

    <!-- MODALES -->
    <div
      class="modal incoming-voice-modal fade"
      id="incomingVoiceCall"
      tabindex="-1"
      role="dialog"
      aria-labelledby="incomingVoiceCallTitle"
      aria-hidden="true"
    >
      <!-- MODALES -->
      <div>
        <b-modal id="modal-scoped" ref="my-modal">
          <template>
            <!-- Emulate built in modal header close button action -->

            <h5>Transferir chat</h5>
          </template>
          <!-- BODY DE MODAL -->
          <template>
            <div>
              <b-table
                ref="selectableTable"
                selectable
                :select-mode="selectMode"
                :items="items"
                :fields="fields"
                @row-selected="onRowSelected"
                responsive="sm"
              >
                <template v-slot:cell(selected_agent)="{ rowSelected }">
                  <template v-if="rowSelected">
                    <span aria-hidden="true">&check;</span>
                    <span class="sr-only">selected_agent</span>
                  </template>
                  <template v-else>
                    <span aria-hidden="true">&nbsp;</span>
                    <span class="sr-only">Not selected</span>
                  </template>
                </template>
              </b-table>
            </div>
          </template>
          <!-- BODY DE MODAL -->
          <template v-slot:modal-footer="{ ok, cancel}">
            <b-button size="sm" variant="success" @click="transferir()">Transferir</b-button>
            <b-button size="sm" variant="danger" @click="cancel()">Cancelar</b-button>
          </template>
        </b-modal>
      </div>

      <b-modal id="modal-scoped" ref="finalizar">
        <template>
          <!-- Emulate built in modal header close button action -->

          <h5>Finalizar chat</h5>
        </template>
        <!-- BODY DE MODAL -->
        <template>
          <div>
            <strong>Esta seguro de finalizar?</strong>
          </div>
        </template>
        <!-- BODY DE MODAL -->
        <template v-slot:modal-footer="{ ok, cancel}">
          <b-button size="sm" variant="danger" @click="yesfinalizar()">Si,Terminar</b-button>
          <b-button size="sm" variant="info" @click="cancel()">No</b-button>
        </template>
      </b-modal>

      <b-modal ref="upload" title="upload" size="lg">
        <template>
          <div class="d-block text-center"></div>
        </template>
        <template>
          <div>
            <div id="preview">
              <img v-if="url" :src="url" />
            </div>
            <b-form-file
              v-model="file"
              ref="file"
              class="mb-2"
              @change="previewFiles"
              accept="image/*"
              applied
            ></b-form-file>
          </div>
        </template>
        <template v-slot:modal-footer="{ ok, cancel}">
          <b-button v-if="cambio" v-on:click="submitImagen()" variant="success" size="large">Send</b-button>
          <b-button size="sm" variant="danger" @click="cancelimagen">Cancelar</b-button>
        </template>
        <!--    <div class="mt-3">Selected file: {{ file2 ? file2.name : '' }}</div> -->
      </b-modal>

      <b-modal ref="uploadvideo" title="uploadvideo" size="lg">
        <template>
          <div class="d-block text-center"></div>
        </template>
        <template>
          <div>
            <div id="preview" v-if="url">
              <div class="message-video">
                <video width="210" controls autoplay>
                  <source :src="url" type="video/mp4" />
                </video>
              </div>
            </div>
            <b-form-file
              v-model="file"
              ref="file"
              class="mb-2"
              @change="previewFiles"
              accept="video/*"
              applied
            ></b-form-file>
          </div>
        </template>
        <template v-slot:modal-footer="{ ok, cancel}">
          <b-button v-if="cambio" v-on:click="submitVideo()" variant="success" size="large">Send</b-button>
          <b-button size="sm" variant="danger" @click="cancelvideo">Cancelar</b-button>
        </template>
      </b-modal>

      <b-modal ref="uploadfile" title="uploadfile" size="lg">
        <template>
          <div class="d-block text-center"></div>
        </template>
        <template>
          <div>
            <div id="preview" v-if="url">
              <img v-if="url" src="../../../../../public/assets/images/doc.svg" />
            </div>
            <b-form-file
              v-model="file"
              ref="file"
              class="mb-2"
              @change="previewFiles"
              accept="application/vnd.ms-excel, text/txt, application/pdf, application/vnd.ms-powerpoint, text/csv, font/woff, application/msword, application/json"
              applied
            ></b-form-file>
          </div>
        </template>
        <template v-slot:modal-footer="{ ok, cancel}">
          <b-button v-if="cambio" v-on:click="submitFile()" variant="success" size="large">Send</b-button>
          <b-button size="sm" variant="danger" @click="cancelfile">Cancelar</b-button>
        </template>
      </b-modal>
      <div>
        <b-modal ref="modalhistory" hide-footer title="Historial" size="lg">
          <div class="d-block text-center">
            <h3>{{contacto}}</h3>
          </div>
          <vxhistorial_component />
        </b-modal>
      </div>

      <div>
        <b-modal id="modal-scoped" ref="modalpredefinidas">
          <template>
            <!-- Emulate built in modal header close button action -->

            <h5>Respuestas Rapidas</h5>
          </template>
          <!-- BODY DE MODAL -->
          <template>
            <div>
              <b-dropdown
                text="Respuestas predefinidas"
                variant="outline-success"
                class="mt-2 mr-1 w-100"
              >
                <b-dropdown-item
                  class="font-size"
                  v-for="mensaje in mensajesPre"
                  :key="mensaje.id"
                  :value="mensaje.Mensaje"
                  @click="newMessage=mensaje.Mensaje"
                >{{mensaje.tipo}}</b-dropdown-item>
              </b-dropdown>
            </div>
          </template>

          <!-- BODY DE MODAL -->
          <template v-slot:modal-footer="{ ok, cancel}">
            <b-button size="sm" variant="danger" @click="cancel()">Cerrar</b-button>
          </template>
        </b-modal>
      </div>

      <!-- MODALES -->
    </div>

    <!-- MODALES -->
  </div>
</template>
<style >
.card_style {
  max-height: calc(100vh - 120px);
  overflow-y: auto;
}
#preview {
  display: flex;
  justify-content: center;
  align-items: center;
}

#preview img {
  max-width: 100%;
  max-height: 500px;
}
</style>
<script>
export default {
  props: {
    contactId: Number,
    contactName: String,
    interno: Number,
    icono_perfil: String,
    titleDrop: "Tipo consultas",
    status: Boolean,
  },

  data() {
    return {
      file: "",
      newMessage: "",
      url: null,
      newcoment: "",
      newcomentario: [],
      selected: null,
      modes: ["single"], //['multi', 'single', 'range'],
      fields: ["id", "nombre", "email"],
      items: [],
      selectMode: "single",
      selected_agent: [],
      state: {
        cambio: false,
      },
    };
  },
  mounted() {
    this.scrollBotton();
    this.$store.dispatch("getsearchAgent");
    this.items = this.$store.state.agentes;
  },
  methods: {
    upload() {
      this.$refs["upload"].show();
    },
    uploadvideo() {
      this.$refs["uploadvideo"].show();
    },
    uploadfile() {
      this.$refs["uploadfile"].show();
    },
    abrirmodaltranferir() {
      this.$store.dispatch("getsearchAgent");
      this.items = this.$store.state.agentes;

      this.$refs["my-modal"].show();
    },
    modalpredefinidas() {
      this.$refs["modalpredefinidas"].show();
    },
    userUpdate() {
      this.$store.dispatch("getsearchAgent");
      this.items = this.$store.state.agentes;

      this.$refs["userUpdate"].show();
    },
    modalhistory() {
      this.$refs["modalhistory"].show();
    },
    transferir() {
      if (this.selected_agent.length > 0) {
        this.selected_agent.push({ contacto: this.contactId });

        this.$store.dispatch("transferirChat", this.selected_agent);
        this.$refs["my-modal"].hide();
        this.$store.state.messages = [];
        this.$store.state.Consultas = [];
        this.$store.state.clientesInfo = [];
        this.$store.state.clientesInfocanal = [];
        this.$store.dispatch("getConversation");
      } else {
        alert("debe seleccionar un agente para transferir");
      }
    },

    finalizar() {
      this.$refs["finalizar"].show();
    },
    yesfinalizar() {
      this.$refs["my-modal"].hide();
      this.$store.dispatch("finalizarConversation", this.contactId).then(() => {
        this.$store.dispatch("getConversation");
        this.$router.push({ path: "/chat" });
        EventBus.$on("messenger_Component", () => {
          this.$forceUpdate();
        });
      });
      location.reload();
    },
    postMessages() {
      if (this.newMessage.length > 0 && this.contactId != null) {
        this.$store.dispatch("postMessages", this.newMessage).then(() => {
          this.newMessage = "";
        });
      } else if (this.newMessage.length > 0 && this.contactId == null) {
        alert("please select a conversation");
      }

      //this.OrdernarConversation();
    },

    scrollBotton() {
      const el = document.querySelector(".card_style");
      el.scrollTop = el.scrollHeight;
    },
    onRowSelected(items) {
      this.selected_agent = items;
    },
    previewFiles(event) {
      //console.log(event.target.files);

      const file = event.target.files[0];
      this.state.cambio = true;
      this.url = URL.createObjectURL(file);
    },
    submitImagen() {
      let formData = new FormData();
      if (
        this.file.type == "image/jpeg" ||
        this.file.type == "image/png" ||
        this.file.type == "image/gif"
      ) {
        formData.append("file", this.file);

        axios
          .post("/api/upload", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((response) => {
            this.url = this.$store.state.url_app;
            this.newMessage = this.url + "/storage/" + response.data.imagen;
            // console.log("imagen", this.newMessage);
            this.postImagen();
          });
      } else {
        alert("Formato incorrecto,formatos aceptado (jpg,jpge,gif,png)");
      }
    },
    submitVideo() {
      let formData = new FormData();
      if (
        this.file.type == "video/ogm" ||
        this.file.type == "video/wmv" ||
        this.file.type == "video/mpg" ||
        this.file.type == "video/mp4" ||
        this.file.type == "video/avi" ||
        this.file.type == "video/mpeg" ||
        this.file.type == "video/mov" ||
        this.file.type == "video/webm"
      ) {
        formData.append("file", this.file);

        axios
          .post("/api/upload", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((response) => {
            this.url = this.$store.state.url_app;
            this.newMessage = this.url + "/storage/" + response.data.imagen;
            // console.log("imagen", this.newMessage);
            this.postVideo();
          });
      } else {
        alert("Formato incorrecto,formatos aceptado (mp4,avi,wmv,mpeg)");
      }
    },
    submitFile() {
      let formData = new FormData();
      if (
        this.file.type == "application/pdf" ||
        this.file.type == "font/woff" ||
        this.file.type == "application/vnd.ms-powerpoint" ||
        this.file.type == "text/csv" ||
        this.file.type == "application/msword" ||
        this.file.type == "application/json" ||
        this.file.type == "text/txt" ||
        this.file.type == "application/vnd.ms-excel"
      ) {
        formData.append("file", this.file);

        axios
          .post("/api/upload", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((response) => {
            this.url = this.$store.state.url_app;
            this.newMessage = this.url + "/storage/" + response.data.imagen;
            // console.log("imagen", this.newMessage);
            this.postFile();
          });
      } else {
        alert("Formato incorrecto,formatos aceptado (xls,doc,ppt,pdf,txt,csv)");
      }
    },
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },
    postImagen() {
      //console.log("mensaje", this.newMessage);
      if (this.newMessage.length > 0 && this.contactId != null) {
        this.$store.dispatch("postImagen", this.newMessage).then(() => {
          this.newMessage = "";
          this.url = "";
          this.$refs["upload"].hide();
          this.$refs["upload"].reset();
        });
      } else if (this.newMessage.length > 0 && this.contactId == null) {
        alert("please select a conversation");
      }

      //this.OrdernarConversation();
    },
    postVideo() {
      //console.log("mensaje", this.newMessage);
      if (this.newMessage.length > 0 && this.contactId != null) {
        this.$store.dispatch("postVideo", this.newMessage).then(() => {
          this.newMessage = "";
          this.url = "";
          this.$refs["uploadvideo"].hide();
          this.$refs["uploadvideo"].reset();
        });
      } else if (this.newMessage.length > 0 && this.contactId == null) {
        alert("please select a conversation");
      }

      //this.OrdernarConversation();
    },
    postFile() {
      console.log("mensaje", this.newMessage);
      if (this.newMessage.length > 0 && this.contactId != null) {
        this.$store.dispatch("postFile", this.newMessage).then(() => {
          this.newMessage = "";
          this.url = "";
          this.$refs["uploadfile"].hide();
          this.$refs["uploadfile"].reset();
        });
      } else if (this.newMessage.length > 0 && this.contactId == null) {
        alert("please select a conversation");
      }

      //this.OrdernarConversation();
    },
    cancelvideo() {
      this.url = "";
      this.$refs["uploadvideo"].hide();
      this.$refs["uploadvideo"].reset();
    },
    cancelimagen() {
      this.url = "";
      this.$refs["upload"].hide();
      this.$refs["upload"].reset();
    },
    cancelfile() {
      this.url = "";
      this.$refs["uploadfile"].hide();
      //this.$refs["uploadfile"].reset();
    },
  },
  updated() {
    this.scrollBotton();
  },
  computed: {
    cambio() {
      return this.state.cambio;
    },
    mensajesPre() {
      return this.$store.state.mensajesPre;
    },

    nameuser() {
      return this.$store.state.nombreuser;
    },
    messages() {
      this.scrollBotton();
      return this.$store.state.messages;
    },
    infocliente() {
      return this.$store.state.clientesInfo;
    },

    contacto() {
      if (this.interno == 1) {
        return this.contactName;
      } else {
        if (this.infocliente.firstname == null) {
          return "cliente no registrado";
        } else {
          return `${this.infocliente.firstname} ${this.infocliente.lastname}`;
        }
      }
    },
    correo() {
      if (this.interno == 1) {
        return "";
      } else {
        if (this.infocliente.correo == null) {
          return "No registrado";
        } else {
          return `${this.infocliente.correo}`;
        }
      }
    },
    nip() {
      if (this.interno == 1) {
        return "";
      } else {
        if (this.infocliente.nip == null) {
          return "No registrado";
        } else {
          return `${this.infocliente.nip}`;
        }
      }
    },
    profesion() {
      if (this.interno == 1) {
        return "";
      } else {
        if (this.infocliente.profesion == null) {
          return "No registrado";
        } else {
          return `${this.infocliente.profesion}`;
        }
      }
      /* conversationes(){

                  return this.$store.state.conversation;
                  } */
    },
  },
};
</script>