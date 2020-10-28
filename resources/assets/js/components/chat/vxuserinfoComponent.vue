<template>
  <div class="chat-user-info" id="userinfo">
    <div class="chat-user-head">
      <div class="row align-items-center">
        <div class="col-9">
          <h5>User Info</h5>
        </div>
        <div class="col-3">
          <ul class="list-inline float-right mb-0">
            <li class="list-inline-item">
              <a @click="cierra()" id="close-user-info">
                <i class="feather icon-x"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="chat-user-body">
      <div class="userbar">
        <img class="user-pic img-fluid" :src="icono_perfil" alt="user-pic" />
        <h5>{{contacto}}</h5>
        <p class="mb-0"></p>
      </div>
      <div class="user-detail">
        <p class="user-detail-header">About</p>
        <div class="user-about">
          <!--           <h6>
            <i class="feather icon-heart mr-2"></i>Feeling good today.
          </h6>-->
          <h6 class="my-3">
            <i class="feather icon-mail mr-2"></i>
            {{correo}}
          </h6>
          <!--           <h6 class="mb-0">
            <i class="feather icon-phone-call mr-2"></i>
          </h6>-->
        </div>
        <p class="user-detail-header">Social Profile</p>
        <div class="user-social">
          <ul class="list-inline mb-0">
            <CanalesClientes
              class="w-70"
              v-for="canales in infocanales"
              :key="canales.chat_id"
              :id="canales.chat_id"
              :dato="canales.chat_id"
              :canal="canales.detalle"
              :icono="canales.icon"
            ></CanalesClientes>
          </ul>
        </div>

        <p class="user-detail-header">Settings</p>
        <div class="user-setting">
          <div class="row align-items-center pb-3">
            <div class="col-9">
              <h6 class="mb-0">
                <b-button variant="Info" @click="userUpdate()">Editar Datos</b-button>
              </h6>
            </div>
          </div>
          <div></div>
          <!--           <div class="row align-items-center pb-3">
            <div class="col-9">
              <h6 class="mb-0">Block Contact</h6>
            </div>
            <div class="col-3 text-right">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="blockContact" />
                <label class="custom-control-label" for="blockContact"></label>
              </div>
            </div>
          </div>-->
        </div>
      </div>
    </div>
    <b-modal id="modal-scoped" size="lg" ref="userUpdate">
      <template>
        <!-- Emulate built in modal header close button action -->
        <h5>Actualizar Datos</h5>
      </template>
      <DatosClientes :contact="contactId"></DatosClientes>
      <template>
        <div></div>
      </template>
      <!-- BODY DE MODAL -->
      <template v-slot:modal-footer="{ cancel}">
        <footerAddCliente></footerAddCliente>
        <b-button size="sm" variant="danger" @click="cancel()">Cerrar</b-button>
      </template>
    </b-modal>
  </div>
</template>
<script>
export default {
  props: {
    icono_perfil: String,
    contactId: Number,
  },
  mounted() {
      console.log("CARGANDO")
  },
  methods: {
    userUpdate() {
      this.$store.dispatch("getsearchAgent");
      this.items = this.$store.state.agentes;

      this.$refs["userUpdate"].show();
    },
    cierra(){
   
      document.getElementById("userinfo").style.display="none";
    }
  },
  computed: {
    infocliente() {
      return this.$store.state.clientesInfo;
    },
    infocanales() {
      return this.$store.state.clientesInfocanal;
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
    },
  },
};
</script>