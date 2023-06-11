<template>
  <div>
    <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
      Ajouter 
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 max-w-xl">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Ajouter </h2>

        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
          <input type="text" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="ppr" class="block text-gray-700 font-bold mb-2">PPR:</label>
          <input type="text" id="ppr" v-model="formData.PPR" required class="border rounded w-full py-2 px-3">
        </div>


        <div class="mb-4">
          <label for="nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
          <input type="text" id="nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom:</label>
          <input type="text" id="prenom" v-model="formData.prenom" required class="border rounded w-full py-2 px-3">
        </div>


        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            @click="submitForm">
            Ajouter
          </button>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2"
            @click="closeModal">
            Annuler
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
        Nom: '',
        prenom : '',
        PPR : '',
        email :'',
        type:'directeur_etab',

      }
    };
  },
  methods: {
    closeModal() {
      this.showModal = false;
    },
    async submitForm() {
        const response = await axios.post('/storeadminetb',{
          Nom :  this.formData.Nom, 
          email : this.formData.email,
          PPR : this.formData.PPR,
          type : this.formData.type,  
          prenom : this.formData.prenom,
        })
        .then(()=>{
           this.formData.Nom = '' 
           this.formData.email = ''
           this.PPR = ''
           this.formData.type = ''  
           this.formData.prenom = ''
        })
      this.closeModal();
      window.location.reload();
      console.log(response)
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