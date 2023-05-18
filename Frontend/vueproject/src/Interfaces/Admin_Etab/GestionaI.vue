<template>
  <div>
    <form @submit.prevent="handleSubmit" class="max-w-md mx-auto p-4 bg-white rounded shadow">
      <div class="mb-4">
        <label for="Intitule_Intervention" class="block text-gray-700 font-bold mb-2">Intitule_Intervention:</label>
        <input type="text" id="Intitule_Intervention" v-model="formData.Intitule_Intervention" required class="w-full border border-gray-300 rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="Annee_univ" class="block text-gray-700 font-bold mb-2">Annee_univ:</label>
        <input type="Annee_univ" id="Annee_univ" v-model="formData.Annee_univ" required class="w-full border border-gray-300 rounded px-3 py-2">
      </div>
      
      <div class="mb-4">
        <label for="Semestre" class="block text-gray-700 font-bold mb-2">Semestre:</label>
        <input type="Semestre" id="Semestre" v-model="formData.Semestre" required class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label for="Date_debut" class="block text-gray-700 font-bold mb-2">Date_debut:</label>
        <input type="Date_Debut" id="Date_Debut" v-model="formData.Date_Debut" required class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label for="Date_fin" class="block text-gray-700 font-bold mb-2">Date_fin:</label>
        <input type="Date_fin" id="Date_fin" v-model="formData.Date_fin" required class="w-full border border-gray-300 rounded px-3 py-2">
      </div>

      <div class="mb-4">
        <label for="Nbr_heures" class="block text-gray-700 font-bold mb-2">Nbr_heures:</label>
        <input type="Nbr_heures" id="Nbr_heures" v-model="formData.Nbr_heures" required class="w-full border border-gray-300 rounded px-3 py-2">
      </div>
      
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Submit</button>
      <button type="reset" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">cancel</button>

    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        name: '',
        email: '',
        Semestre: ''
      }
    };
  },
  methods: {
    handleSubmit() {
      // Here you can perform any desired actions with the form data
      console.log(this.formData);
      
      // Reset the form after submission
      this.formData = {
        name: '',
        email: '',
        message: ''
      };
    }
  }
};
</script>
