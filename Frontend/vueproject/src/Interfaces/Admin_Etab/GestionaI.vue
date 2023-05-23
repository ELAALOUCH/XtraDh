<template>
  <div>
    <div class="max-w-sm mx-auto p-2 bg-white rounded shadow">

      <div class="mb-2">
        <label for="id_intervenant" class="block text-gray-700 font-bold mb-1">id_intervenant:</label>
        <input type="text" id="id_intervenant" v-model="formData.id_intervention" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>

      <div class="mb-2">
        <label for="id_Etab" class="block text-gray-700 font-bold mb-1">id_Etab:</label>
        <input type="text" id="id_Etab" v-model="formData.id_Etab" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>

      <div class="mb-2">
        <label for="Intitule_Intervention" class="block text-gray-700 font-bold mb-1">Intitule_Intervention:</label>
        <input type="text" id="Intitule_Intervention" v-model="formData.Intitule_Intervention" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>


      <div class="mb-2">
        <label for="Annee_univ" class="block text-gray-700 font-bold mb-1">Annee_univ:</label>
        <input type="text" id="Annee_univ" v-model="formData.Annee_univ" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>
      
      <div class="mb-2">
        <label for="Semestre" class="block text-gray-700 font-bold mb-1">Semestre:</label>
        <input type="text" id="Semestre" v-model="formData.Semestre" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>

      <div class="mb-2">
        <label for="Date_debut" class="block text-gray-700 font-bold mb-1">Date_debut:</label>
        <input type="text" id="Date_Debut" v-model="formData.Date_Debut" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>

      <div class="mb-2">
        <label for="Date_fin" class="block text-gray-700 font-bold mb-1">Date_fin:</label>
        <input type="text" id="Date_fin" v-model="formData.Date_fin" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>

      <div class="mb-2">
        <label for="Nbr_heures" class="block text-gray-700 font-bold mb-1">Nbr_heures:</label>
        <input type="text" id="Nbr_heures" v-model="formData.Nbr_heures" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>


      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded">Submit</button>
      <button type="reset" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">Cancel</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        Intitule_Intervention: '',
        Annee_univ: '',
        Semestre: '',
        Date_Debut: '',
        Date_fin: '',
        Nbr_heures: ''
      }
    };
  },
  methods: {
    handleSubmit() {
      // Here you can perform any desired actions with the form data
      console.log(this.formData);
      
      // Reset the form after submission
      this.formData = {
        Intitule_Intervention: '',
        Annee_univ: '',
        Semestre: '',
        Date_Debut: '',
        Date_fin: '',
        Nbr_heures: ''
      };
    }
  }
};
</script>