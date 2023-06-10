<template>
  <form @submit.prevent="submitForm" >

<div class="relative z-0 w-full mb-6 group">
  <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
  <input type="text" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3" disabled>
</div>

<div class="relative z-0 w-full mb-6 group">
  <label for="ppr" class="block text-gray-700 font-bold mb-2">PPR:</label>
    <input type="text" id="ppr" v-model="formData.PPR" required class="border rounded w-full py-2 px-3" disabled>
</div>

<div class="relative z-0 w-full mb-6 group">
  <label for="etablissement" class="block text-gray-700 font-bold mb-2">Établissement:</label>
  <input type="text" id="etablissement" v-model="formData.etablissement" required class="border rounded w-full py-2 px-3" disabled>
</div>

  <div class="relative z-0 w-full mb-6 group">
     <label for="nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
    <input type="text" id="nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3" disabled>
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom:</label>
    <input type="text" id="prenom" v-model="formData.prenom" required class="border rounded w-full py-2 px-3" disabled>
  </div>
  <td class="py-4 px-6 text-right">
    <div class="inline-flex" v-if="formData.id">
      <Editprofile :user="formData"/>
  </div>
    </td>
  </form>

</template>

<script>
import axios from 'axios';
import Editprofile from '@/components/Dashboard/etab/Admin/Editprofile.vue'

export default {
   components:{Editprofile},
  data() {
  return {
    formData: {
      id : '',
      PPR: '',
      Nom: '',
      prenom: '',
      email: '',
      etablissement:'',
      
    },
    
  }
},
async mounted (){
    const user = (await axios.get('/adminprofile')).data
    console.log(user) 
    this.formData.PPR = user.PPR
    this.formData.id = user.id_user
    this.formData.email = user.email
    this.formData.Nom = user.Nom
    this.formData.prenom = user.prenom
    this.formData.etablissement = user.etab_Nom

}
   

}

</script>

