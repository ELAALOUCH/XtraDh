import axios from 'axios'

export default {
    namespaced: true,
    state: {
        token: null,
        user: null,
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
            console.log('failed')
        }
    }, 

    async attempt({commit,state}, token) {         
            try {          
                if(token){
                    commit('setToken',token )
                }
                if(!state.token){
                      return;
                }
                const response = await axios.get('/user-profile') 
                commit('setUser', response.data)                
            } catch (error) {              
                commit('setUser',null )
                commit('setToken',null )    
            }
        },
        
        logout({commit}){
            return  axios.post('/logout').then(()=>{
                commit('setUser',null)
                commit('setToken',null)
            })
        }

    }
}