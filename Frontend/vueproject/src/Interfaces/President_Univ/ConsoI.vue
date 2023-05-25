<template>
  <div>
    <div class="my-4">
      <label for="establishmentFilter" class="block text-gray-700 font-bold mb-2">
        Filter by Establishment:
      </label>
      <select v-model="establishmentFilter" id="establishmentFilter" class="border rounded w-full py-2 px-3">
        <option value="">All Establishments</option>
        <option v-for="establishment in establishments" :value="establishment">{{ establishment }}</option>
      </select>
    </div>

    <h3 class="text-2xl font-bold text-left py-2">Consultation des interventions</h3>

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
          <tr
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
               v-for="data in cons" :key="data.id">
            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ data.Intitule_Intervention }}
            </th>
            <td class="py-4 px-6">
              {{ data.Annee_univ }}
            </td>
            <td class="py-4 px-6">
              {{ data.Semestre }}
            </td>
            <td class="py-4 px-6">
              {{ data.Date_debut }}
            </td>
            <td class="py-4 px-6">
              {{ data.Date_fin }}
            </td>
            <td class="py-4 px-6">
              {{ data.Nbr_heures }}
            </td>
            <td class="py-4 px-6">
              {{ data.visa_uae }}
            </td>
            <td class="py-4 px-6">
              {{ data.visa_etb }}
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
      establishmentFilter: '',
      establishments: [], // Add your establishment data here
      cons: [], // Store the response data in an array
    };
  },
  async mounted() {
    const response = await axios.get('/Intervention');
    this.cons = response.data;
    console.log(response.data);
  },
  computed: {
    filteredData() {
      if (this.establishmentFilter === '') {
        return this.cons; // Return all data if no filter is applied
      } else {
        return this.cons.filter(
          (data) =>
            data &&
            data.Semestre === this.establishmentFilter
        );
      }
    },
  },
};
</script>