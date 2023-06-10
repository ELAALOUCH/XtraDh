<template>
  <div>
    <h3 class="text-2xl font-bold text-left py-2">Gestion des Interventions</h3>

    <div class="overflow-x-auto relative  sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="py-3 px-6">
             Intitule_intervention
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
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in interv " :key="data">
            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
             {{ data.Intitule_Intervention }}
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
              <span v-if="!data.visa_etb" class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">invalide</span>
              <span v-if="data.visa_etb" class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">valide</span>
            </td>
            <td class="py-4 px-6 text-right">
              <div class="inline-flex">
               <button v-if="!data.visa_etb"  class="bg-blue-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="validerinterv(data)">
                 valider
               </button>
               <button v-if="data.visa_etb" class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="invaliderinterv(data)">
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










  /*getNonce() {
        axios.get('/api/get-nonce')
          .then(response => {
            const nonce = response.data.nonce;

            const scriptElement = document.createElement('script');
            scriptElement.setAttribute('nonce', nonce);
            scriptElement.src = 'index.js';
            document.head.appendChild(scriptElement);

            const styleElement = document.createElement('style');
            styleElement.setAttribute('nonce', nonce);
            styleElement.innerHTML = `
              .my-style {
                color: red;
              }
            `;
            document.head.appendChild(styleElement);
          })
          .catch(error => {
            console.error('Erreur lors de la récupération du nonce:', error);
          });
      }
    },
    created() {
      this.getNonce();

    }*/
}

}

</script>

<style>

</style>
