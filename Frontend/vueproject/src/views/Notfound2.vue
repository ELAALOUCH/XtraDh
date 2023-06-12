<template>
    <div class="flex items-center justify-center h-screen">
      <div class="bg-white rounded-lg shadow-lg p-4">       
        <h5 class="text-3xl text-center">{{ message }}</h5>
        <router-link to="/" class="block text-center text-blue-500 mt-4 hover:underline font-semibold">Retour à l'accueil</router-link>
        
      </div>
    </div>
  </template>
  
  <script>

  export default {
    data() {
      return {
        message: '404 | Introuvable',
      }
    }
  }
  </script>