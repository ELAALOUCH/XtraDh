<template>
    <div class="flex justify-center items-center h-screen bg-gray-100">
      <Header/>
      <div class="w-96 bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Wait Please an email will be sent, check your email</h1>
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
    }
}
</script>
