<template>
    <div>
      <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
        Ajouter 
      </button>
  
      <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  
        <div class="modal-content bg-white rounded-lg p-6 max-w-xl">
          <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
  
          <div class="mb-4">
            <label for="code" class="block text-gray-700 font-bold mb-2">code:</label>
            <input type="text" id="code" v-model="formData.code" required class="border rounded w-full py-2 px-3">
          </div>
  
          <div class="mb-4">
            <label for="Nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
            <input type="text" id="Nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
          </div>
  
  
          <div class="mb-4">
            <label for="Telephone" class="block text-gray-700 font-bold mb-2">Telephone:</label>
            <input type="text" id="Telephone" v-model="formData.Telephone" required class="border rounded w-full py-2 px-3">
          </div>
  
          <div class="mb-4">
            <label for="Fax" class="block text-gray-700 font-bold mb-2">Fax:</label>
            <input type="text" id="Fax" v-model="formData.Fax" required class="border rounded w-full py-2 px-3">
          </div>
  
          <div class="mb-4">
            <label for="ville" class="block text-gray-700 font-bold mb-2">ville:</label>
            <input type="text" id="ville" v-model="formData.ville" required class="border rounded w-full py-2 px-3">
          </div>

          <div class="mb-4">
            <label for="Nbr_enseignants" class="block text-gray-700 font-bold mb-2">Nbr_enseignants:</label>
            <input type="text" id="Nbr_enseignants" v-model="formData.Nbr_enseignants" required class="border rounded w-full py-2 px-3">
          </div>
  
          <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="submitForm">
              Ajouter
            </button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" @click="closeModal">
              Annuler
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import  axios  from 'axios';
  export default {
    data() {
      return {
        showModal: false,
        formData: {
          code : '',
          Nom : '',
          Telephone : '',
          Fax : '',
          ville  : '',
          Nbr_enseignants :''          
        }
      };
    },
    methods: {
      closeModal() {
        this.showModal = false;
      },
      async submitForm() {
        const response = await axios.post('/etablissement',{
          code : this.formData.code,
          Nom : this.formData.Nom,
          Telephone : this.formData.Telephone,
          Faxe : this.formData.Fax,
          ville : this.formData.ville,
          Nbr_enseignants : this.formData.Nbr_enseignants,

        }) 
        window.location.reload();
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