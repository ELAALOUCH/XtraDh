<template>
  <div class="flex flex-col md:flex-row h-screen items-center">
 
 <div class="bg-blue-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
   <img src="@/assets/images/AF1QipPd4KGT1xMp13QlE4z_5-CuAMb52cNEd-AmuNrcw1600-h1000-k-no.jpeg" alt="" class="w-full h-full object-cover">
 </div>
 
 <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
       flex items-center justify-center">
 
 
   <div class="w-full h-100 ">
     <h1 class="text-sky-600  text-6xl  text-center  ">XtraDh</h1>
 
     <form  @submit.prevent="submitlogin()" class="mt-6" >
       <div>
         <label for="email" class="block text-gray-700">Email Address</label>
         <input v-model="user.email" type="email"  id="email" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required >
       </div>
 
       <div class="mt-4">
         <label for="password" class="block text-gray-700">Password</label>
         <input v-model="user.password" id="password" type="password"  placeholder="Enter Password"  required class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
               focus:bg-white focus:outline-none" >
       </div> 
 
       <div class="flex p-4 mb-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50 " role="alert"  v-show="error" >
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
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
 
 
 
     <p class="mt-8">
       Need an account? 
       <a href="#" class="text-blue-500 hover:text-blue-700 font-semibold">
         Create an account
       </a>
     </p>
 
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
                email: '',
                password: '',  
                            
            },
            error: ''
        }
    },
    methods: {
        ...mapActions({
            'submit': 'auth/submit'
        }),

        submitlogin() {
           this.submit(this.user).then(()=>{this.$router.push('/Dash_users') ;} )
       }
      
    },
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