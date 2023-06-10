<template>
    <div class="flex flex-col items-center mt-8">
      <h1 class="text-3xl font-bold mb-8">Téléchargement des fiches de paie</h1>
      
      <div v-for="item in Data" :key="item" class="flex items-center mb-4">
        <span class="mr-2 text-lg font-semibold">{{ item.annee }}:</span>
        <a :href="item.url" class="px-4 py-2 bg-blue-500 text-white rounded">Télécharger</a>
      </div>
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
      
    },
  };
  </script>