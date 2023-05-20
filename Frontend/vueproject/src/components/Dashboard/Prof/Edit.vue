<template>
  <div>
    <button @click="showModal = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Edit
    </button>

    
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 max-w-xl">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Editer</h2>

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
          <input type="Prenom" id="Prenom" v-model="formData.Prenom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="DATE_NAISSANCE" class="block text-gray-700 font-bold mb-2">DATE_NAISSANCE:</label>
          <input type="DATE_NAISSANCE" id="DATE_NAISSANCE" v-model="formData.DATE_NAISSANCE" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Etablissement" class="block text-gray-700 font-bold mb-2">Etablissement:</label>
          <input type="Etablissement" id="Etablissement" v-model="formData.Etablissement" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Grade" class="block text-gray-700 font-bold mb-2">Grade:</label>
          <select v-model="grade">
                <option :value="grad.id_Grade"  v-for="grad  in grads" :key="grad">{{grad.designation}}</option>
            </select>
        </div>

        <div class="mb-4">
          <label for="Email" class="block text-gray-700 font-bold mb-2">Email:</label>
          <input type="Email" id="Email" v-model="formData.Email" required class="border rounded w-full py-2 px-3">
        </div>
        <div class="flex justify-end">
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