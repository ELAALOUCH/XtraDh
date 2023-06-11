<template>
    <div>
      <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
        Ajouter grade
      </button>
  
      <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  
        <div class="modal-content bg-white rounded-lg p-6 max-w-xl">
          <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
  
          <div class="mb-4">
            <label for="Designantion" class="block text-gray-700 font-bold mb-2">Designantion:</label>
            <input type="text" id="Designantion" v-model="formData.Designantion" required class="border rounded w-full py-2 px-3">
          </div>
  
          <div class="mb-4">
            <label for="Charge_statutaire" class="block text-gray-700 font-bold mb-2">Charge_statutaire:</label>
            <input type="text" id="Charge_statutaire" v-model="formData.Charge_statutaire" required class="border rounded w-full py-2 px-3">
          </div>

          <div class="mb-4">
            <label for="Taux_horaire_Vocation" class="block text-gray-700 font-bold mb-2">Taux_horaire_Vocation:</label>
            <input type="text" id="Taux_horaire_Vocation" v-model="formData.Taux_horaire_Vocation" required class="border rounded w-full py-2 px-3">
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
  export default {
    data() {
      return {
        showModal: false,
        formData: {
          email: '',
          password: '',
          type: '',
          PPR: '',
          Etablissement: '',
          Nom: '',
          Prénom: ''
        }
      };
    },
    methods: {
      closeModal() {
        this.showModal = false;
      },
      submitForm() {
        // Effectuez ici votre logique CRUD, comme l'ajout de l'établissement
        console.log(this.formData);
  
        // Réinitialisez les données du formulaire et fermez la fenêtre modale
        this.formData.email = '';
        this.formData.password = '';
        this.formData.type = '';
        this.formData.PPR = '';
        this.formData.Etablissement = '';
        this.formData.Nom = '';
        this.formData.Prénom = '';
  
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