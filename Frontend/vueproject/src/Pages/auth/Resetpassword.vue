<template>
    <div class="flex justify-center items-center h-screen bg-gray-100">
      <div class="w-96 bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Réinitialiser votre mot de passe</h1>
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label for="password" class="block text-gray-700">Nouveau mot de passe</label>
            <input v-model="password" id="password" type="password" class="w-full border border-gray-300 focus:ring focus:ring-blue-200 rounded-md px-4 py-2">
          </div>
          <div>
            <label for="confirmPassword" class="block text-gray-700">Confirmation de mot de passe</label>
            <input v-model="confirmPassword" id="confirmPassword" type="password" class="w-full border border-gray-300 focus:ring focus:ring-blue-200 rounded-md px-4 py-2">
          </div>

          <div class="flex justify-between items-center">
            <button type="submit" class="w-full bg-blue-500 text-white font-bold rounded-md py-2 px-4 hover:bg-blue-600">Réinitialiser</button>
          </div>

          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" v-show="error">
        <span class="block sm:inline" >{{error}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">

  </span>
</div>
        </form>
      </div>
    </div>
  </template>

  <script>

import axios from 'axios';
import { createLogger } from 'vuex';
  export default {
    data() {
      return {
        email: '',
        password: '',
        confirmPassword: '',
        error:''
      };
    },
    methods: {
      async submitForm() {
          try{
      let response =  await axios.post('/reset',{
          password : this.password,
          password_confirm : this.confirmPassword,
          token: this.$route.params.token,
        });
        this.$router.push('/')
          }catch(error){
          this.error =  error.response.data.errors.password_confirm[0]
        }


      },
  }
   
  };
  </script>
