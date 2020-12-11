<template>
  <div style="height: calc(100vh - 121px)">
    <div
      class="tab-pane fade show active"
      id="pills-chat-justified"
      role="tabpanel"
      aria-labelledby="pills-chat-tab-justified"
    >
      <div class="chat-listbar">
        <vxheadchat_component />
        <vxintegraciones/>
        <searchcontactlist />

        <b-list-group>
          <div class="chat-left-body">
            <contact_componente
              v-for="conversation in conversationsFiltered"
              :key="conversation.id"
              @click.native="selectConversation(conversation)"
              :conversations="conversation"
              style="
                z-index: 3;
                transition: none 0s ease 0s;
                height: 72px;
                transform: translateY(0px);
              "
            ></contact_componente>
          </div>
        </b-list-group>
        <div>
          <b-modal
            size="lg"
            v-model="show"
            id="modal-buscarConvert"
            title="Buscar conversaciones"
            ok-only
          >
            <b-card
              no-body
              header-text-variant="white"
              header-tag="header"
              header-bg-variant="dark"
            >
              <b-card-body class="card_style">
                <SearchConversation></SearchConversation>
              </b-card-body>
            </b-card>
          </b-modal>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      show: false,
    };
  },
  mounted() {
    //this.getConversation()
  },
  methods: {
    refresh_search_conv() {
      this.$store.dispatch("getSearchConversation").then(() => {
        this.show = true;
      });
    },

    selectConversation(conversation) {
      this.$router.push(`/chat/${conversation.id}`, () => {
        this.$store.dispatch("getMessages", conversation);
        this.$store.dispatch("getConsulta", conversation);
        this.$store.dispatch("getTypeConsulta", conversation);
        this.$store.dispatch("PostInfoClientecanal", conversation.contact_id);
        this.$store.dispatch("PostInfoCliente", conversation.contact_id);
      });
      //
      // this.$emit("selectChangeConversation",conversation);
    },
  },
  computed: {
    selectedConversation() {
      return this.$store.state.selectedConversation;
    },
    conversationsFiltered() {
      return this.$store.getters.conversationsFiltered;
    },
  },
};
</script>
