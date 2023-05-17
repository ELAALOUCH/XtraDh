<template>
  <div>
    <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
      Ajouter Grade
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 max-w-xl">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>
        <h2 class="text-2xl font-bold mb-4">Ajouter Grade</h2>

        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-bold mb-2">Designation:</label>
          <input type="text" id="Designation" v-model="formData.Designation" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="CHARGE_STATUTAIRE" class="block text-gray-700 font-bold mb-2">CHARGE_STATUTAIRE:</label>
          <input type="CHARGE_STATUTAIRE" id="CHARGE_STATUTAIRE" v-model="formData.CHARGE_STATUTAIRE" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="TAUX_HORAIRE_VACATION" class="block text-gray-700 font-bold mb-2">TAUX_HORAIRE_VACATION:</label>
          <input type="TAUX_HORAIRE_VACATION" id="TAUX_HORAIRE_VACATION" v-model="formData.TAUX_HORAIRE_VACATION" required class="border rounded w-full py-2 px-3">
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
        Designation: '',
        email: ''
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