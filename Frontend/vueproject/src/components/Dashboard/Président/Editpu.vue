<template>
  <div>
    
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" >
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 w-11/12 w-60 max-w-6xl mx-auto">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Edit</h2>

        <div class="mb-4">
          <label for="nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
          <input type="text"  v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom:</label>
          <input type="text"  v-model="formData.prenom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
          <input type="text"  v-model="formData.email" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-700 font-bold mb-2">Mot de passe:</label>
          <input type="password"  v-model="formData.password"  class="border rounded w-full py-2 px-3">
        </div>

        <div class="flex justify-end mb-4">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="submitForm">
            Update
          </button>
          <button @click="closeModal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="relative z-0 w-full mb-6 group">
    <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom:</label>
    <input type="text" id="prenom" v-model="formData.prenom" required class="border rounded w-full py-2 px-3">
  </div>


<button @click="submitForm" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Soumettre</button>

</template>

<script>
import axios from 'axios';

export default {
 
  data() {
    return {
      showModal: false,
      formData: {
        PPR : '',
        id : '',
        Nom:'',
        prenom : '',
        email: '',
        password : ''
      }
    };
  },
  methods: {
    closeModal() {
      this.showModal = false;
    },
    async submitForm() {
        const response = await axios.patch('/updateadm/'+this.formData.id,{
          Nom : this.formData.Nom,
          prenom : this.formData.prenom,
          email : this.formData.email,
          password : this.formData.password,
          PPR : this.formData.PPR 
        })
      window.location.reload();

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