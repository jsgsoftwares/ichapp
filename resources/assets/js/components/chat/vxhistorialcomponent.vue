<template>
  <div>
    <b-card
      no-body
      header-text-variant="white"
      header-tag="header"
      header-bg-variant="dark"
      footer="Card Footer"
      footer-tag="footer"
      footer-bg-variant="light"
      style="height: calc(100vh - 220px);"
    >
      <b-card-body class="estilo_card w-80" style=" overflow: scroll;">
        <historialList
          v-for="consulta in Consultas"
          :key="consulta.id"
          :consulta="consulta.consulta"
          :hora="consulta.created_at"
          :usuario="consulta.name"
        ></historialList>
      </b-card-body>

      <div slot="footer" variant="info">
        <b-form class="mb-0" @submit.prevent="postComentario" autocomplete="off">
          <b-input-group>
            <template v-slot:prepend>
              <b-form-select v-model="selected">
                <template v-slot:first>
                  <option disabled selected>-- Tipo de consulta --</option>
                </template>
                <TypeConsultaList
                  v-for="tipoconsulta in TypeConsultas"
                  :key="tipoconsulta.id"
                  :id="tipoconsulta.id"
                  :dato="tipoconsulta.detalle"
                ></TypeConsultaList>
              </b-form-select>
              <b-form-input v-model="selected" hidden></b-form-input>
            </template>
            <b-form-textarea
              variant="ligth"
              id="txt_mensaje"
              v-model="newcoment"
              placeholder="Escribe un comentario.."
            ></b-form-textarea>

            <template v-slot:append>
              <b-button type="submit" variant="info">Comentar</b-button>
            </template>
          </b-input-group>
        </b-form>
      </div>
    </b-card>
  </div>
</template>
<style >
.estilo_card {
  max-height: calc(100vh - 70px);
  overflow-y: auto;
}
</style>
<script>
export default {
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
  },
  methods: {
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
      const el = document.querySelector(".estilo_card");

      el.scrollTop = 100;
    },
  },
  computed: {
    Consultas() {
      return this.$store.state.Consultas;
    },
    TypeConsultas() {
      return this.$store.state.Typeconsulta;
    },
  },
};
</script>