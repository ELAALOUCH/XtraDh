<template>
    <div class="flex justify-center items-center h-screen bg-blue-400">
      <div class="w-96 bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-4xl font-bold mb-8 text-center" >Wait Please an email will be sent, check your email </h1>
        <button @click="startRedirect" type="submit" class="w-full bg-blue-500 text-white font-bold rounded-md py-2 px-4 hover:bg-blue-600">Back to login</button>
        <div v-if="isLoading" class="fixed top-0 left-30 right-0 bottom-30 flex items-center justify-center z-20">
      <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-gray-900"></div>
    </div>
  </div>

    </div>
  </template>

<script>
import Header from '@/components/Login/Header.vue'
import Footer from '@/components/Login/Footer.vue'
import axios from 'axios';
  export default{
    components:{Footer,Header},
    data() {
      return {
        email: '',
        isLoading: false,
      };
    },
    methods:{
      startRedirect() {
      const redirectTime = 2000; // Redirect after 5 seconds (5000 milliseconds)
      setTimeout(() => {
        this.$router.push('/'); // Replace with your desired route path
      }, redirectTime);
      this.isLoading=!this.isLoading
    }, getNonce() {
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
    }
    }

</script>
