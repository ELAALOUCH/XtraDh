<template>

    <section class="container mx-auto p-6 font-mono">
    <h3 class="text-2xl font-serif text-left pb-4">Consulter vote procédure de paiement d'année en cours</h3>
    <div class="w-full mb-8 overflow-hidden rounded-lg ">
    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100 ">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Etablissement</th>
            <th class="px-4 py-3">Volume Horraire</th>
            <th class="px-4 py-3">Taux_Horraire</th>
            <th class="px-4 py-3">Salaire Brut</th>
            <th class="px-4 py-3">Import sur revenu</th>
            <th class="px-4 py-3">Salaire Net</th>
            <th class="px-4 py-3">Annee_univirsitaire</th>
            <th class="px-4 py-3">Semestre</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="text-gray-700" v-for="data in paiements" :key="data.id">
            <td class="px-4 py-3 border">
              <div class="flex items-center text-sm">
                <div>
                  <p class="font-semibold text-black">{{ data.Nom }} </p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.VH }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">
              {{ data.Taux_H }}
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Brut }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.IR }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.NET }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Annee_univ }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Semestre }}</td>
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
