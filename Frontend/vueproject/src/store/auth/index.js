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
             dispatch('attempt',response.data.token)
             return response.data

        } catch (error) {
            console.log('failed abroo')
        }}
        ,     
           async attempt({commit,state}, token) {         
            try {          
                if(token){
                    commit('setToken',token )
                }
                if(!state.token){
                      return;
                }
                const response = await axios.get('/user-profile') 
                console.log(response)         
                commit('setUser', response.data)

                console.log('success')
                
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