<template>
    <div class="flex items-center justify-center h-screen">
      <div class="bg-white rounded-lg shadow-lg p-4">       
        <h5 class="text-3xl text-center">{{ message }}</h5>
        <router-link to="/" class="block text-center text-blue-500 mt-4 hover:underline font-semibold">BACK TO LOGIN</router-link>
        
      </div>
    </div>
  </template>
  
  <script>
  import Header from '@/components/Login/Header.vue'
  import Footer from '@/components/Login/Footer.vue'
  
  export default {
    components: { Footer, Header },
    data() {
      return {
        message: '404 | Not found',
      }
    }
  }
  </script>