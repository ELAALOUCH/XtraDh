<template>
    <div class="flex flex-col items-center mt-8">
      <h1 class="text-3xl font-bold mb-8">Téléchargement des fiches de paie</h1>
      
      <div v-for="year in years" :key="year" class="flex items-center mb-4">
        <span class="mr-2 text-lg font-semibold">{{ year }}:</span>
        <button @click="downloadPaySlip(year)" class="px-4 py-2 bg-blue-500 text-white rounded">Télécharger</button>
      </div>
    </div>
  </template>
  <script>
  export default {
    data() {
      return {
        years: [2019, 2020, 2021], // Les années disponibles
        apiEndpoint: 'http://exemple-api.com/fiches-paie/', // URL de l'API pour le téléchargement des fiches de paie
      };
    },
    methods: {
      downloadPaySlip(year) {
        // Construire le lien de téléchargement du fichier PDF pour l'année spécifiée
        const downloadLink = `${this.apiEndpoint}${year}.pdf`;
        
        // Créer un élément <a> pour déclencher le téléchargement
        const link = document.createElement('a');
        link.href = downloadLink;
        link.download = `FichePaie_${year}.pdf`;
        
        // Simuler un clic sur le lien pour déclencher le téléchargement
        link.click();
      },
    },
  };
  </script>