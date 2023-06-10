<template>
    <!-- <div class="flex flex-col items-center mt-8">
      <h1 class="text-3xl font-bold mb-8">Téléchargement des fiches de paie</h1>
      
      <div v-for="item in Data" :key="item" class="flex items-center mb-4">
        <span class="mr-2 text-lg font-semibold">{{ item.annee }}:</span>
        <a :href="item.url" class="px-4 py-2 bg-blue-500 text-white rounded">Télécharger</a>
      </div>
    </div> -->
    <h3 class="text-3xl font-serif mb-8">Télécharger votre fiches de paie</h3>
    <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                  Année universitaire 
                </th>
                <th scope="col" class="px-6 py-3">
                    Etat 
                </th>
                <th scope="col" class="px-6 py-3">
                    Fiche
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b" v-for="item in Data" :key="item">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                  {{ item.annee }}
                </th>
                <td class="px-6 py-4">
                  <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Payée </span>
                </td>
                <td class="px-6 py-4">
                  <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                      <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                      <a :href="item.url">Télécharger</a>
                  </button>
                </td>

            </tr>
        </tbody>
    </table>
</div>  
  </template>
  <script>
  import axios from 'axios'
  export default {
    async mounted()
    {
      const response = await axios.get('/historiquepdfpaie')
        this.Data = response.data ; 
    } 
    ,data() {
      return {
        Data : []
      };
    },
    methods: {
      
      /*
      downloadPaySlip(year) {
        // Construire le lien de téléchargement du fichier PDF pour l'année spécifiée
        const downloadLink = `${this.apiEndpoint}${year}.pdf`;
        
        // Créer un élément <a> pour déclencher le téléchargement
        const link = document.createElement('a');
        link.href = downloadLink;
        link.download = `FichePaie_${year}.pdf`;
        
        // Simuler un clic sur le lien pour déclencher le téléchargement
        link.click();
      },*/
    },
  };
  </script>