<template>
  <div class="pl-0" fluid style="height: calc(100vh - 67px)">
    <div class="chat-layout" v-if="subscr">
      <!-- <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner"></b-spinner> -->
      <izquierda_component  />
      <derecha_component
        v-if="selectConversation"
        :contactId="selectConversation.contact_id"
        :contactName="selectConversation.contact_name"
        :icono_perfil="selectConversation.icon"
        :interno="selectConversation.interno"
        v-on:messageCreate="addmessageCreate($event)"
        :status="true"
      ></derecha_component>
      <derecha_component v-else :status="false" />
    </div>
<div  v-else><spinner/></div>
  </div>
</template>
<script>
export default {
  props: {
    user_id: Number,
    url_app: String,
  },
  data() {
    return {
      querySearch: "",
      state:{subs:false}
    };
  },
  mounted() {
    this.$store.commit("setUser", this.user_id);
    this.$store.commit("setUrl", this.url_app); 
    //console.log(this.user_id);
    this.$store.dispatch("getSubscripciones", this.user_id).then(()=>{
     // console.log(this.$store.state.subscripcion);
      this.state.subs=true;
          
    
    
    });
     this.$store.dispatch("getServicios");
    this.$store.dispatch("getIntegraciones");
   
   

    
/*     this.$store.commit("setUser", this.user_id);
    this.$store.commit("setUrl", this.url_app); */

    this.$store.dispatch("getConversation").then(() => {
      const conversationId = this.$route.params.conversationId;
      if (conversationId) {
        const conversation = this.$store.getters.getconversationById(
          conversationId
        );
        this.$store.dispatch("getMessages", conversation);
        this.$store.dispatch("getConsulta", conversation);
        this.$store.dispatch("PostInfoClientecanal", conversation.contact_id);
        this.$store.dispatch("PostInfoCliente", conversation.contact_id);
      }
    });

    Echo.channel(`users.${this.$store.state.user_id}`).listen("MessageSent", (data) => {
      const message = data.message;
      message.receptor = false;
      this.$store.dispatch("getConversation");
      this.addmessageCreate(message);
    });

    Echo.join(`messenger`)
      .here((users) => {
        this.$store.dispatch("getConversation");
        users.forEach((user) => this.changeStatus(user, true));
        //this.$store.dispatch('getsearchAgent');
        //this.$store.dispatch('getTypeConsulta');
        /* console.log("getconvertacion de here"); */
      })
      .joining((user) => {
        this.$store.dispatch("getConversation");
        this.changeStatus(user, true);
        this.$store.dispatch("getsearchAgent");
        //this.$store.dispatch('getTypeConsulta');
      })
      .leaving((user) => {
        this.$store.dispatch("getConversation");
        this.changeStatus(user, false);
        this.$store.dispatch("getsearchAgent");
        //this.$store.dispatch('getTypeConsulta');
      });
  },
  methods: {
    changeStatus(user, status) {
      const index = this.$store.state.conversations.findIndex(
        (conversation) => {
          return conversation.contact_id == user.id;
        }
      );
      if (index >= 0) {
        this.$set(this.$store.state.conversations[index], "online", status);
      }
    },
    addmessageCreate(message) {
      this.$store.commit("addMessage", message);
    },
  },
  computed: {
    selectConversation() {
      //console.log("selecciona",this.$store.state.selectedConversation)
      return this.$store.state.selectedConversation;
    },
    conversationsFiltradas() {
      //return this.conversations.filter((conversation)=>conversation.contact_name.includes(this.querySearch))
    },
    subscr(){
      return this.state.subs;
    },
  },
};
</script>