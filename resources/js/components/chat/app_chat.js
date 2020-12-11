import Vue from "vue";

Vue.component(
    "mensajes_componente",
    require("./mensajesPredefinidosComponent.vue").default
);
Vue.component("head_componente", require("./HeadMenuComponent.vue").default);
Vue.component("status_componente", require("./StatusContactComponent").default);
//Vue.component('messenger_componente',require('./MessengerComponent.vue') );
Vue.component("contact_componente", require("./ContactComponent.vue").default);
Vue.component("contactlist", require("./ContactListComponent.vue").default);
Vue.component(
    "conversationactiva",
    require("./ActiveConversationComponent.vue").default
);
Vue.component(
    "messageconversation",
    require("./MessageConversationComponent.vue").default
);
Vue.component("searchcontactlist", require("./SearchContactListComponent.vue").default);
Vue.component("historialList", require("./HistorialConversationComponent.vue").default);
Vue.component("TypeConsultaList", require("./typeconsultasComponent.vue").default);
Vue.component("DatosClientes", require("./DatosClientesComponent.vue").default);
Vue.component("CanalesClientes", require("./canalesComponent.vue").default);
Vue.component("transferencias", require("./TransferenciaComponent.vue").default);
Vue.component("buscar_conversation", require("./BuscarConversationComponent").default);
Vue.component("SearchConversation", require("./ConversationesSearchComponent").default);
Vue.component("footerAddCliente", require("./FooterAddClienteNewComponent").default);

//NUEVA PLANTILLA
Vue.component("izquierda_component", require("./vxizquierdaComponents").default);
Vue.component("derecha_component", require("./vxderechaComponent").default);
Vue.component("vxchats_component", require("./vxchatComponent").default);
Vue.component("vxnewchats_component", require("./vxnewchatComponent").default);
Vue.component("vxmiperfil_component", require("./vxmiperfilComponent").default);
Vue.component("vxajuste_component", require("./vxsettingComponent").default);
Vue.component("vxheadchat_component", require("./vxheaderchatComponent").default);
Vue.component("vxchatbody_component", require("./vxchatbodyComponent").default);
Vue.component("vxchatbodynada_component", require("./vxchatnada").default);
Vue.component("vxchatuserinfo_component", require("./vxuserinfoComponent").default);
Vue.component("vxhistorial_component", require("./vxhistorialcomponent").default);
Vue.component("vximagensubir", require("./vximagensubirComponent").default);
Vue.component("vxintegraciones", require("./vxchatIntegracionesActivasComponent").default);
Vue.component("messenger_Component", require("./MessengerComponent").default);
export default new Vue({});