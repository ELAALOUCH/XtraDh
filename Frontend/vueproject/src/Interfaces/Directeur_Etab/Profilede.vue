<template>
  <form @submit.prevent="submitForm" >

<div class="relative z-0 w-full mb-6 group">
  <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
  <input type="text" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3" disabled>
</div>

<div class="relative z-0 w-full mb-6 group">
  <label for="password" class="block text-gray-700 font-bold mb-2">Mot de passe:</label>
    <input type="password" id="password" v-model="formData.password" required class="border rounded w-full py-2 px-3" disabled>
</div>

<div class="relative z-0 w-full mb-6 group">
  <label for="ppr" class="block text-gray-700 font-bold mb-2">PPR:</label>
    <input type="text" id="ppr" v-model="formData.PPR" required class="border rounded w-full py-2 px-3" disabled>
</div>

<div class="relative z-0 w-full mb-6 group">
  <label for="etablissement" class="block text-gray-700 font-bold mb-2">Établissement:</label>
  <input type="text" id="etablissement" v-model="formData.Etablissement" required class="border rounded w-full py-2 px-3" disabled>
</div>

  <div class="relative z-0 w-full mb-6 group">
     <label for="nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
    <input type="text" id="nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3" disabled>
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom:</label>
    <input type="text" id="prenom" v-model="formData.Prénom" required class="border rounded w-full py-2 px-3" disabled>
  </div>
      <div class="inline-flex">
      <Editprofile/>
  </div>
  </form>

</template>

<script>
import axios from 'axios';
import Editprofile from '@/components/Dashboard/etab/Directeur/Editprofile.vue'

export default {
   components:{Editprofile},
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
