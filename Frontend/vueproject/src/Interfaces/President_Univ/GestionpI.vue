<template>
 <section class="container w-full mx-auto p-6 font-mono">
  <h3 class="text-2xl font-serif text-left pb-4">Gestion des Interventions</h3>
  <div class="w-full mb-8 overflow-hidden rounded-lg ">
    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-200 ">
      <table class="w-full">
        <thead>
          <tr class="text-sm  tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-2 py-3">Nom</th>
            <th class="px-2 py-3">Prenom</th>
            <th class="px-2 py-3">intervention</th>
            <th class="px-2 py-3"> Etab</th>
            <th class="px-2 py-3"> Annee</th>
            <th class="px-2 py-3"> Semestre </th>
            <th class="px-2 py-3"> Nbr_hrs</th>
            <th class="px-2 py-3"> debut </th>
            <th class="px-2 py-3"> fin </th>
            <th class="px-2 py-3"> Etat </th>
            <th class="px-2 py-3"> action </th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="text-gray-700"  v-for="data in interv " :key="data">
            <td class="px-2 py-3 text-sm  border">{{ data.prof_Nom }}</td>
            <td class="px-2 py-3 text-sm  border">
              {{ data.prenom }}
            </td>
            <td class="px-2 py-3 border">
              <div class="flex items-center text-sm">
                <div>
                  <p class=" text-black">{{ data.Intitule_Intervention }} </p>
                </div>
              </div>
            </td>
            <td class="px-2 py-3 text-sm  border">{{ data.Nom_etb }}</td>
            <td class="px-2 py-3 text-sm  border">{{ data.Annee_univ }}</td>
            <td class="px-2 py-3 text-sm  border">{{ data.Semestre }}</td>
            <td class="px-2 py-3 text-sm  border text-center">{{ data.Nbr_heures }}</td>
            <td class="px-2 py-3 text-sm  border"> {{ data.Date_debut }}</td>
            <td class="px-2 py-3 text-sm  border">{{ data.Date_fin }}</td>
            <td class="px-2 py-3 text-sm  border">
              <span v-if="!data.visa_uae" class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">invalide</span>
              <span v-if="data.visa_uae" class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">valide</span>
              </td>
              <td class="px-2 py-3 text-sm  border">
                <div class="inline-flex">
               <button v-if="!data.visa_uae"  class="bg-blue-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full" @click="validerinterv(data)">
                 valider
               </button>
               <button v-if="data.visa_uae" class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full" @click="invaliderinterv(data)">
                 invalider
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
  const response = await axios.get('/intervention')
  this.interv = response.data 
},
methods:{
  
 async validerinterv(e)
  {
    const response = await axios.get('/valideruae/'+e.id_intervention)
    console.log(response)
    let index = this.interv.indexOf(e)
    this.interv[index].visa_uae = 1 ;
  },
   async invaliderinterv(e)
  {
    const response = await axios.get('/invalideruae/'+e.id_intervention)
    let index = this.interv.indexOf(e)
    this.interv[index].visa_uae = 0 ;
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
