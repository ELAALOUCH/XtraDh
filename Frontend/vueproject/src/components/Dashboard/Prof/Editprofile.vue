<template>
  <div>
    <button @click="showModal = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Edit
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 w-11/12 max-w-6xl mx-auto">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Edit</h2>
        
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
          <input type="text" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-700 font-bold mb-2">Mot de passe:</label>
          <input type="password" id="password" v-model="formData.password" required class="border rounded w-full py-2 px-3">
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
          <label for="etablissement" class="block text-gray-700 font-bold mb-2">Établissement:</label>
          <input type="text" id="etablissement" v-model="formData.Etablissement" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
          <input type="text" id="nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom:</label>
          <input type="text" id="prenom" v-model="formData.Prénom" required class="border rounded w-full py-2 px-3">
        </div>

        

        <div class="flex justify-end">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="submitForm">
            Update
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
        Name: '',
        email: ''
      }
    };
  },
  methods: {
    closeModal() {
      this.showModal = false;
    },
    submitForm() {
      console.log(this.formData);

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