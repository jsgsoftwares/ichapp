<template>
  <div>
    <div v-if="receptor">
      <div class="chat-message chat-message-right" v-if="tipo == 'texto'">
        <div class="chat-message-text">
          <span>{{ dialogo }}</span>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
      <div class="chat-message chat-message-right" v-if="tipo == 'image'">
        <div class="chat-message-text">
          <ul class="list-inline message-media">
            <li class="list-inline-item">
              <img
                :src="dialogo"
                class="img-fluid"
                alt="media"
                width="80px"
                height="80px"
              />
            </li>
          </ul>
          <span>
            <p class="media-more">
              <b-button @click="abrirModalImgenes()" variant="light"
                >Ver imagen</b-button
              >
            </p>
          </span>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
      <div class="chat-message chat-message-right" v-if="tipo == 'video'">
        <div class="chat-message-text">
          <div class="message-video">
            <video width="210" controls>
              <source :src="dialogo" type="video/mp4" />
            </video>
          </div>
          <span>
            <b-button @click="abrirModalVideos()" variant="primary"
              >Ver video</b-button
            >
          </span>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>

      <div class="chat-message chat-message-right" v-if="tipo == 'audio'">
        <div class="chat-message-text">
          <div class="message-audio">
            <audio controls>
              <source :src="dialogo" type="audio/mpeg" />
            </audio>
          </div>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
      <div class="chat-message chat-message-right" v-if="tipo == 'location'">
        <div class="chat-message-text">
          <a v-bind:href="dialogos" target="_blank">{{ dialogo }}</a>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
      <div class="chat-message chat-message-right" v-if="tipo == 'document'">
        <div class="chat-message-text">
          <ul class="list-unstyled message-document">
            <li class="media">
              <img
                class="align-self-center img-fluid mr-2"
                src="/assets/images/doc.svg"
                alt="doc"
              />
              <div class="media-body">
                <h5>
                  <a
                    v-bind:href="dialogos"
                    variant="primary"
                    class="btn btn-success"
                    target="_blank"
                    >ver Documentos</a
                  >
                </h5>
                <!--  <p>50kb</p> -->
              </div>
            </li>
          </ul>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
    </div>

    <div v-else>
      <div class="chat-message chat-message-left" v-if="tipo == 'texto'">
        <div class="chat-message-text">
          <span>{{ dialogo }}</span>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>

      <div class="chat-message chat-message-left" v-if="tipo == 'image'">
        <div class="chat-message-text">
          <ul class="list-inline message-media">
            <li class="list-inline-item">
              <img
                :src="dialogo"
                class="img-fluid"
                alt="media"
                width="80px"
                height="80px"
              />
            </li>
          </ul>
          <span>
            <p class="media-more">
              <b-button @click="abrirModalImgenes()" variant="primary"
                >Ver imagen</b-button
              >
            </p>
          </span>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>

      <div class="chat-message chat-message-left" v-if="tipo == 'video'">
        <div class="chat-message-text">
          <div class="message-video">
            <video width="200" controls>
              <source :src="dialogo" type="video/mp4" />
            </video>
          </div>
          <b-button @click="abrirModalVideos()" variant="primary"
            >Ver video</b-button
          >
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
      <div class="chat-message chat-message-left" v-if="tipo == 'audio'">
        <div class="chat-message-text">
          <div class="message-audio">
            <audio controls>
              <source :src="dialogo" type="audio/ogg" />
              <source :src="dialogo" type="audio/mpeg" />
            </audio>
          </div>
          <b-button @click="abrirModalaudio()" variant="primary"
            >Abrir</b-button
          >
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
      <div class="chat-message chat-message-left" v-if="tipo == 'location'">
        <div class="chat-message-text">
          <a v-bind:href="dialogos" target="_blank">{{ dialogo }}</a>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
      <div class="chat-message chat-message-left" v-if="tipo == 'document'">
        <div class="chat-message-text">
          <ul class="list-unstyled message-document">
            <li class="media">
              <img
                class="align-self-center img-fluid mr-2"
                src="/assets/images/doc.svg"
                alt="doc"
              />
              <div class="media-body">
                <h5 variant="primary">
                  <a
                    v-bind:href="dialogos"
                    class="btn btn-success"
                    target="_blank"
                    >ver Documento</a
                  >
                </h5>
                <!--  <p>50kb</p> -->
              </div>
            </li>
          </ul>
        </div>
        <div class="chat-message-meta">
          <span>
            {{ hora_sent }} | {{ lasTime }}
            <i class="feather icon-check ml-2"></i>
          </span>
        </div>
      </div>
    </div>

    <div>
      <b-modal id="modal-scoped" ref="abrirModalImgenes">
        <template></template>
        <!-- BODY DE MODAL -->
        <template>
          <div>
            <img :src="dialogo" class="img-fluid" />
          </div>
        </template>

        <!-- BODY DE MODAL -->
        <template v-slot:modal-footer="{ ok, cancel }">
          <b-button size="sm" variant="danger" @click="cancel()"
            >Cerrar</b-button
          >
        </template>
      </b-modal>
    </div>
    <div>
      <b-modal id="modal-scoped" ref="abrirModalVideos">
        <template></template>
        <!-- BODY DE MODAL -->
        <template>
          <div>
            <video class="w-100" controls autoplay>
              <source
                :src="dialogo"
                type="video/mp4"
                style="height: calc(90vh - 60px)"
              />
            </video>
          </div>
        </template>

        <!-- BODY DE MODAL -->
        <template v-slot:modal-footer="{ ok, cancel }">
          <b-button size="sm" variant="danger" @click="cancel()"
            >Cerrar</b-button
          >
        </template>
      </b-modal>
    </div>
    <div>
      <b-modal id="modal-scoped" ref="abrirModalaudio">
        <template></template>
        <!-- BODY DE MODAL -->
        <template>
          <div>
            <audio controls autoplay>
              <source :src="dialogo" type="audio/ogg" />
              <source :src="dialogo" type="audio/mpeg" />
            </audio>
          </div>
        </template>

        <!-- BODY DE MODAL -->
        <template v-slot:modal-footer="{ ok, cancel }">
          <b-button size="sm" variant="danger" @click="cancel()"
            >Cerrar</b-button
          >
        </template>
      </b-modal>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    receptor: Boolean,
    variant: "",
    icono: "",
    dialogo: String,
    hora: "",
    tipo: "",
  },
  data() {
    return {
      content: "abc",

      state: {
        lasTime_message: "",
      },
    };
  },

  mounted() {
    this.state.lasTime_message = moment(this.hora, "YYYY-MM-DD hh:mm:ss")
      .locale("es")
      .fromNow();
    setInterval(() => {
      this.lasTime_message_metodo();
    }, 1000);
  },
  methods: {
    lasTime_message_metodo() {
      this.state.lasTime_message = moment(this.hora, "YYYY-MM-DD hh:mm:ss")
        .locale("es")
        .fromNow();
    },
    alinear() {
      if (receptor) {
        return "Right image";
      } else {
        return "Left image";
      }
    },
    abrirModalImgenes() {
      this.$refs["abrirModalImgenes"].show();
    },
    abrirModalVideos() {
      this.$refs["abrirModalVideos"].show();
    },
    abrirModalaudio() {
      this.$refs["abrirModalaudio"].show();
    },
  },
  computed: {
    lasTime() {
      return this.state.lasTime_message;
      //return moment(this.hora , "YYYY-MM-DD hh:mm:ss").locale('es').fromNow();
    },
    hora_sent() {
      return moment(this.hora, "YYYY-MM-DD hh:mm:ss").format("LT");
    },
    dialogos() {
      return this.dialogo;
    },
  },
};
</script>
