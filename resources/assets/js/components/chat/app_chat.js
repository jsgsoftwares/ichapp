import Vue from "vue";

Vue.component(
  "mensajes_componente",
  require("./mensajesPredefinidosComponent.vue")
);
Vue.component("head_componente", require("./HeadMenuComponent.vue"));
Vue.component("status_componente", require("./StatusContactComponent"));
//Vue.component('messenger_componente',require('./MessengerComponent.vue') );
Vue.component("contact_componente", require("./ContactComponent.vue"));
Vue.component("contactlist", require("./ContactListComponent.vue"));
Vue.component(
  "conversationactiva",
  require("./ActiveConversationComponent.vue")
);
Vue.component(
  "messageconversation",
  require("./MessageConversationComponent.vue")
);
Vue.component("searchcontactlist", require("./SearchContactListComponent.vue"));
Vue.component("historialList", require("./HistorialConversationComponent.vue"));
Vue.component("TypeConsultaList", require("./typeconsultasComponent.vue"));
Vue.component("DatosClientes", require("./DatosClientesComponent.vue"));
Vue.component("CanalesClientes", require("./canalesComponent.vue"));
Vue.component("transferencias", require("./TransferenciaComponent.vue"));
Vue.component("buscar_conversation", require("./BuscarConversationComponent"));
Vue.component("SearchConversation", require("./ConversationesSearchComponent"));
Vue.component("footerAddCliente", require("./FooterAddClienteNewComponent"));

//NUEVA PLANTILLA
Vue.component("izquierda_component", require("./vxizquierdaComponents"));
Vue.component("derecha_component", require("./vxderechaComponent"));
Vue.component("vxchats_component", require("./vxchatComponent"));
Vue.component("vxnewchats_component", require("./vxnewchatComponent"));
Vue.component("vxmiperfil_component", require("./vxmiperfilComponent"));
Vue.component("vxajuste_component", require("./vxsettingComponent"));
Vue.component("vxheadchat_component", require("./vxheaderchatComponent"));
Vue.component("vxchatbody_component", require("./vxchatbodyComponent"));
Vue.component("vxchatbodynada_component", require("./vxchatnada"));
Vue.component("vxchatuserinfo_component", require("./vxuserinfoComponent"));
Vue.component("vxhistorial_component", require("./vxhistorialcomponent"));
Vue.component("vximagensubir", require("./vximagensubirComponent"));

export default new Vue({});
