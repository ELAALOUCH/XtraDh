<template>
    <div class="flex justify-center items-center h-screen bg-blue-300 " >
      
      <img class="image" src="@/assets/images/AF1QipPd4KGT1xMp13QlE4z_5-CuAMb52cNEd-AmuNrcw1600-h1000-k-no.jpeg" >
      <div class="w-96 bg-indigo-400 rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-8 text-center">Login</h1>
        <form @submit.prevent="submit()" class="space-y-6 flex flex-col h-full">
          <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input v-model="person.email" id="email" type="email" class="w-full border border-gray-300 focus:ring focus:ring-blue-200 rounded-md px-4 py-2">
          </div>
          <div>
            <label for="password" class="block text-gray-700">Password</label>
            <input v-model="person.password" id="password" type="password" class="w-full border border-gray-300 focus:ring focus:ring-blue-200 rounded-md px-4 py-2">
          </div>
          <div class="flex-grow"></div>
          <div>
            <p class="text-red-500" v-show="error">{{ error }}</p>
          </div>
          <div class="flex justify-between items-center">
            <button type="submit" class="w-full bg-blue-500 text-white font-bold rounded-md py-2 px-4 hover:bg-blue-600">
              Login
            </button>
          </div>
        <router-link to="/Forgetpassword" class="text-sm text-blue-500 hover:text-green-900 mt-4">
            Forgot Password?
        </router-link>
        </form>

      </div>
      
    </div>
  </template>
    
<script>
   import { mapActions } from 'vuex';
    import Header from '@/components/Login/Header.vue'
    import Footer from '@/components/Login/Footer.vue'
    export default {
      components:{Footer,Header},
      data() {
        return {    
         person:{
          email: '',
          password: ''
         },
          error:''
        };
      },
      methods: {
        ...mapActions({ 
           'login':'auth/login' 
        }),
         submit(){
              this.login(this.person).then(()=>{
                const userType = this.person.type;
                switch (userType) {
                 case 'admin':
                   this.$router.push({ name: 'Dash_au' });
                 break;
                 case 'directeur':
                 this.$router.push({ name: 'Dash_de' });
                  break;
                 case 'prof':
                  this.$router.push({ name: 'Dash_users' });
                 break;
                 default:
                   // Redirect to a default route or display an error message
                  this.$router.push({ name: 'DefaultDashboard' });
                  break;
                   }
                })
         }
         
      }
  }
  ;
    
    </script>
  <style>
  .image {
    max-width: 800px; /* Adjust the value as needed */
    height: 450px;
    border-radius: 10px;
  }
  
  .w-96 {
    margin-bottom: 3px; /* Adjust the value as needed */
  }
  </style>