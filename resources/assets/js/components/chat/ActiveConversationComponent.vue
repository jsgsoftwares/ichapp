<template>
  <div>
    <b-container class="w-100 pr-0 pl-0" style="height: calc(100vh - 60px)">
      <b-row class="h-100 w-100">
        <b-col cols="11" class="p-1 h-100" style="height: calc(100vh - 60px)">
          <div class="h-100" style="height: calc(100vh - 60px)">
            <b-card
              no-body
              header-text-variant="white"
              header-tag="header"
              header-bg-variant="dark"
              footer="Card Footer"
              footer-tag="footer"
              footer-bg-variant="light"
              class="p-1 h-100"
              style="height: calc(100vh - 60px)"
            >
              <b-card-body class="card_style w-80">
                <!-- AREA DE CONVERSACION-->

                <messageconversation
                  v-for="messages in messages"
                  :key="messages.id"
                  :receptor="messages.receptor"
                  :variant="messages.variant"
                  :icono="messages.imagen"
                  :dialogo="messages.content"
                  :hora="messages.created_at"
                ></messageconversation>
              </b-card-body>
              <div slot="footer">
                <b-form class="mb-0" @submit.prevent="postMessages" autocomplete="off" lg="*">
                  <b-input-group>
                    <b-form-input
                      id="txt_mensaje"
                      v-model="newMessage"
                      placeholder="Escribe un mensaje.."
                    ></b-form-input>
                    <b-input-group-append>
                      <b-button type="submit" variant="info">Enviar</b-button>
                    </b-input-group-append>
                  </b-input-group>

                  <div>
                    <b-input-group>
                      <template v-slot:prepend>
                        <b-button size="lg" variant="primary">
                          <b-icon icon="question-circle-fill" aria-label="Help"></b-icon>
                        </b-button>
                        <!--                                         <b-dropdown text="Dropdown" variant="info">
                                          <b-dropdown-item>Action A</b-dropdown-item>
                                          <b-dropdown-item>Action B</b-dropdown-item>
                        </b-dropdown>-->
                      </template>

                      <b-form-input></b-form-input>

                      <template v-slot:append>
                        <b-dropdown text="Dropdown" variant="outline-secondary">
                          <b-dropdown-item>Action C</b-dropdown-item>
                          <b-dropdown-item>Action D</b-dropdown-item>
                        </b-dropdown>
                        <b-button type="submit" variant="info">Enviar</b-button>
                      </template>
                    </b-input-group>
                  </div>

                  <!--                                 <b-container class="bv-example-row">
                                  <b-row>
                              
                                    <b-col >
                                        <b-dropdown left-align text="Respuestas predefinidas" variant="outline-success" class="mt-2 mr-1 w-100">
                                          <b-dropdown-item  
                                          v-for="mensaje in mensajesPre"
                                        :key="mensaje.id"
                                        :value="mensaje.Mensaje"
                                          @click="newMessage=mensaje.Mensaje"
                                          >
                                          {{mensaje.Mensaje}}
                                            </b-dropdown-item>
                                          
                                        </b-dropdown>
                                    </b-col>
                                    <b-col >
                                      
                                      <b-button class="mt-2 ml-0 pr-0 pl-0 w-100" left-align variant="outline-Info"  @click="$bvModal.show('modal-scoped')">Transferir Conversacion</b-button>
                                    </b-col>
                                    <b-col cols="12" >
                                      <b-button class="mt-2 ml-0 pl-0 pr-0 w-100" right-align variant="danger" v-on:click="finalizar">Terminar chat</b-button>
                                    </b-col>
                         
                                  </b-row>
                                </b-container>
                  -->
                </b-form>
              </div>
            </b-card>
          </div>

          <!--               <b-tabs content-class="mt-3">
                <b-tab title="Conversacion" active  >

                </b-tab>
          -->
          <!--                 <b-tab title="Historial de consultas">
                  <div>
                        <b-card no-body 
                          header-text-variant="white"
                          header-tag="header"
                          header-bg-variant="dark"
                          footer="Card Footer"
                          footer-tag="footer"
                          footer-bg-variant="light"
                          style="height: calc(100vh - 125px);">
                            <b-card-body class="card_style w-80">
                                  <historialList 
                                  v-for="consulta in Consultas"
                                  :key="consulta.id"
                                  :consulta="consulta.consulta"
                                  :hora="consulta.created_at"
                                  :usuario='consulta.name'>
                                  </historialList>
                            </b-card-body>
                        
                            <div slot="footer"> 
                              <b-form class="mb-0" @submit.prevent="postComentario" autocomplete="off">
                            
                                        <p>
                                          <b-row>
                                          <b-col  cols="4">
                                            <b-form-select v-model="selected"  class="mt-2">
                                            <template v-slot:first>
                                                <option disabled>-- Tipo de consulta --</option>
                                            </template>
                                            <TypeConsultaList
                                            v-for="tipoconsulta in TypeConsultas"
                                            :key="tipoconsulta.id"
                                            :id="tipoconsulta.id"
                                            :dato="tipoconsulta.detalle">
                                            </TypeConsultaList>
                                            </b-form-select>
                                            <b-form-input v-model="selected" hidden></b-form-input>
                                      
                                                </b-col>
                                                <b-col  cols="5">
                                                <b-form-textarea
                                                id="txt_mensaje"
                                                v-model="newcoment"
                                                placeholder="Escribe un comentario.."
                                                >

                                                </b-form-textarea>
                                              
                                                  </b-col>
                                                <b-col  cols="3">
                                                <b-button class="mt-3" type="submit" variant="info">Comentar</b-button>
                                                </b-col>
                                                </b-row>

                                  </p>
                              </b-form>
                            </div>
                        </b-card>
                  </div>
                </b-tab>

                <b-tab title="Datos del cliente" >
                  <div>
                    <b-card no-body 

                    header-text-variant="white"
                    header-tag="header"
                    header-bg-variant="dark"
                    footer="Card Footer"
                    footer-tag="footer"
                    footer-bg-variant="light"

                    style="height: calc(100vh - 125px);"
                    >
                      <b-card-body class="card_style w-80">
                        <DatosClientes :contact=contactId></DatosClientes>
                      </b-card-body>

                      <div slot="footer"> 
                        <footerAddCliente></footerAddCliente>
                                            
                      </div>
                    </b-card>
                  </div>
                    
                </b-tab>
          -->

          <!--  </b-tabs> -->
        </b-col>

        <b-col cols="1" class="p-1 h-100" style="height: calc(100vh - 60px)">
          <b-row>
            <b-col cols="2"></b-col>
            <b-col cols="6">
              <b-img
                rounded="circle"
                md="1"
                alt="Circle image"
                width="48"
                heigth="48"
                src="/assets/icons/whatsapp.png"
              ></b-img>
            </b-col>
          </b-row>
        </b-col>
        <!-- LADO DERECHO -->
        <!--           <b-col   cols="3"  class=" p-1 h-100" style="height: calc(100vh - 60px)">
            <b-card-group deck class="h-100 ">
              <b-card no-body >
                <b-list-group flush>
                  <b-list-group-item  class="text-center">
                    <b-img rounded="circle" alt="Circle image" width="100" heigth="100"
                    :src="icono_perfil"
                    ></b-img>
                    <p><h5>{{contacto}}</h5></p>
                    <p  style="font-size:12px" >{{correo}}</p>
                    <p style="font-size:12px">Num Doc: {{nip}}</p>
                  </b-list-group-item>
                  <b-list-group-item>
                    <p style="font-size:14px"><b>Canales vinculados</b></p>
                    <hr/>
                    <CanalesClientes class="w-70"
                                v-for="canales in infocanales"
                                :key="canales.chat_id"
                                :id="canales.chat_id"
                                :dato="canales.chat_id"
                                :canal="canales.detalle"
                                :icono="canales.icon">
                    </CanalesClientes>
                  </b-list-group-item>
                  <b-list-group-item href="#">
                    <div class="ml-2"><b-button class="mt-2 mx-auto" variant="outline-primary" v-on:click="finalizar">Desvincular usuario</b-button></div>
                  </b-list-group-item>
                </b-list-group>
              </b-card>                  
            </b-card-group>                
        </b-col>-->
      </b-row>
    </b-container>
    <!-- Info modal -->
    <b-modal id="modal-scoped" ref="my-modal">
      <template v-slot:modal-header="{ close }">
        <!-- Emulate built in modal header close button action -->
        <b-button size="sm" variant="outline-danger" @click="close()">Cerrar</b-button>
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
</template>



<style >
.card_style {
  max-height: calc(100vh - 70px);
  overflow-y: auto;
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
  },

  data() {
    return {
      newMessage: "",
      newcoment: "",
      newcomentario: [],
      selected: null,
      modes: ["single"], //['multi', 'single', 'range'],
      fields: ["id", "nombre", "email"],
      items: [],
      selectMode: "single",
      selected_agent: [],
      state: {},
    };
  },
  mounted() {
    this.scrollBotton();
    this.items = this.$store.state.agentes;
  },
  methods: {
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
      this.$store.dispatch("finalizarConversation", this.contactId).then(() => {
        this.$store.dispatch("getConversation");
        this.$router.push({ path: "/chat" });
        EventBus.$on("messenger_Component", () => {
          this.$forceUpdate();
        });
      });
    },
    postMessages() {
      //this.OrdernarConversation();
      this.$store.dispatch("postMessages", this.newMessage).then(() => {
        this.newMessage = "";
      });
    },
    postComentario() {
      this.newcomentario = [
        { comentario: this.newcoment, type: this.selected },
      ];

      this.$store.dispatch("postComentario", this.newcomentario).then(() => {
        //console.log('comentarions store',this.$store.state.Consultas);
        this.newcoment = "";
      });
    },
    scrollBotton() {
      const el = document.querySelector(".card_style");
      el.scrollTop = el.scrollHeight;
    },
    onRowSelected(items) {
      this.selected_agent = items;
    },
  },
  updated() {
    this.scrollBotton();
  },
  computed: {
    mensajesPre() {
      return this.$store.state.mensajesPre;
    },

    nameuser() {
      return this.$store.state.nombreuser;
    },
    messages() {
      return this.$store.state.messages;
    },
    infocliente() {
      return this.$store.state.clientesInfo;
    },
    infocanales() {
      return this.$store.state.clientesInfocanal;
    },
    Consultas() {
      return this.$store.state.Consultas;
    },
    TypeConsultas() {
      return this.$store.state.Typeconsulta;
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
  //metodo que envia a objecto padre cambios
  /*watch:{
          contactId(value)
          {
            this.getMessages()
          }
          
        }*/
};
</script>
