<template>
  <div>
    <button @click="showModal=true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
      Edit
    </button>

    <div class="modal fixed inset-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute inset-0 bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-4 max-w-xs">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
        <h2 class="text-lg font-bold mb-4">Editer</h2>
        <div class="mb-4">
          <label for="PPR" class="block text-gray-700 font-bold mb-2">PPR:</label>
          <input type="text" id="PPR" v-model="formData.PPR" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
          <input type="text" id="Nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Prenom" class="block text-gray-700 font-bold mb-2">Prenom:</label>
          <input type="text" id="Prenom" v-model="formData.Prenom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="DATE_NAISSANCE" class="block text-gray-700 font-bold mb-2">DATE_NAISSANCE:</label>
          <input type="date" id="DATE_NAISSANCE" v-model="formData.Date_Naissance" required class="border rounded w-full py-2 px-3">
        </div>


        <div class="mb-4">
          <label for="Email" class="block text-gray-700 font-bold mb-2">Email:</label>
          <input type="Email" id="Email" v-model="formData.Email" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="flex justify-end mt-4">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="submitForm">
            Update
          </button>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" @click="closeModal">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props:['id'],
 data() {
    return {
      showModal: false,
      formData: {
        id_user:'',
        PPR: '',
        Nom: '',
        Prenom: '',
        Date_Naissance: '',
        Email: '',

      },
      
    };
  },
  async mounted(){
    const response = await axios.get('/enseignant/'+this.id)
    console.log(response.data)
    this.formData.PPR = response.data.PPR ; 
    this.formData.Nom = response.data.Nom;
    this.formData.Prenom = response.data.prenom ;
    this.formData.Date_Naissance = response.data.Date_Naissance ;
    this.formData.Email = response.data.user.email ;
    this.formData.id_user = response.data.id_user;

  }
  ,
  methods: {
   
    
    closeModal() {
      this.showModal = false;
    },
    async submitForm() {
      try {
        const response = await axios.patch('/updateprof/'+this.formData.id_user,{
         PPR:this.formData.PPR, 
          Nom:this.formData.Nom,
          prenom:this.formData.Prenom,
          Date_Naissance:this.formData.Date_Naissance,
          email:this.formData.Email,
          id_user:this.formData.id_user 
        });
        console.log(response)
        this.$router.push('/Gestionp')
        this.showModal = false;
      } catch (error) {
        console.error(error);
      }
    }
  }
};
</script>

<style>
.modal {
  z-index: 9999;
}

.modal-overlay {
  z-index: -1;
}

.close {
  color: #aaa;
  cursor: pointer;
}

.close:hover {
  color: #000;
}
</style>