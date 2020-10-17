import Vuex from "vuex";
import Vue from "vue";
Vue.use(Vuex);
export default new Vuex.Store({
  state: {
    messages: [],
    clientes: [],
    clientesInfo: [],
    clientesInfocanal: [],
    agentes: [],
    paises: [],
    genero: [],
    documentos: [],
    selectedConversation: null,
    Consultas: [],
    EditCliente: [],
    Typeconsulta: null,
    conversations: [],
    Searchconversation: [],
    SearchconvertationID: [],
    Dashboardusuarios: [],
    Dashconsultas: [],
    DashMensajes: [],
    mensajesPre: [],
    querySearch: "",
    mensajeEnlaze: "",
    user_id: null,
    url_app: null,
    nombreuser: "",
    variantes: "",
    imagenUp: "",
    paginascontent: "",
    integraciones: [],
    integrados: [],
    facebook_callback_ul: "",
    companie: [],
    roles: [],
    userxid: [],
    user_companie: [],
  },

  mutations: {
    set_userxid(state, user) {
      state.userxid = user;
    },
    set_roles(state, roles) {
      state.roles = roles;
    },
    set_companies(state, companie) {
      state.companie = companie;
    },
    setuser_companies(state, users) {
      state.user_companie = users;
    },
    setfacebookcallback(state, callback) {
      state.facebook_callback_ul = callback;
    },
    setintegrados(state, integra) {
      state.integrados = integra;
    },
    setIntegraciones(state, integra) {
      state.integraciones = integra;
    },
    setpagina(state, pagina) {
      state.paginascontent = pagina;
    },
    setImagenUp(state, imagenup) {
      state.imagenUp = imagenup;
    },
    setVariant(state, variante) {
      state.variantes = variante;
    },
    setUser(state, user) {
      state.user_id = user;
    },
    setUrl(state, url_app) {
      state.url_app = url_app;
    },
    setAgentes(state, agentes) {
      state.agentes = agentes;
    },
    setName(state, nombre) {
      state.nombreuser = nombre;
    },
    predeterminados(state, mensajes) {
      state.mensajesPre = mensajes;
    },
    newMessageList(state, messages) {
      state.messages = messages;
    },
    newSearchConversationID(state, SearchconvertationID) {
      state.SearchconvertationID = SearchconvertationID;
    },
    newDashboardusuarios(state, Dashboardusuarios) {
      state.Dashboardusuarios = Dashboardusuarios;
    },
    newDashconsultas(state, Dashconsultas) {
      state.Dashconsultas = Dashconsultas;
    },
    newDashMensajes(state, DashMensajes) {
      state.DashMensajes = DashMensajes;
    },
    newClienteList(state, clientes) {
      state.clientes = clientes;
    },
    newclientesInfo(state, clientesInfo) {
      state.clientesInfo = clientesInfo;
    },
    newclientesInfocanal(state, clientesInfocanal) {
      state.clientesInfocanal = clientesInfocanal;
    },
    newPaisesList(state, paises) {
      state.paises = paises;
    },
    newGeneroList(state, genero) {
      state.genero = genero;
    },
    newDocumentoList(state, documentos) {
      state.documentos = documentos;
    },
    newConversationList(state, conversation) {
      //console.log("conversacion newconversation",conversations);
      state.conversations = conversation;
    },
    newSearchConversationList(state, Searchconversation) {
      //console.log("conversacion newconversation",conversations);
      state.Searchconversation = Searchconversation;
    },
    addMessage(state, message) {
      const conversation = state.conversations.find((conversation) => {
        return (
          conversation.contact_id == message.from_id ||
          conversation.contact_id == message.to_id
        );
      });

      const author = state.user_id === message.from_id ? "Tú" : "";
      conversation.last_message = `${author}:${message.content}`;
      conversation.last_time = message.created_at;
      //console.log('conversation123',conversation);
      if (
        state.selectedConversation.contact_id == message.from_id ||
        state.selectedConversation.contact_id == message.to_id
      ) {
        state.messages.push(message);
      }
    },
    addconsulta(state, coment) {
      state.Consultas.push(coment);
    },
    EditCliente(state, coment) {
      state.EditCliente.push(coment);
    },
    selectConversation(state, conversation) {
      state.selectedConversation = conversation;
    },
    newQuerySearch(state, newValue) {
      state.querySearch = newValue;
    },
    selectConsultas(state, consulta) {
      state.Consultas = consulta;
    },
    respuestaEnlaze(state, mensajeEnlaze) {
      state.mensajeEnlaze = mensajeEnlaze;
    },
    selectTypeConsultas(state, typeconsulta) {
      state.Typeconsulta = typeconsulta;
    },
  },
  actions: {
    getuserporid(context, userId) {
      return axios
        .get(`/get/usuario/${userId}`)
        .then((response) => {
          //console.log("response", response.data);
          context.commit("set_userxid", response.data);
        })
        .catch((error) => {
          console.log("error", error);
        });
    },
    getRols_dash(context) {
      return axios.get(`/get/rol`).then((response) => {
        //console.log("response", response.data);
        context.commit("set_roles", response.data);
      });
    },
    getCompanie_dash(context, userId) {
      return axios.get(`/get/companie/${userId}`).then((response) => {
        //console.log("response", response.data);
        context.commit("set_companies", response.data);
      });
    },
    getUserCompanie_dash(context, userId) {
      return axios.get(`/get/usuarios/companie/${userId}`).then((response) => {
        //console.log("response", response.data);
        context.commit("setuser_companies", response.data);
      });
    },
    getIntegraciones(context) {
      return axios.get("/api/v1/listar/integraciones").then((response) => {
        //console.log("response", response.data);
        context.commit("setIntegraciones", response.data);
      });
    },
    finalizarConversation(context, contactId) {
      return axios
        .get(`/api/Endconversations?contact_id=${contactId}`)
        .then((response) => {
          //context.commit('newConversationList',response.data);
        });
    },
    getServicios(context) {
      return axios.get("/api/servicios").then((response) => {
        context.commit("newClienteList", response.data[0].clientes);
        context.commit("newPaisesList", response.data[0].paises);
        context.commit("newGeneroList", response.data[0].generos);
        context.commit("newDocumentoList", response.data[0].documentos);
        context.commit("selectTypeConsultas", response.data[0].tipoconsulta);
        context.commit("setName", response.data[0].username);
        context.commit("predeterminados", response.data[0].mensajesPre);
        context.commit("setAgentes", response.data[0].agentes_online);
        // console.log(JSON.stringify(response.data[0].agentes_online));
        // context.commit('newClienteList',response.data);
      });
    },
    getMessages(context, conversation) {
      axios
        .get(`/api/messages?contact_id=${conversation.contact_id}`)
        .then((response) => {
          context.commit("newMessageList", response.data);
          context.commit("selectConversation", conversation);
        });
    },
    getSearchConvertationId(context, session_id) {
      return axios
        .get(`/api/search_messages?id=${session_id}`)
        .then((response) => {
          // console.log("primera conver", response);
          context.commit("newSearchConversationID", response.data);
        });
    },

    getConversation(context) {
      return axios.get("/api/conversations").then((response) => {
        context.commit("newConversationList", response.data);
      });
    },
    getSearchConversation(context) {
      return axios.get("/api/search_conversation").then((response) => {
        context.commit(
          "newSearchConversationList",
          response.data.conversations
        );
      });
    },
    getClientes(context) {
      return axios.get("/api/clientes").then((response) => {
        context.commit("newClienteList", response.data);
      });
    },
    getPaises(context) {
      return axios.get("/api/paises").then((response) => {
        context.commit("newPaisesList", response.data);
      });
    },
    getDocumento(context) {
      return axios.get("/api/documentos").then((response) => {
        context.commit("newDocumentoList", response.data);
      });
    },
    getGeneros(context) {
      return axios.get("/api/generos").then((response) => {
        context.commit("newGeneroList", response.data);
      });
    },
    getUserName(context) {
      return axios.get("/api/user").then((response) => {
        context.commit("setName", response.data.name);
      });
    },
    getMensajesPre(context) {
      return axios.get("/api/mensajespre").then((response) => {
        context.commit("predeterminados", response.data);
      });
    },
    getsearchAgent(context) {
      return axios.get("/api/agentes").then((response) => {
        context.commit("setAgentes", response.data);
      });
    },
    PostIntegraciones(context, usuario) {
      const parametros = { user_id: usuario };

      return axios
        .post("/api/v1/get/integraciones", parametros)
        .then((response) => {
          context.commit("setintegrados", response.data);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    //INTEGRACIONES
    PostUpdatewaping(context, parametros) {
      return axios
        .post("/api/update/waping", parametros)
        .then((response) => {
          // console.log(response);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    PostUpdateTelegram(context, parametros) {
      return axios
        .post("/api/update/telegram", parametros)
        .then((response) => {
          // console.log(response);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    PostUpdateFacebook(context, parametros) {
      return axios
        .post("/api/update/facebook", parametros)
        .then((response) => {
          context.commit("setfacebookcallback", response.data.webhook);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    PostUpdateDialogflow(context, parametros) {
      return axios
        .post("/api/update/dialogflow", parametros)
        .then((response) => {
          //console.log(response.data);
          //context.commit("setfacebookcallback", response.data.webhook);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    PostCreateUser(context, parametros) {
      return axios
        .post("/api/v1/create/user", parametros)
        .then((response) => {
          //console.log(response.data);
          //context.commit("setfacebookcallback", response.data.webhook);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    PostUpdateUser(context, parametros) {
      return axios
        .post("/api/v1/update/user", parametros)
        .then((response) => {
          // context.commit("getUserCompanie_dash", this.state.user_id);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    PostDeleteUser(context, parametros) {
      return axios
        .post("/api/v1/close/user", parametros)
        .then((response) => {
          // context.commit("getUserCompanie_dash", this.state.user_id);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    //INTEGRACIONES
    PostLogout(context) {
      return axios
        .post("/logout")
        .then((response) => {
          location.reload();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    PostInfoCliente(context, contact_id) {
      const params = { contact_id: contact_id };
      return axios
        .post("/api/clientesinformacion", params)
        .then((response) => {
          if (response.data.success) {
            context.commit("newclientesInfo", response.data.message);
          } else {
            context.commit("newclientesInfo", response.data.message);
          }
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    PostInfoClientecanal(context, contact_id) {
      const params = { contact_id: contact_id };
      axios
        .post("/api/canalescliente", params)
        .then((response) => {
          if (response.data.success) {
            context.commit("newclientesInfocanal", response.data.message);
          } else {
            context.commit("newclientesInfocanal", response.data.message);
          }
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    postMessages(context, newMessage) {
      const params = {
        to_id: context.state.selectedConversation.contact_id,
        content: newMessage,
        from_id: context.state.user_id,
        receptor: true,
        variant: "info",
        tipo: "texto",
        created_at: moment().format("YYYY-MM-DD HH:mm:ss"),
      };

      context.commit("addMessage", params);
      axios.post("/api/messages", params).then((response) => {
        if (response.data.success) {
          newMessage = "";
          const message = response.data.message;
          //console.log("response message",message);
          message.receptor = true;
          message.variant = "info";
          // context.commit('addMessage',message);
        }
      });
    },
    postImagen(context, newMessage) {
      const params = {
        to_id: context.state.selectedConversation.contact_id,
        content: newMessage,
        from_id: context.state.user_id,
        receptor: true,
        variant: "info",
        tipo: "image",
        created_at: moment().format("YYYY-MM-DD HH:mm:ss"),
      };
      // console.log(params);
      context.commit("addMessage", params);
      axios.post("/api/messages", params).then((response) => {
        if (response.data.success) {
          newMessage = "";
          const message = response.data.message;
          //console.log("response message",message);
          message.receptor = true;
          message.variant = "info";
          // context.commit('addMessage',message);
        }
      });
    },
    postVideo(context, newMessage) {
      const params = {
        to_id: context.state.selectedConversation.contact_id,
        content: newMessage,
        from_id: context.state.user_id,
        receptor: true,
        variant: "info",
        tipo: "video",
        created_at: moment().format("YYYY-MM-DD HH:mm:ss"),
      };
      // console.log(params);
      context.commit("addMessage", params);
      axios.post("/api/messages", params).then((response) => {
        if (response.data.success) {
          newMessage = "";
          const message = response.data.message;
          //console.log("response message",message);
          message.receptor = true;
          message.variant = "info";
          // context.commit('addMessage',message);
        }
      });
    },
    postFile(context, newMessage) {
      const params = {
        to_id: context.state.selectedConversation.contact_id,
        content: newMessage,
        from_id: context.state.user_id,
        receptor: true,
        variant: "info",
        tipo: "document",
        created_at: moment().format("YYYY-MM-DD HH:mm:ss"),
      };
      // console.log(params);
      context.commit("addMessage", params);
      axios.post("/api/messages", params).then((response) => {
        if (response.data.success) {
          newMessage = "";
          const message = response.data.message;
          //console.log("response message",message);
          message.receptor = true;
          message.variant = "info";
          // context.commit('addMessage',message);
        }
      });
    },
    postComentario(context, newcoment) {
      const params = {
        to_id: context.state.selectedConversation.contact_id,
        consulta: newcoment[0].comentario,
        type: newcoment[0].type,
        from_id: context.state.user_id,
        name: context.state.selectedConversation.agente,
        created_at: moment().format("YYYY-MM-DD HH:mm:ss"),
      };
      context.commit("addconsulta", params);
      axios.post("/api/consultas", params).then((response) => {
        if (response.data.success) {
          newcoment = "";
        }
      });
    },
    transferirChat(context, agente) {
      //console.log('transferencia',agente[1]);
      const params = {
        id: agente[0].id,
        nombre: agente[0].nombre,
        email: agente[0].email,
        contacto: agente[1].contacto,
      };

      axios.post("/api/transferir_chat", params).then((response) => {
        if (response.data.success) {
        }
      });
    },

    addclienteNew(context, clienteNew) {
      const params = {
        name: clienteNew[0].name,
        last: clienteNew[0].last,
        correo: clienteNew[0].correo,
        tipo_doc: clienteNew[0].tipo_doc,
        nip: clienteNew[0].nip,
        fecha_nac: clienteNew[0].fecha_nac,
        pais: clienteNew[0].pais,
        genero: clienteNew[0].genero,
        profesion: clienteNew[0].profesion,
      };

      axios.post("/api/addClienteNew", params).then((response) => {
        // console.log("response cliente", response);
        if (response.data.success) {
          // console.log("success addcliente", response.data.success);
          // console.log("message message", response.data.message);
        }
      });
    },
    postCliente(context, infoModal) {
      const params = {
        id: infoModal.id_,
        nombre: infoModal.first,
        apellido: infoModal.last,
        nip: infoModal.nip,
        correo: infoModal.correo,
        fecha: infoModal.fecha,
        pais: infoModal.pais,
        genero: infoModal.genero,
        tipo_nip: infoModal.tipo_nip,
        profesion: infoModal.profesion,
        created_at: moment().format("YYYY-MM-DD HH:mm:ss"),
        from_id: context.state.user_id,
      };
      axios.post("/api/clientes", params).then((response) => {
        if (response.data.success) {
        }
      });
    },
    EnlazarCliente(context, infoModal) {
      const params = {
        id: infoModal.id_,
        nombre: infoModal.first,
        apellido: infoModal.last,
        nip: infoModal.nip,
        correo: infoModal.correo,
        fecha: infoModal.fecha,
        pais: infoModal.pais,
        genero: infoModal.genero,
        tipo_nip: infoModal.tipo_nip,
        profesion: infoModal.profesion,
        created_at: moment().format("YYYY-MM-DD HH:mm:ss"),
        from_id: context.state.user_id,
        to_id: context.state.selectedConversation.contact_id,
      };

      axios.post("/api/enlazarclientes", params).then((response) => {
        if (response.data.error) {
          alert(response.data.message);
        }
        if (response.data.success) {
          alert("Usuario enlazado satisfactoriamente");
        }
      });
    },
    getConsulta(context, conversation) {
      axios
        .get(`/api/consultas?contact_id=${conversation.contact_id}`)
        .then((response) => {
          context.commit("selectConsultas", response.data);
        });
    },
    getTypeConsulta(context) {
      axios.get(`/api/typeconsultas`).then((response) => {
        context.commit("selectTypeConsultas", response.data);
      });
    },
    setVariantes(context, variante) {
      context.commit("setVariant", variante);
    },
    setImagenUps() {
      context.commit("setImagenUp", variante);
    },
    setpaginas(context, pagina) {
      context.commit("setpagina", pagina);
    },
    //DASHBOARD
    getDashboardusuarios(context) {
      return axios.get(`api/Dashcantusers`).then((response) => {
        context.commit("newDashboardusuarios", response.data);
      });
    },

    getDashboardconsultas(context) {
      return axios.get(`api/Dashconsultas`).then((response) => {
        context.commit("newDashconsultas", response.data);
      });
    },
    getDashboardmensajes(context) {
      return axios.get(`api/DashMensajes`).then((response) => {
        context.commit("newDashMensajes", response.data);
      });
    },
  },
  getters: {
    conversationsFiltered(state) {
      //ORDENANDO LOS EL MENSAJE MAS RECIENTE
      state.conversations.sort(function(a, b) {
        if (a.last_time < b.last_time) {
          return 1;
        }
        if (a.last_time > b.last_time) {
          return -1;
        }
        return 0;
      });
      //DEVOLVIENDO LISTA DE MENSAJES ORDENADOS POR MAS RECIENTES
      return state.conversations.filter((conversation) =>
        conversation.contact_name
          .toLowerCase()
          .includes(state.querySearch.toLowerCase())
      );
    },
    getconversationById(state) {
      return function(conversationId) {
        return state.conversations.find(
          (conversation) => conversation.id == conversationId
        );
      };
    },
  },
});
