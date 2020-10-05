<template>
  <div class="col-xl-4 col-md-6 col-sm-12 profile-card-1">
    <div class="card">
      <div class="card-header mx-auto" v-if="canal == 3">
        <div class="avatar avatar-xl">
          <img class="img-fluid" :src="avatar" alt="img placeholder" />
        </div>
        <i class="feather icon-refresh-cw"></i>

        <div class="avatar avatar-xl">
          <img
            class="img-fluid"
            src="/assets/icons/whatsapp.jpg"
            alt="img placeholder"
          />
        </div>
      </div>

      <div class="card-header mx-auto" v-else>
        <div class="avatar avatar-xl">
          <img class="img-fluid" :src="avatar" alt="img placeholder" />
        </div>
      </div>
      <div class="card-content">
        <div class="card-body text-center">
          <h4>{{ name }}</h4>
          <p class="">{{ description }}</p>
          <div class="card-btns d-flex justify-content-between">
            <button class="btn btn-success" @click="modal(name, canal)">
              Connect
            </button>
          </div>
          <hr class="my-1" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    id: Number,
    name: String,
    canal: Number,
    avatar: String,
    description: String,
  },
  data() {
    return {
      checked: false,
      telegram: [],
      token_telegram: "",
      callbackUrl: "Copy  Textddd",
      state: { modalstate: "", canal: null },
    };
  },
  components: {
    waping: {
      template: "<dashintegracionwaping_component/>",
    },
  },
  mounted() {
    //console.log(this.canal);
  },
  methods: {
    modal(name, canal) {
      this.$store
        .dispatch("PostIntegraciones", this.$store.state.user_id)
        .then(() => {
          this.state.modalstate = name.toLowerCase().trim();
          this.state.canal = canal;
          if (this.state.canal == 2) {
            this.$store.dispatch("setpaginas", "integraTelegram");
          } else if (this.state.canal == 4) {
            this.$store.dispatch("setpaginas", "integraFacebook");
          } else if (this.state.canal == 7) {
            this.$store.dispatch("setpaginas", "AIDialogflow");
          }
        });
    },
    habilitarcanal() {
      this.$store.dispatch("PostIntegraciones", this.$store.state.user_id);
      if (this.state.canal == 2) {
        const params = {
          user_id: this.$store.state.user_id,
          token: this.token_telegram,
          enabled: 1,
        };
        // console.log(params);
        this.$store.dispatch("PostUpdateTelegram", params);
      }

      this.$refs[this.state.modalstate].hide();
    },
    deshabilitarcanal() {
      this.$refs[this.state.modalstate].hide();
    },
    cambio() {
      if (!this.checked) {
        const params = {
          user_id: this.$store.state.user_id,
          token: this.token_telegram,
          enabled: 1,
        };
        // console.log(params);
        this.$store.dispatch("PostUpdateTelegram", params);
        this.$store.dispatch("PostIntegraciones", this.$store.state.user_id);
      } else {
        const params = {
          user_id: this.$store.state.user_id,
          token: this.token_telegram,
          enabled: 0,
        };
        // console.log(params);
        this.$store.dispatch("PostUpdateTelegram", params);
        this.$store.dispatch("PostIntegraciones", this.$store.state.user_id);
      }
    },
    clipboardSuccessHandler({ value, event }) {
      console.log("success", value);
    },
    clipboardErrorHandler({ value, event }) {
      console.log("error", value);
    },
    showAlert() {
      // Use sweetalert2
      this.$swal("Hello Vue world!!!");
    },
  },
  computed: {
    habilitado() {
      return !this.checked;
    },
  },
};
</script>
