<template>
    <div class="flex justify-center items-center h-screen bg-gray-100">
      <div class="w-96 bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Reset Password</h1>
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label for="password" class="block text-gray-700">New Password</label>
            <input v-model="password" id="password" type="password" class="w-full border border-gray-300 focus:ring focus:ring-blue-200 rounded-md px-4 py-2">
          </div>
          <div>
            <label for="confirmPassword" class="block text-gray-700">Confirm Password</label>
            <input v-model="confirmPassword" id="confirmPassword" type="password" class="w-full border border-gray-300 focus:ring focus:ring-blue-200 rounded-md px-4 py-2">
          </div>
  
          <div class="flex justify-between items-center">
            <button type="submit" class="w-full bg-blue-500 text-white font-bold rounded-md py-2 px-4 hover:bg-blue-600">Reset Password</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
    import Header from '@/components/Login/Header.vue'
    import Footer from '@/components/Login/Footer.vue'
  export default {
    components:{Footer,Header},
  
    data() {
      return {
        email: '',
        password: '',
        confirmPassword: '',
      };
    },
    methods: {
      submitForm() {
        if (this.password !== this.confirmPassword) {
          alert('Passwords do not match!');
          return;
        }      
        console.log('Email:', this.email);
        console.log('New Password:', this.password);
        this.email = '';
        this.password = '';
        this.confirmPassword = '';
        this.$router.push('/');
      },
    },
  };
  </script>