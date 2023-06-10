<template>
    <div class="flex justify-center items-center h-screen bg-blue-300">
      <div class="w-96 bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Forgot Password</h1>
        <form @submit.prevent="submitForm()" class="space-y-8">
          <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input v-model="email" id="email" type="email" class="w-full border border-gray-300 focus:ring focus:ring-blue-200 rounded-md px-4 py-2" required>
          </div>
          <div class="flex justify-between items-center">
            <button @click="" type="submit" class="w-full bg-blue-500 text-white font-bold rounded-md py-2 px-4 hover:bg-blue-600">Email Me a link</button>
          </div>
        </form>
        <div v-if="isLoading" class="fixed top-0 left-30 right-0 bottom-30 flex items-center justify-center z-20">
      <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-gray-900"></div>
       </div>

      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" v-show="error">
        <span class="block sm:inline" >{{error}}</span>
      </div>
    </div>
  </div>
  </template>

<script>
import axios from 'axios';
import Header from '@/components/Login/Header.vue'
import Footer from '@/components/Login/Footer.vue'
  export default{
    components:{Footer,Header},
    data() {
      return {
        email: '',
        isLoading:'',
        error:''
      };
    },
    methods: {
      async submitForm() {
  try {
    const response = await axios.post('/forgot', {
      email: this.email
    });
    const redirectTime = 5000; // Redirect after 5 seconds (5000 milliseconds)
    setTimeout(() => {
      this.$router.push('/Wait'); // Replace with your desired route path
    }, redirectTime);
    if (this.email !== '') {
      this.isLoading = true;
    }
  } catch (error) {
    this.error = error.response.data.message;
    console.log(error.response.data.message);
  }
},
 }
}

</script>
