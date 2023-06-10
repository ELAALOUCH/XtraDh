<template>
  <div>
    <div class="flex justify-between items-center">
      <h3 class="text-2xl font-bold text-left py-2">Consulter votre procédure de paiement de l'année en cours</h3>

      <router-link to="/ancienfiche">
        <button class="py-2 px-4 my-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Anciennes fiches de paie</button>
      </router-link>
    </div>

    <div class="overflow-x-auto relative sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Etablissement
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Volume Horraire
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Taux_Horraire
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Salaire Brute
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Import sur revenu
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Salaire Net
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Annee_univirsitaire
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  semestre
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b " v-for="data in paiements" :key="data.id">
             
              <td class="py-4 px-6">
                {{ data.Nom }}
              </td>
              <td class="py-4 px-6">
                {{ data.VH }}
              </td>
              <td class="py-4 px-6">
                {{ data.Taux_H }}
              </td>
              <td class="py-4 px-6">
                {{ data.Brut }}
              </td>
              <td class="py-4 px-6">
                {{ data.IR }}
              </td>
              <td class="py-4 px-6">
                {{ data.NET }}
              </td>
              <td class="py-4 px-6">
                {{ data.Annee_univ }}
              </td>
              <td class="py-4 px-6">
                {{ data.Semestre }}
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
    data() {
      return {
        paiements: [
          
        ]
      };
    },
    async mounted()
    {
      const response = await axios.get('paiementprof')
      this.paiements = response.data 
      console.log(response.data)
      
    }
  };
  </script>
