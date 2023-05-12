<template>
    <div class="flex justify-center items-center h-screen bg-gray-100">
      <Header/>
      <div class="w-96 bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Forgot Password</h1>
        <form @submit.prevent="submitForm()" class="space-y-8">
          <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input v-model="email" id="email" type="email" class="w-full border border-gray-300 focus:ring focus:ring-blue-200 rounded-md px-4 py-2">
          </div> 
          <div class="flex justify-between items-center">
            <button @click="startRedirect" type="submit" class="w-full bg-blue-500 text-white font-bold rounded-md py-2 px-4 hover:bg-blue-600">Email Me a link</button>
          </div>
        </form>
      </div>
      <Footer/>
    </div>
  </template>
  
<script>
import Header from '@/components/Login/Header.vue'
import Footer from '@/components/Login/Footer.vue'
  export default{
    components:{Footer,Header},
    data() {
      return {
        email: '',
      };
    },
    methods: {
      submitForm() {
        console.log('Email:', this.email);
      },
      startRedirect() {
      const redirectTime = 5000; // Redirect after 5 seconds (5000 milliseconds)
      setTimeout(() => {
        this.$router.push('/Wait'); // Replace with your desired route path
      }, redirectTime);
    }
      
    },
}
</script>
