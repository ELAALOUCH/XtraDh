<template>
    <h3 class="text-2xl font-serif text-left py-2">Consultation des interventions</h3>
    <div class="flex justify-end ">
          <router-link to="/ancienfiche">
                    <button class="py-2 px-4 my-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Anciennes fiches de paie</button>
          </router-link>
      </div>

    <div class="flex space-x-4 items-center justify-center">
      <div>
        <label for="filterYear">Filtrer par année :</label>
        <select id="filterYear" v-model="selectedYear" >
          <option value="">Toutes les années</option>
          <option v-for="year in years" :value="year" :key="year">{{ year }}</option>
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

        <tbody>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in filteredData " :key="data.id">
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
      pfs: '',
      years : []
    };
  },
  computed: {
    filteredData() {
      if (this.selectedYear.length > 0 ) {
        if(this.selectedSemester.length>0){
            let tab = this.pfs.filter((intr)=> intr.Annee_univ.toLowerCase().includes(this.selectedYear.toLocaleLowerCase()) )
            return tab.filter((intr)=>intr.Semestre.toLocaleLowerCase().includes(this.selectedSemester.toLocaleLowerCase()))
        }
        else {
          return this.pfs.filter((intr)=> intr.Annee_univ.toLowerCase().includes(this.selectedYear.toLocaleLowerCase()) )
        }
      } 
      else if(this.selectedSemester.length>0){
        return this.pfs.filter((intr)=>intr.Semestre.toLocaleLowerCase().includes(this.selectedSemester.toLocaleLowerCase()))
      }
      else {
        return this.pfs
      }
      
    },
  },
 
  async mounted(){
    const response =await axios.get('/getintervention');
    this.pfs=response.data
    this.pfs.forEach(element => {
      if (!this.years.includes(element.Annee_univ)) {
          this.years.push(element.Annee_univ);
      }
    });

 }
};
</script>
