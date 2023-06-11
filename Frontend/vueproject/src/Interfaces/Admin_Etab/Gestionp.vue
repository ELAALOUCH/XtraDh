<template>
  <section class="container mx-auto p-6 font-mono">
  <h3 class="text-2xl font-serif text-left pb-4">Listes des profs</h3>
  <div class="w-full mb-8 overflow-hidden rounded-lg ">
    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100 ">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">PPR</th>
            <th class="px-4 py-3">NOM</th>
            <th class="px-4 py-3">PRENOM</th>
            <th class="px-4 py-3"> DATE DE NAISSANCE</th>
            <th class="px-4 py-3"> ETABLISSEMNT</th>
            <th class="px-4 py-3"> GRADE</th>
            <th class="px-4 py-3"> TYPE </th>
            <th scope="col" class="py-3 px-2">
              <div class="flex justify-center" >
                <Create :test="test" />
              </div> 
           </th> 
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="text-gray-700" v-for="data in profs " :key="data.id">
            <td class="px-4 py-3 border">
              <div class="flex items-center text-sm">
                <div>
                  <p class="font-semibold text-black">{{ data.PPR }} </p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Nom }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">
              {{ data.prenom }}
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Date_Naissance }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.etab_permanant.Nom }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.grade.designation }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.user.type }}</td>
            <td class="border-solid border-2 border-gray-100 py-4 px-6 text-right">
              <div class="inline-flex">
                <div class="py-4 px-6 text-right">
              <div class="inline-flex">
                <router-link :to="`/Gestionp/Edit/${data.id}`" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mx-2 rounded-full">
                Editer
                </router-link>
               <button class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full " @click="deleteprof(data)">
                Supprimer
               </button>                  
              </div>
            </div>                
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
import axios from 'axios';
import Create from '@/components/Dashboard/Prof/Create.vue';

export default {
  components: { Create },
  data() {
    return {
      profs: null,
      showModal: false,
      test : 0
    };
  },
  methods: {
    async deleteprof(id){
      console.log(id.user.id_user)
      const response = await axios.delete('/deleteprof/'+id.user.id_user)
      console.log(response)
      let index = this.profs.indexOf(id)
      this.profs.splice(index,1)
    }
  
  },
  async mounted() {
      try {
        await axios.get('/profetab').then(res => {
          console.log(res)
          this.profs=res.data
        })
        this.showModal = false;
      } catch (error) {
        console.error(error);
      }
    }
    
  }
</script>

