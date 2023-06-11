<template>
    <form @submit.prevent="submitForm" >

  <div class="relative z-0 w-full mb-6 group">
    <label for="code" class="block text-gray-700 font-bold mb-2">code:</label>
    <input type="text" id="code" v-model="formData.code" required class="border rounded w-full py-2 px-3">
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="Nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
    <input type="text" id="Nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="Telephone" class="block text-gray-700 font-bold mb-2">Telephone:</label>
  <input type="text" id="Telephone" v-model="formData.Telephone" required class="border rounded w-full py-2 px-3">
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="Fax" class="block text-gray-700 font-bold mb-2">Fax:</label>
  <input type="text" id="Fax" v-model="formData.Fax" required class="border rounded w-full py-2 px-3">
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="ville" class="block text-gray-700 font-bold mb-2">ville:</label>
  <input type="text" id="ville" v-model="formData.ville" required class="border rounded w-full py-2 px-3">
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="Nbr_enseignants" class="block text-gray-700 font-bold mb-2">Nbr_enseignants:</label>
  <input type="text" id="Nbr_enseignants" v-model="formData.Nbr_enseignants" required class="border rounded w-full py-2 px-3">
  </div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
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
      prev_email : ''  
    };
  },
  methods: {
   async submitForm() {
      try
       {
        const response = await axios.patch('/updateprof/'+ this.formData.id_user, {
          PPR: this.formData.PPR,
          Nom: this.formData.Nom,
          prenom: this.formData.Prenom,
          Date_Naissance: this.formData.Date_Naissance,
          id_user: this.formData.id_user,
          email : this.formData.Email, 
          
        });
        console.log(response);

       this.$router.push('/Gestionp')


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
    this.prev_email = response.data.user.email ;
    this.formData.id_user = response.data.user.id_user;
  },
    cancelForm() {
    },
  }

</script>

