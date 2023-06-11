<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Listes des directeurs d'établissement</h3>

      <div class="overflow-x-auto relative  sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="py-3 px-6">
              email
            </th>
            <th scope="col" class="py-3 px-6">
              type
            </th>
            <th scope="col" class="py-3 px-6">
              PPR
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Nom
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Prenom
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Etablissement
              </div>
            </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex justify-end" >
                  <create/>
                </div>
             </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in presi " :key="data.id_user">
              <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
               {{ data.email }}
              </th>
              <td class="py-4 px-6">
                {{data.type}}
              </td>
              <td class="py-4 px-6">
                {{ data.PPR }}
              </td>
              <td class="py-4 px-6">
                {{ data.Nom }}
              </td>
              <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
               {{ data.prenom }}
              </th>
              <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
               {{ data.etab_Nom }}
              </th>

              <td class="py-4 px-6 text-right">
                <div class="inline-flex">
                  <router-link :to="`/Gestiondeau/Edit/${data.id_user}`" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-l">
                    Edit
                </router-link>
                 <button   class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="deleteAdm(data)">
                   Delete
                 </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>


  </template>

  <script>
  import Create from '@/components/Dashboard/etab/Directeur/Create.vue'
  import axios from 'axios';
  export default {
    components: {Create},
  data(){
    return {
     presi:[]

    }
  },
  async mounted(){
    try {
      await axios.get('/directeuretab ').then(res=>{   
      console.log(res)
      this.presi=res.data
      })

    } catch (error) {
      
    } 
  },
  methods:{
    togglemodal(){
    this.showmodal=!this.showmodal
  },
  async deleteAdm(data)
  {
    const response = axios.delete('/deleteadm/'+data.id_user).then(()=>{
      let index = this.presi.indexOf(data);
      console.log(index)
      this.presi.splice(index,1);
    });
    console.log(response)
    

  }
}
 
  }
  </script>
