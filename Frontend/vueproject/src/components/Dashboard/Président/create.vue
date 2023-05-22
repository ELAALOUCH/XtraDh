<template>
    <div>
      <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
        Ajouter Président_univ
      </button>
  
      <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  
        <div class="modal-content bg-white rounded-lg p-6 max-w-xl">
          <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
          <h2 class="text-2xl font-bold mb-4">Ajouter Président_univ</h2>
  
          <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">email:</label>
            <input type="text" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3">
          </div>
  
          <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">password:</label>
            <input type="password" id="password" v-model="formData.password" required class="border rounded w-full py-2 px-3">
          </div>
  
          <div class="mb-4">
            <label for="type" class="block text-gray-700 font-bold mb-2">type:</label>
            <input type="type" id="type" v-model="formData.type" required class="border rounded w-full py-2 px-3">
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
  export default {
    data() {
      return {
        showModal: false,
        formData: {
          PPR: '',
          Etablissement: ''
        }
      };
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