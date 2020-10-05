<template>
  <div
    class="nav flex-column chat-userlist"
    variant="info"
    role="tablist"
    aria-orientation="vertical"
  >
    <b-alert show class="nav-link active" :variant="variante">
      <a
        class="nav-link active"
        :id="conversation.contact_id"
        data-toggle="pill"
        href="conversation.contact_id"
        role="tab"
        aria-controls="conversation.contact_id"
        aria-selected="true"
      >
        <div class="media active">
          <div class="user-status"></div>
          <b-img
            class="align-self-center rounded-circle"
            width="49"
            heigth="49"
            :src="conversation.icon"
            alt="User Image"
          ></b-img>
          <div class="media-body text-black">
            <h5>
              {{ conversation.contact_name }}
              <span class="chat-timing">{{ lasTime }}</span>
            </h5>
            <p
              class="lista overflow-ellipsis d-none d-md-block font-weight-normal"
            >{{ conversation.last_message }}</p>
          </div>
        </div>
      </a>
    </b-alert>
  </div>
  <!--  <b-list-group-item href="#" :variant="variante">
    <b-row class="p-1" align-h="center">
      <b-col cols="3" md="3" class="text-center">
        <b-img rounded="circle" alt="Circle image" width="49" heigth="49" :src="conversation.icon"></b-img>
      </b-col>
      <b-col cols="9" align-self="center" class="d-none d-md-block">
        <b-row>
          <b-col
            cols="6"
            align-self="center"
            class="d-none d-md-block font-weight-bolder"
            style="
                    flex-grow: 1;
                    font-size: 12px;
                    overflow: hidden;
                    position: relative;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    "
          >{{ conversation.contact_name }}</b-col>
          <b-col
            cols="6"
            align-self="center"
            class="d-none d-md-block font-weight-bolder"
            style="
                    flex-grow: 1;
                    font-size: 12px;
                    overflow: hidden;
                    position: relative;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    "
          >{{ lasTime }}</b-col>
          <b-col
            cols="12"
            align-self="center"
            class="d-none d-md-block font-weight-normal"
            style="
                    flex-grow: 1;
                    font-size: 13px;
                    overflow: hidden;
                    position: relative;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    "
          >{{ conversation.last_message }}</b-col>
        </b-row>
      </b-col>
    </b-row>
  </b-list-group-item>-->
</template>

<script>
export default {
  props: {
    conversations: Object,
  },
  data() {
    return {
      time: Date,
      fechabase: Date,
      state: {
        variantes: "Info",
        last_time_state: "",
      },
    };
  },
  mounted() {
    this.state.last_time_state = moment(
      this.conversation.last_time,
      "YYYY-MM-DD hh:mm:ss"
    )
      .locale("es")
      .fromNow();
    setInterval(() => {
      this.tiempoEspera();
    }, 1000);
    setInterval(() => {
      this.last_time_state_methodo();
    }, 1000);
  },
  methods: {
    tiempoEspera() {
      this.fechabase = moment().format("YYYY-MM-DD kk:mm:ss");
      if (this.fechabase < this.cincomin()) {
        this.cambioColor("light");
      } else if (
        this.fechabase >= this.cincomin() &&
        this.fechabase < this.diezmin()
      ) {
        this.cambioColor("Info");
      } else if (
        this.fechabase >= this.diezmin() &&
        this.fechabase < this.quincemin()
      ) {
        this.cambioColor("Warning");
      } else {
        this.cambioColor("Danger");
      }
    },
    cincomin() {
      return moment(this.conversation.last_time)
        .add(3, "minutes")
        .format("YYYY-MM-DD kk:mm:ss");
    },
    diezmin() {
      return moment(this.conversation.last_time)
        .add(5, "minutes")
        .format("YYYY-MM-DD kk:mm:ss");
    },
    quincemin() {
      return moment(this.conversation.last_time)
        .add(8, "minutes")
        .format("YYYY-MM-DD kk:mm:ss");
    },
    cambioColor(color) {
      //  console.log(color);
      this.state.variantes = color;
    },
    last_time_state_methodo() {
      this.state.last_time_state = moment(
        this.conversation.last_time,
        "YYYY-MM-DD hh:mm:ss"
      )
        .locale("es")
        .fromNow();
    },
  },
  computed: {
    variante() {
      return this.state.variantes;
    },
    lasTime() {
      return this.state.last_time_state;
    },

    conversation() {
      return this.conversations;
    },
  },
};
</script>
