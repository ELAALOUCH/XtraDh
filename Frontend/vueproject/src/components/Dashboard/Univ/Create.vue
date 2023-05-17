<template>
  <div>
    <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
      Ajouter admin_univ
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 max-w-6xl mx-auto">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Add Etablissement</h2>

        <div class="mb-4">
          <label for="PPR" class="block text-gray-700 font-bold mb-2">PPR:</label>
          <input type="text" id="PPR" v-model="formData.PPR" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Name" class="block text-gray-700 font-bold mb-2">Name:</label>
          <input type="text" id="Name" v-model="formData.Name" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Prenom" class="block text-gray-700 font-bold mb-2">Prenom:</label>
          <input type="text" id="Prenom" v-model="formData.Prenom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Etablissement" class="block text-gray-700 font-bold mb-2">Etablissement:</label>
          <input type="text" id="Etablissement" v-model="formData.Etablissement" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="submitForm">
            Add
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
export default {
  data() {
    return {
      showModal: false,
      formData: {
        PPR: '',
        Name: '',
        Prenom: '',
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
      this.formData.PPR = '';
      this.formData.Name = '';
      this.formData.Prenom = '';
      this.formData.Etablissement = '';
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