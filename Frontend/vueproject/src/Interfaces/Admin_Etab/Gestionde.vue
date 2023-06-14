<template>
 <section class="container mx-auto p-6 font-mono">
  <h3 class="text-2xl font-serif text-left pb-4">Listes des directeurs d'établissement</h3>
  <div class="w-full mb-8 overflow-hidden rounded-lg ">
    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100 ">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">PPR</th>
            <th class="px-4 py-3">NOM</th>
            <th class="px-4 py-3">PRENOM</th>
            <th class="px-4 py-3"> EMAIL</th>
            <th class="px-4 py-3"> ETABLISSEMENT</th>
            <th class="px-4 py-3"> TYPE </th>
            <th scope="col" class="py-3 px-2">
              <div class="flex justify-center" >
                <create :test="test"/>
              </div> 
           </th> 
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="text-gray-700" v-for="data in presi " :key="data.id_user">
            <td class="px-4 py-3 text-ms font-semibold border">
              {{ data.PPR }}
            </td>
            <td class="px-4 py-3 border"> 
              <div class="flex items-center text-sm">
                <div>
                  <p class="font-semibold text-black">{{ data.Nom }} </p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.prenom }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.email }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.etab_Nom }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.type }}</td>
            <td class="py-4 px-6 text-right">
                <div class="inline-flex">
                  <router-link :to="`/Gestionde/Edit/${data.id_user}`" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full mx-2 ">
                    Modifier
                </router-link>
                 <button   class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full " @click="deleteAdm(data)">
                   Supprimer
                 </button>
                </div>
              </td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

  </template>

  <script>
  import Create from '@/components/Dashboard/etab/Directeur/Create.vue'
  import axios from 'axios';
  export default {
    components: {Create},
  data(){
    return {
     presi:[],
      test : 0 
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
