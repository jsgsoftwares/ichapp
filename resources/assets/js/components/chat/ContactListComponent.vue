<template>
  <div class="chat-leftbar">
    <div class="tab-content" id="pills-tab-justifiedContent">
      <vxchats_component />
      <vxnewchats_component />
      <vxmiperfil_component />
      <vxajuste_component />
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
