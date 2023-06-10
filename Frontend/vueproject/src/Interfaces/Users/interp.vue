<template>
  <div>
    <h3 class="text-2xl font-bold text-left py-2">Consultation des interventions</h3>
    <div class="flex space-x-4 items-center justify-between">

  <div >
    <label for="filterYear">Filtrer par année :</label>
    <select id="filterYear" v-model="selectedYear">
      <option value="">Toutes les années</option>
      <option v-for="year in pfs" :value="year.Annee_univ" :key="year">{{ year.Annee_univ }}</option>
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

    <div class="overflow-x-auto relative sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="py-3 px-6">
              Intitule_intervention
            </th>
            <th scope="col" class="py-3 px-6">
              Etablissement
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Annee_univ
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Semestre
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Date_debut
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Date_fin
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              Nbr_heures
            </th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in pfs " :key="data.id">
            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap" >
                 {{ data.Intitule_Intervention }}
             </th>
             <td class="py-4 px-6" >
               {{ data.etab }}
             </td>
             <td class="py-4 px-6" >
               {{ data.Annee_univ }}
             </td>
             <td class="py-4 px-6" >
               {{ data.Semestre }}
             </td>
             <td class="py-4 px-6" >
               {{ data.Date_debut }}
             </td>
             <td class="py-4 px-6" >
               {{ data.Date_fin }}
             </td>
             <td class="py-4 px-6" >
               {{ data.Nbr_heures }}
             </td>            
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
      pfs: ''
    };
  },
  computed: {
    filteredData() {
      if (this.selectedYear && this.selectedSemester) {
        return this.pfs.filter(
          (data) =>
            data.annee_univ === parseInt(this.selectedYear) &&
            data.semestre === this.selectedSemester
        );
      } else if (this.selectedYear) {
        return this.pfs.filter(
          (data) => data.annee_univ === parseInt(this.selectedYear)
        );
      } else if (this.selectedSemester) {
        return this.pfs.filter(
          (data) => data.semestre === this.selectedSemester
        );
      } else {
        return this.pfs;
      }
    }
  },
 
  async mounted(){
    const response =await axios.get('/getintervention');
    this.pfs=response.data
    console.log(response.data)
 }
};
</script>
