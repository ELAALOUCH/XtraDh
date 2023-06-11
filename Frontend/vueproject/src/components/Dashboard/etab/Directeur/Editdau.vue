<template>
    <form @submit.prevent="submitForm" >
  

      <div class="relative z-0 w-full mb-6 group">
    <label for="ppr" class="block text-gray-700 font-bold mb-2">PPR:</label>
      <input type="text" id="ppr" v-model="formData.PPR" required class="border rounded w-full py-2 px-3">
  </div>
  
  
    <div class="relative z-0 w-full mb-6 group">
       <label for="nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
      <input type="text" id="nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
    </div>
  
    <div class="relative z-0 w-full mb-6 group">
      <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom:</label>
      <input type="text" id="prenom" v-model="formData.prenom" required class="border rounded w-full py-2 px-3">
    </div>
  
  <div class="relative z-0 w-full mb-6 group">
    <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
    <input type="text" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3">
  </div>
  
  

  
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Soumettre</button>
  </form>
  
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
  data() {
    return {
      formData: {
        id_user: '',
        PPR: '',
        Nom: '',
        prenom: '',
        email: '',
      },
    };
  },
  methods: {
   async submitForm() {
      try
       {
        let id_user = this.$route.params.id
        console.log(id_user);
        const response = await axios.patch('/updateadm/'+ id_user, {
          PPR: this.formData.PPR,
          Nom: this.formData.Nom,
          prenom: this.formData.prenom,
          email: this.formData.email,
          id_user: this.formData.id_user,
        });
        console.log(response);
        this.$router.push('/Gestionde')
  
      } catch (error) {
        console.error(error);
        // Handle error
      }
    },
  },
     async mounted(){
      let id = this.$route.params.id
      this.formData.id_user=id
      console.log(this.$route.params.id)
     const response = await axios.get('/administrateur/'+this.formData.id_user)
    console.log(response.data)
    this.formData.PPR = response.data.PPR ; 
    this.formData.Nom = response.data.Nom;
    this.formData.prenom = response.data.prenom ;
    this.formData.email = response.data.email ;
    this.formData.id_user = response.data.id_user;
  },
    cancelForm() {
    },
  }
  
  </script>
  
  