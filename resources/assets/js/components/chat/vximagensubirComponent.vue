<template>
  <div>
    <div id="preview">
      <img v-if="url" :src="url" />
    </div>
    <b-form-file v-model="file" ref="file" class="mb-2" @change="previewFiles"></b-form-file>

    <b-button v-on:click="submitFile()" v-if="cambio" variant="success" size="large">Send</b-button>
    <!--    <div class="mt-3">Selected file: {{ file2 ? file2.name : '' }}</div> -->
  </div>
</template>
<style>
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
  },
  data() {
    return {
      file: "",
      newMessage: "",
      url: null,
      state: {
        cambio: false,
      },
    };
  },

  methods: {
    previewFiles(event) {
      //console.log(event.target.files);

      const file = event.target.files[0];
      this.state.cambio = true;
      this.url = URL.createObjectURL(file);
    },
    submitFile() {
      let formData = new FormData();

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
          console.log("imagen", this.newMessage);
          this.postImagen();
        });
    },

    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },
    postImagen() {
      this.$refs["upload"].hide();
      console.log("mensaje", this.newMessage);
      if (this.newMessage.length > 0 && this.contactId != null) {
        this.$store.dispatch("postImagen", this.newMessage).then(() => {
          this.newMessage = "";
        });
      } else if (this.newMessage.length > 0 && this.contactId == null) {
        alert("please select a conversation");
      }

      //this.OrdernarConversation();
    },
  },
  computed: {
    cambio() {
      return this.state.cambio;
    },
  },
};
</script>