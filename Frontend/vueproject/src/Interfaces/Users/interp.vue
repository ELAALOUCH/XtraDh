<template>
  <div>
    <h3 class="text-2xl font-bold text-left py-2">Consultation des interventions</h3>

    <div class="flex space-x-4">
      <div>
        <label for="filterYear">Filtrer par année :</label>
        <select id="filterYear" v-model="selectedYear">
          <option value="">Toutes les années</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
        </select>
      </div>

      <div>
        <label for="filterSemester">Filtrer par semestre :</label>
        <select id="filterSemester" v-model="selectedSemester">
          <option value="">Tous les semestres</option>
          <option value="S1">Semestre 1</option>
          <option value="S2">Semestre 2</option>
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
            <th scope="col" class="py-3 px-6">
              Visa_uae
            </th>
            <th scope="col" class="py-3 px-6">
              Visa_etb
            </th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in pfs " :key="data.id">
              <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                  {{ data.intervention ? data.intervention.Intitule_Intervention : '' }}
              </th>
             <td class="py-4 px-6">
               {{ data.intervention ? data.intervention.Annee_univ : '' }}
              </td>
             <td class="py-4 px-6">
               {{ data.intervention ? data.intervention.Semestre : '' }}
              </td>
             <td class="py-4 px-6">
               {{ data.intervention ? data.intervention.Date_debut : '' }}
              </td>
             <td class="py-4 px-6">
               {{ data.intervention ? data.intervention.Date_fin : '' }}
              </td>
             <td class="py-4 px-6">
               {{ data.intervention ? data.intervention.Nbr_heures : '' }}
              </td>
             <td class="py-4 px-6">
               {{ data.intervention ? data.intervention.visa_etb : '' }}
              </td>
             <td class="py-4 px-6">
               {{ data.intervention ? data.intervention.visa_uae : '' }}
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
        return this.productObj.filter(
          (data) =>
            data.annee_univ === parseInt(this.selectedYear) &&
            data.semestre === this.selectedSemester
        );
      } else if (this.selectedYear) {
        return this.productObj.filter(
          (data) => data.annee_univ === parseInt(this.selectedYear)
        );
      } else if (this.selectedSemester) {
        return this.productObj.filter(
          (data) => data.semestre === this.selectedSemester
        );
      } else {
        return this.productObj;
      }
    }
  },
  methods:{
      
  },
  async mounted(){
    const response =await axios.get('/Intervention ');
    console.log(response)
    this.pfs=response.data
 }
};
</script>
