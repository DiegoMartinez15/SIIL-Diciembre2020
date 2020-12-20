import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'



Vue.use(Vuex)


export default new Vuex.Store({
    state: {
        token: '',
        name: '',
        role: '',
        idaspirante: '',
        usuarioLog:[],
        avatar:'',

    },
    getters: {

    },
    mutations: {
        add(state, payload) {
            if (payload != null) {
                state.name = payload;
                return
            }
        },
        permission(state, payload) {
            if (payload != null) {
                state.role = payload;
                return
            }
        },
        setid(state, payload) {
            if (payload != null) {
                state.idaspirante = payload;
                return
            }

        },
        setAdmin(state, payload){
            if(payload != null){
                state.usuarioLog = payload;
                return
            }
        },

        setNameAvatar(state, payload){
            if(payload != null){
                state.usuarioLog = payload;
                return
            }
        },

    },
    actions: {},

    modules: {

    },
    plugins: [createPersistedState()]
})