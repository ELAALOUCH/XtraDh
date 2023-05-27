<template>
    <form >
  <div class="relative z-0 w-full mb-6 group">
    <label for="PPR" class="block text-gray-700 font-bold mb-2">PPR:</label>
    <input type="text" id="PPR" v-model="formData.PPR" required class="border rounded w-full py-2 px-3">
  </div>
  <div class="relative z-0 w-full mb-6 group">
    <label for="Nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
          <input type="text" id="Nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
  </div>
  <div class="relative z-0 w-full mb-6 group">
    <label for="Prenom" class="block text-gray-700 font-bold mb-2">Prenom:</label>
          <input type="text" id="Prenom" v-model="formData.Prenom" required class="border rounded w-full py-2 px-3">
  </div>
  <div class="relative z-0 w-full mb-6 group">
    <label for="DATE_NAISSANCE" class="block text-gray-700 font-bold mb-2">DATE_NAISSANCE:</label>
      <input type="date" id="DATE_NAISSANCE" v-model="formData.Date_Naissance" required class="border rounded w-full py-2 px-3">
  </div>
    <div class="relative z-0 w-full mb-6 group">
      <label for="Email" class="block text-gray-700 font-bold mb-2">Email:</label>
    <input type="Email" id="Email" v-model="formData.Email" required class="border rounded w-full py-2 px-3">
    </div>
  <button @click="submitForm" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

</template>

<script>
import axios from 'axios';
import { createLogger } from 'vuex';

export default {
  data() {
    return {
      formData: {
        id_user: '',
        PPR: '',
        Nom: '',
        Prenom: '',
        Date_Naissance: '',
        Email: '',
      },
    };
  },
  methods: {
   async submitForm() {
      try
       {
        let id_user = this.$route.params.id
        console.log(id_user);
        const response = await axios.patch('/updateprof/'+ id_user, {
          PPR: this.formData.PPR,
          Nom: this.formData.Nom,
          prenom: this.formData.Prenom,
          Date_Naissance: this.formData.Date_Naissance,
          email: this.formData.Email,
          id_user: this.formData.id_user,
        });
        console.log(response);
       // this.$router.push('/Gestionp')

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
     const response = await axios.get('/enseignant/'+this.formData.id_user)
    console.log(response.data)
    this.formData.PPR = response.data.PPR ; 
    this.formData.Nom = response.data.Nom;
    this.formData.Prenom = response.data.prenom ;
    this.formData.Date_Naissance = response.data.Date_Naissance ;
    this.formData.Email = response.data.user.email ;
    this.formData.id_user = response.data.user.id_user;
  },
    cancelForm() {
    },
  }

</script>

