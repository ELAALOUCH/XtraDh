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
       async attempt( {commit},token){
         try {
            const response = await axios.get('/* user profile */' ,{
               headers:{'Authorization':`Bearer ${token}` }
            })

            commit('setToken',token)
            commit('setUser',response.data)
            console.log('success')
         } catch (error) { 
             console.log('error 2')
         }
       } 
   }, 
}