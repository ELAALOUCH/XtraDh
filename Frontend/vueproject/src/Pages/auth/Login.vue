<template>
    <div class="flex flex-col md:flex-row h-screen items-center">
      <div class="bg-blue-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
        <img src="@/assets/images/AF1QipPd4KGT1xMp13QlE4z_5-CuAMb52cNEd-AmuNrcw1600-h1000-k-no.jpeg" alt="" class="w-full h-full object-cover">
      </div>

      <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center">
        <div class="w-full h-100">
          <h1 class="text-sky-600 text-6xl text-center">XtraDh</h1>

          <form @submit.prevent="submitlogin()" class="mt-6">
            <div>
         <label for="email" class="block text-gray-700">Email Address</label>
         <input v-model="user.email" type="email"  id="email" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required >
       </div>

       <div class="mt-4">
    <label for="password" class="block text-gray-700">Password</label>
    <div class="relative">
      <input v-model="user.password" :type="passwordFieldType" id="password" placeholder="Enter Password" required class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none">
      <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
        <svg class="h-8 w-8 text-dark cursor-pointer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" @click="togglePasswordVisibility">
          <circle cx="12" cy="12" r="2" />
          <path v-if="!showPassword" d="M3 12l2.5 2.5a6.5 6.5 0 0 0 10.95 -3.5a6.5 6.5 0 0 0 -10.95 -3.5l-2.5 2.5" />
          <path v-if="showPassword" d="M2 12l4 4l6 -6" />
        </svg>
      </div>
    </div>
  </div>

       <div class="flex p-4 mb-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50 " role="alert"  v-show="error" >
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd">
              </path>
            </svg>
           <span class="sr-only">Info</span>
            <div>
                  <span class="font-medium">  {{ error }} </span>
            </div>
        </div>

       <router-link to="/Forgetpassword" class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700 mt-2" >
         Forgot Password ?
       </router-link>

       <button type="submit" class="w-full block bg-blue-500 hover:bg-blue-400 focus:bg-blue-400 text-white font-semibold rounded-lg
        px-4 py-3 mt-6">Log In
      </button>

          </form>

     <hr class="my-6 border-gray-300 w-full">
     <p class="text-sm text-gray-500 mt-12">&copy; 2023 UAE - All Rights Reserved.</p>
   </div>

 </div>
 </div>
 </template>

<script>
import { mapGetters, mapActions } from 'vuex'
import axios from 'axios';
import Header from '@/components/Login/Header.vue';
import Footer from '@/components/Login/Footer.vue';

export default {

  data() {
        return {
            user: {
                email:'',
                password:'',
            },
            error:'',
            showPassword: false,
       }
    },
    computed: {
      passwordFieldType() {
        return this.showPassword ? 'text' : 'password';
      },
      ...mapGetters({
        'authenticated':'auth/authenticated',
        'user':'auth/authenticated'
      }),
    },
    methods: {
        ...mapActions({
            'submit': 'auth/submit'
        }),
        ...mapGetters({
          'authenticated':'auth/authenticated',
          'user':'auth/authenticated'
        }),
            togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
    async submitlogin() {
  try {
    this.error = ''; // Clear the error message
    await this.$store.dispatch('auth/submit', this.user);
    if (this.$store.getters['auth/authenticated']) {
  const userType = this.$store.getters['auth/user'].type;
  switch (userType) {
    case 'prof':
      this.$router.push('Dash_users');
      break;
    case 'admin_uae':
      this.$router.push('Dash_au');
      break;
    case 'président_univ':
      this.$router.push('Dash_pu');
      break;
    case 'admin_etb':
      this.$router.push('Dash_ae');
      break;
   case 'direct_etb':
      this.$router.push('Dash_de');
      break;
  }
} else {
  this.error = 'Invalid username or password';
}
  } catch (error) {
    console.log('failed', error);
    this.error = 'An error occurred during login';
  }
}
, getNonce() {
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

  <style>
  .image {
    max-width: 800px;
    height: 450px;
    border-radius: 10px;
  }

  .w-96 {
    margin-bottom: 3px;
  }
  </style>
