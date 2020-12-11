import Vuex from "vuex";
import Vue from "vue";
Vue.use(Vuex);
export default new Vuex.Store({
  state: {
    user_companie: [],
  },
  mutations: {
    setuser_companies(state, users) {
      state.user_companie = users;
    },
  },
  actions: {
    getUserCompanie_dash(context, userId) {
      return axios.get(`/get/usuarios/companie/${userId}`).then((response) => {
        console.log("response", response.data);
        //context.commit("setuser_companies", response.data);
      });
    },
  },
  getters: {},
});
