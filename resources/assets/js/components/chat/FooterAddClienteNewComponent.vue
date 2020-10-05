<template>
  <div>
    <p>
      <b-button class="mt-1" right-align @click="show=true" variant="info">
        <i class="feather icon-plus"></i>
        Agregar
      </b-button>
    </p>
    <!-- Info modal -->
    <b-modal size="lg" v-model="show" id="modal-crearcliente" ref="modalcliente">
      <template v-slot:modal-header>
        <h5>Nuevo cliente</h5>
      </template>

      <template v-slot:default>
        <b-row>
          <b-col>
            <b-row>
              <b-col>
                <b-form-input
                  v-model="name"
                  placeholder="Nombre y apellido"
                  class="{ hasError: hasErrors, hasSuccess: isValid }"
                ></b-form-input>
              </b-col>
              <b-col>
                <b-form-input v-model="last" placeholder="Nombre y apellido"></b-form-input>
              </b-col>
              <b-col>
                <b-form-input type="email" v-model="correo_cliente" placeholder="Email"></b-form-input>
              </b-col>
            </b-row>
            <b-row class="p-3">
              <b-col>
                <label>Tipo doc.</label>
                <b-form-select v-model="select_documentos" :options="documentos"></b-form-select>
              </b-col>
              <b-col>
                <label>Documento</label>
                <b-form-input v-model="nip_cliente" placeholder="Documento"></b-form-input>
              </b-col>
              <b-col>
                <label>Fecha nacimiento</label>
                <b-form-input v-model="fecha_nac" type="date"></b-form-input>
              </b-col>
            </b-row>
            <b-row class="p-3">
              <b-col>
                <label>Pais</label>
                <b-form-select
                  v-model="selected_pais"
                  placeholder="Seleccione pais"
                  :options="paises"
                ></b-form-select>
              </b-col>
              <b-col>
                <label>Genero</label>
                <b-form-select v-model="selected_genero" placeholder="Genero" :options="generos"></b-form-select>
              </b-col>
              <b-col>
                <label>Profesion</label>
                <b-form-input v-model="profesion_cliente" placeholder="profesion"></b-form-input>
              </b-col>
            </b-row>
          </b-col>
        </b-row>
        <div variant="success">
          <p style="color:red; font-size:16px;">{{error}}</p>
        </div>
      </template>

      <template v-slot:modal-footer="{ cancel}">
        <!-- Emulate built in modal footer ok and cancel button actions -->

        <b-button size="sm" variant="danger" @click="cancel()">Cancelar</b-button>
        <!-- Button with custom close trigger value -->
        <b-button size="sm" variant="outline-success" @click="addclient()">crear usuario</b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      show: false,
      error: "",
      valido: 0,
      select_documentos: null,
      selected_pais: 170,
      selected_genero: 3,
      documento: "",
      profesion_cliente: "",
      fecha_nac: "",
      nip_cliente: "",
      correo_cliente: "",
      name: "",
      last: "",
      documentos: [],
      paises: [],
      generos: [],
      addclienteParam: [],
    };
  },
  mounted() {
    this.items = this.$store.state.agentes;
    this.paises = this.$store.state.paises;
    this.generos = this.$store.state.genero;
    this.documentos = this.$store.state.documentos;
  },
  methods: {
    cargarModal() {},
    addclient() {
      if (this.name.length < 1) {
        this.error = "*** Por favor ingrese (nombre) del usuario a crear ***";
        this.valido = 1;
      } else if (this.last.length < 1) {
        this.error = "*** Por favor ingrese (apellido) del usuario a crear ***";
        this.valido = 1;
      } else if (this.correo_cliente.length < 1) {
        this.error = "*** Por favor ingrese (correo) del usuario a crear ***";
        this.valido = 1;
      } else if (this.select_documentos == null) {
        this.error =
          "*** Por favor seleccione un (Tipo de doc) del usuario a crear ***";
        this.valido = 1;
      } else if (this.nip_cliente < 1) {
        this.error =
          "*** Por favor ingrese un (Documento) del usuario a crear ***";
        this.valido = 1;
      } else if (this.fecha_nac < 1) {
        this.error =
          "*** Por favor seleccione la (Fecha de nacimiento) del usuario a crear ***";
        this.valido = 1;
      } else {
        this.addclienteParam.push({
          name: this.name,
          last: this.last,
          correo: this.correo_cliente,
          tipo_doc: this.select_documentos,
          nip: this.nip_cliente,
          fecha_nac: this.fecha_nac,
          pais: this.selected_pais,
          genero: this.selected_genero,
          profesion: this.profesion_cliente,
        });

        this.$store.dispatch("addclienteNew", this.addclienteParam).then(() => {
          this.name = "";
          this.last = "";
          this.correo_cliente = "";
          this.select_documentos = null;
          this.nip_cliente = "";
          this.fecha_nac = "";
          this.selected_pais = 177;
          this.selected_genero = 3;
          this.profesion_cliente = "";
          this.addclienteParam = [];
          this.$store.dispatch("getClientes");
          this.$refs["modalcliente"].hide();
        });
      }
    },
  },
};
</script>