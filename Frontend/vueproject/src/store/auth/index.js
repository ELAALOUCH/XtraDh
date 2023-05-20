import axios from 'axios'

export default {
    namespaced: true,
    state: {
        token: null,
        user: null
    },
    mutations: {
        setToken(state, token) {
            state.token = token
        },
        setUser(state, data) {
            state.user = data
        }
    },
    getters: {
        authenticated(state) {
            return state.token && state.user;
        },
        user(state) {
            return state.user
        }
    },
    actions: {
        async submit({dispatch},credentials){
           try {
            const response = await axios.post('/login',credentials)
             return dispatch('attempt',response.data.token)
        } catch (error) {
            console.log(error)         
           } 
           },
        async attempt({commit}, token) {         
            try {          
                const response = await axios.get('/user-profile',{
                    headers:{'Authorization': ` Bearer ${token}`}
                })
                commit('setUser', response.data)
                commit('setToken',token )
                console.log('success')
            } catch (error) {
               console.error('failed2')             
            }
        }

    }
}