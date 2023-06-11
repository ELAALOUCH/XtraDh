<template>

<section class="container mx-auto p-6 font-mono">

  <h3 class="text-2xl font-serif text-left pb-4">Listes des directeurs d'établissement</h3>

  <div class="my-4">
      <label for="establishmentFilter" class="block text-gray-700 font-serif  mb-2">
        Filtrer par Etablissement
      </label>
      <select v-model="filter" id="establishmentFilter" class="border rounded w-full py-2 px-3">
        <option  selected value="">Tous les etablissements</option>
        <option v-for="etb in etabs" :value="etb.Nom">{{ etb.Nom }}</option>
      </select>
    </div>

  <div class="w-full mb-8 overflow-hidden rounded-lg ">
    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100 ">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-2 py-3">Intitule_intervention</th>
            <th class="px-2 py-3">Nom</th>
            <th class="px-2 py-3">Prenom</th>
            <th class="px-2 py-3"> Etablissement</th>
            <th class="px-2 py-3"> Annee_univ</th>
            <th class="px-2 py-3"> Semestre </th>
            <th class="px-2 py-3"> Date_debut </th>
            <th class="px-2 py-3"> Date_fin </th>
            <th class="px-2 py-3"> Nbr_heures </th>
            <th class="px-2 py-3"> Visa_uae </th>
            <th class="px-2 py-3"> Visa_etb </th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="text-gray-700" v-for="data in filteredData " :key="data.id">
            <td class="px-2 py-3 border">
              <div class="flex items-center text-sm">
                <div>
                  <p class="font-semibold text-black">{{ data.Intitule_Intervention }} </p>
                </div>
              </div>
            </td>
            <td class="px-2 py-3 text-ms font-semibold border">{{ data.prof_Nom }}</td>
            <td class="px-2 py-3 text-ms font-semibold border">
              {{ data.prenom }}
            </td>
            <td class="px-2 py-3 text-ms font-semibold border">{{ data.Nom_etb }}</td>
            <td class="px-2 py-3 text-ms font-semibold border">{{ data.Annee_univ }}</td>
            <td class="px-2 py-3 text-ms font-semibold border">{{ data.Semestre }}</td>
            <td class="px-2 py-3 text-ms font-semibold border"> {{ data.Date_debut }}</td>
            <td class="px-2 py-3 text-ms font-semibold border">{{ data.Date_fin }}</td>
            <td class="px-2 py-3 text-ms font-semibold border text-center">{{ data.Nbr_heures }}</td>
            <td class="px-2 py-3 text-ms font-semibold border text-center">{{ data.visa_etb }}</td>
            <td class="px-2 py-3 text-ms font-semibold border text-center">{{ data.visa_uae }}</td>
            </tr>

        </tbody>
      </table>
    </div>
  </div>
</section>
</template>

  <script>
import axios from 'axios';
  export default {
    components: {},
  data(){
    return {
        interv :  [],
        etabs : [],
        filter : ''
    }
  },
  async mounted(){
  const response = await axios.get('/interventionuaevalid');
  const etbs = await axios.get('/etablissement')
  this.etabs = etbs.data;
   this.interv=response.data
   console.log(response.data)

  },
  computed: {
    filteredData() {
      if (this.filter.length > 0 ) {
        return this.interv.filter((intr)=> intr.Nom_etb.toLowerCase().includes(this.filter.toLocaleLowerCase()) )
        //return this.cons; // Return all data if no filter is applied
      } else {
        return this.interv
      }
    },
  },
};
</script>