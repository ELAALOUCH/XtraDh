<template>
    <form @submit.prevent="submitForm" >

  <div class="relative z-0 w-full mb-6 group">
    <label for="Designation" class="block text-gray-700 font-bold mb-2">Designation:</label>
    <input type="text" id="Designation" v-model="formData.designation" required class="border rounded w-full py-2 px-3">
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="Charge_statutaire" class="block text-gray-700 font-bold mb-2">Charge_statutaire:</label>
    <input type="number" id="Charge_statutaire" v-model="formData.charge_statutaire" required class="border rounded w-full py-2 px-3">
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="Prenom" class="block text-gray-700 font-bold mb-2">Taux Horraire Vocation :</label>
  <input type="number" id="Prenom" v-model="formData.Taux_horaire" required class="border rounded w-full py-2 px-3">
  </div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Soumettre</button>
</form>

</template>

<script>
import axios from 'axios';
import { createLogger } from 'vuex';

export default {
  data() {
    return {
      formData: {
          id : '',
          designation : '',
          charge_statutaire : '',
          Taux_horaire : ''
      },
      prev_email : ''  
    };
  },
  methods: {
   async submitForm() {
      try
       {
        const response = await axios.patch('/grade/'+ this.formData.id, {
          designation : this.formData.designation,
          charge_statutaire : this.formData.charge_statutaire,
          Taux_horaire_Vocation : this.formData.Taux_horaire
          
        });
        console.log(response);

       this.$router.push('/Gestiongrade')


      } catch (error) {
        console.error(error);
        // Handle error
      }
    },
  },
     async mounted(){
      let id = this.$route.params.id
      this.formData.id=id
     const response = await axios.get('/grade/'+id)
     console.log(response)
          this.formData.designation  = response.data.designation
          this.formData.charge_statutaire = response.data.charge_statutaire
          this.formData.Taux_horaire = response.data.Taux_horaire_Vocation
  },
    cancelForm() {
    },
  }

</script>

