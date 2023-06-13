<template>
  <div>
    <h3 class="text-2xl font-serif text-left py-2">Gestion des Interventions</h3>

    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100 ">
      <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
          <tr>
            <th scope="col" class="py-3 px-6">
             Intitule_intervention
            </th>
            <th scope="col" class="py-3 px-6">
             Etablissement
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Annee_univ
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Semestre
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
                Nbr_heures
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Date_debut
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Date_fin
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Etat
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              Operation
            </th>
  
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-b  " v-for="data in interv " :key="data">
            <th class="py-4 px-6 font-medium text-gray-900  ">
             {{ data.Intitule_Intervention }}
            </th>
            <th class="py-4 px-6 font-medium text-gray-900  ">
             {{ data.etab }}
            </th>
            <td class="py-4 px-6">
              {{ data.Annee_univ }}
            </td>
            
            <td class="py-4 px-6">
              {{ data.Semestre }}
            </td>
            <td class="py-4 px-6">
              {{ data.Nbr_heures }}
            </td>
            
            <td class="py-4 px-6">
              {{ data.Date_debut }}
            </td>
            <td class="py-4 px-6">
              {{ data.Date_fin }}
            </td>
            <td class="py-4 px-6">
              <span v-if="!data.visa_etb" class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">invalide</span>
              <span v-if="data.visa_etb" class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">valide</span>
            </td>
            <td class="py-4 px-6">
              <div class="inline-flex">
               <button v-if="!data.visa_etb"  class="bg-blue-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full" @click="validerinterv(data)">
                 valider
               </button>
               <button v-if="data.visa_etb" class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full" @click="invaliderinterv(data)">
                 invalider
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
import axios from 'axios';
export default {
  components: {},
data(){
  return {
      interv : []

  

  }
},
async mounted()
{
  const response = await axios.get('/directeuretabintervall')
  this.interv = response.data 
  console.log(this.interv)
},
methods:{
  
 async validerinterv(e)
  {
    const response = await axios.get('/valideretb/'+e.id_intervention)
    let index = this.interv.indexOf(e)
    this.interv[index].visa_etb = 1 ;
  },
   async invaliderinterv(e)
  {
    const response = await axios.get('/invalideretb/'+e.id_intervention)
    let index = this.interv.indexOf(e)
    this.interv[index].visa_etb = 0 ;
  },






}

}

</script>

<style>

</style>
