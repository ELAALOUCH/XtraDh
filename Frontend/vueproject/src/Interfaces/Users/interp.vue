<template>
    <h3 class="text-2xl font-serif text-left py-2">Consultation des interventions</h3>


    <div class="flex space-x-4 items-center justify-center">
      <div>
        <label for="filterYear">Filtrer par année :</label>
        <select id="filterYear" v-model="selectedYear">
          <option value="">Toutes les années</option>
          <option v-for="year in uniqueYears" :value="year" :key="year">{{ year }}</option>
        </select>
      </div>

      <div>
        <label for="filterSemester">Filtrer par semestre :</label>
        <select id="filterSemester" v-model="selectedSemester">
          <option value="">Tous les semestres</option>
          <option value="Semestre 1">Semestre 1</option>
          <option value="Semestre 2">Semestre 2</option>
        </select>
      </div>
    </div>


  <div class="w-full mb-8 overflow-hidden rounded-lg mt-7 ">
    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100 ">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Intitule_intervention</th>
            <th class="px-4 py-3">Etablissement</th>
            <th class="px-4 py-3">Annee_univ</th>
            <th class="px-4 py-3">Semestre</th>
            <th class="px-4 py-3">Date_debut</th>
            <th class="px-4 py-3">Date_fin</th>
            <th class="px-4 py-3">Nbr_heures</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="text-gray-700" v-for="data in pfs " :key="data.id">
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Intitule_Intervention }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.etab }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">
              {{ data.Annee_univ }}
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Semestre }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Date_debut }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Date_fin }}</td>
            <td class="px-4 py-3 text-ms font-semibold border text-center">{{ data.Nbr_heures }}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      selectedYear: '',
      selectedSemester: '',
      pfs: [],
    };
  },
  computed: {
    uniqueYears() {
      const years = this.pfs.map((data) => data.Annee_univ);
      return [...new Set(years)];
    },
    filteredData() {
      if (this.selectedYear && this.selectedSemester) {
        return this.pfs.filter(
          (data) =>
            data.Annee_univ.toString() === this.selectedYear &&
            data.Semestre === this.selectedSemester
        );
      } else if (this.selectedYear) {
        return this.pfs.filter((data) => data.Annee_univ.toString() === this.selectedYear);
      } else if (this.selectedSemester) {
        return this.pfs.filter((data) => data.Semestre === this.selectedSemester);
      } else {
        return this.pfs;
      }
    },
  },

  async mounted() {
    const response = await axios.get('/getintervention');
    this.pfs = response.data;
    console.log(response.data);
  },
};
</script>