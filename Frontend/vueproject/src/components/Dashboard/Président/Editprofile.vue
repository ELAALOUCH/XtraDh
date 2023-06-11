<template>
  <div>
    <button @click="showModal = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Modifier
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-4 sm:p-6 md:p-8 w-11/12 max-w-md mx-auto">
        <h2 class="text-2xl font-bold mb-4">Edit</h2>

        <div class="mb-4 flex items-center justify-between">
          <label for="PPR" class="text-right text-gray-700 font-bold mr-2">PPR:</label>
          <input type="text" id="PPR" v-model="formData.PPR" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4 flex items-center justify-between">
          <label for="Name" class="text-right text-gray-700 font-bold mr-2">Name:</label>
          <input type="text" id="Name" v-model="formData.Name" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4 flex items-center justify-between">
          <label for="Prenom" class="text-right text-gray-700 font-bold mr-2">Prenom:</label>
          <input type="text" id="Prenom" v-model="formData.Prenom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4 flex items-center justify-between">
          <label for="Etablissement" class="text-right text-gray-700 font-bold mr-2">Etablissement:</label>
          <input type="text" id="Etablissement" v-model="formData.Etablissement" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4 flex items-center justify-between">
          <label for="email" class="text-right text-gray-700 font-bold mr-2">Email:</label>
          <input type="email" id="email" v-model="formData.email" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4 flex items-center justify-between">
          <label for="password" class="text-right text-gray-700 font-bold mr-2">Password:</label>
          <input type="password" id="password" v-model="formData.password" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mt-8 flex justify-end">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="submitForm">
           Modifier
          </button>
          <button @click="closeModal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">
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
        PPR: '',
        Name: '',
        Prenom: '',
        Etablissement: '',
        email: '',
        password: ''
      }
    };
  },
  methods: {
    closeModal() {
      this.showModal = false;
    },
    submitForm() {
      // Perform update logic here
      console.log(this.formData);

      // Close the modal
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