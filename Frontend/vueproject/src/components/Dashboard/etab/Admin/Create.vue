<template>
  <div>
    <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
      Ajouter admin_etab
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 max-w-xl">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Ajouter admin_etab</h2>

        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-bold mb-2">email:</label>
          <input type="text" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-700 font-bold mb-2">password:</label>
          <input type="text" id="password" v-model="formData.password" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="type" class="block text-gray-700 font-bold mb-2">Type:</label>
          <select id="type" v-model="formData.type" required class="border rounded w-full py-2 px-3">
            <option value="">Sélectionnez un type</option>
            <option value="admin_uae">Admin UAE</option>
            <option value="admin_etb">Admin ETB</option>
            <option value="enseignant">Enseignant</option>
            <option value="directeur_etb">Directeur ETB</option>
            <option value="president_uae">Président UAE</option>
          </select>
        </div>


        <div class="mb-4">
          <label for="PPR" class="block text-gray-700 font-bold mb-2">PPR:</label>
          <input type="text" id="PPR" v-model="formData.PPR" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
          <input type="Nom" id="Nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Prenom" class="block text-gray-700 font-bold mb-2">Prenom:</label>
          <input type="Prenom" id="Prenom" v-model="formData.prenom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
          <input type="email" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3">
        </div>
        <div class="mb-4">
          <label for="date Naissance" class="block text-gray-700 font-bold mb-2">Date Naissance:</label>
          <input type="date" id="date_Naissance" v-model="formData.Date_Naissance" required class="border rounded w-full py-2 px-3">
        </div>


        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            @click="submitForm">
            Add
          </button>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2"
            @click="closeModal">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      showModal: false,
      formData: {
        PPR: '',
        email : '',
        type : '',
        Nom : '',
        prenom : '',
        grade:  '',
        grads : '',
        Date_Naissance:'' 
      }
    };
  }, 
  async created(){
            const grads = await axios.get('http://127.0.0.1:8000/api/Grade');
           console.log(grads.data)
           this.grads = grads.data ; 
        },
  methods: {
    closeModal() {
      this.showModal = false;
    },
    submitForm() {
      // Perform CRUD logic here, such as adding the etablissement
      console.log(this.formData);

      // Reset the form data and close the modal
      this.formData.name = '';
      this.formData.email = '';
      this.closeModal();
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