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
            const response = await axios.post(/*url , credentials*/)
            
         //console.log(response.data) ;
         return dispatch('attempt',response.data.access_token)
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
            const response = await axios.get('/* user profile  url*/')

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