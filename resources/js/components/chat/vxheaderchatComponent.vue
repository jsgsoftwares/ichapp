<template>
  <div class="chat-listbar">
    <div class="chat-left-headbar">
      <div class="row align-items-center">
        <div class="col-9">
          <ul class="list-unstyled mb-0">
            <li class="media">
              <img
                class="align-self-center mr-2"
                width="60px"
                height="60px"
                src="/assets/images/empty-logo.png"
                alt="logo"
              />
              <div class="media-body">
                <h5 class="mb-0 mt-2">Chat</h5>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-3">
          <a
            @click="logout()"
            data-toggle="tooltip"
            data-placement="right"
            title
            data-original-title="Logout"
          >
            <i class="feather icon-log-out"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      state: {
        imagenLogo: "/assets/images/empty-logo.png",
      },
    };
  },
  mounted() {
    this.imagenLogo = "/assets/images/empty-logo.png";
    //  this.imagenLogo = "assets/images/empty-logo.png";
  },
  computed: {
    imagen() {
      console.log(this.state.imagenLogo);
      this.state.imagenLogo;
    },
  },
  methods: {
    logout() {
      this.$store.dispatch("PostLogout");
    },
  },
};
</script>
