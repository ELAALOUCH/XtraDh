import axios from 'axios'
export default{
   namespaced:true,
   state: {
   token:null,
   user:null
   },
   getters: {
    authenticated(state){
      return state.token && state.user;
    },
    user(state){
      return state.user
    }
   },

   mutations: {
     setToken(state,token){
       state.token=token
     },
     setUser(state,data){
       state.user=data
     }
   },
   actions: {
      async login({dispatch},credentials){ 
         try{
            const response = await axios.post('http://127.0.0.1:8000/api/login', credentials)
            
         //console.log(response.data) ;
         return dispatch('attempt',response.data.token)//access_token
         //console.log(response.data)
         }
         catch(error){
            console.log('Failed')
         }
       },

       async attempt( {commit,state},token){
         try {
          if(token){
           commit('setToken',token)
          }

          if(!state.token){
             return;
          }
            const response = await axios.get('http://127.0.0.1:8000/user-profile')

            commit('setUser',response.data)
            console.log('success')
         } catch (error) { 
          commit('setUser',null)
          commit('setToken',null)
        }
       } ,
       logout({ commit }) {
        return axios.post('auth/logout').then(() => {
            commit('setUser', null)
            commit('setToken', null)
        })
    }
   } 
  }