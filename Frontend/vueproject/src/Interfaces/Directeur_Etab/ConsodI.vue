<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Consultation des interventions</h3>

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
                  Nbr_heures
              </th>
              <th scope="col" class="py-3 px-6">
                  Visa_uae
              </th>
              <th scope="col" class="py-3 px-6">
                Visa_etb
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in cons " :key="data.id">
              <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
      {{ data.intervention ? data.intervention.Intitule_Intervention : '' }}
    </th>
    <td class="py-4 px-6">
      {{ data.intervention ? data.intervention.Annee_univ : '' }}
    </td>
    <td class="py-4 px-6">
      {{ data.intervention ? data.intervention.Semestre : '' }}
    </td>
    <td class="py-4 px-6">
      {{ data.intervention ? data.intervention.Date_debut : '' }}
    </td>
    <td class="py-4 px-6">
      {{ data.intervention ? data.intervention.Date_fin : '' }}
    </td>
    <td class="py-4 px-6">
      {{ data.intervention ? data.intervention.Nbr_heures : '' }}
    </td>
    <td class="py-4 px-6">
      {{ data.intervention ? data.intervention.visa_etb : '' }}
    </td>
    <td class="py-4 px-6">
      {{ data.intervention ? data.intervention.visa_uae : '' }}
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
        cons:''
    }
  },
  async mounted(){
  const response = await axios.get('/Enseignant');
   this.cons=response.data
   console.log(response.data)

  },}
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


  },*/


  </script>
