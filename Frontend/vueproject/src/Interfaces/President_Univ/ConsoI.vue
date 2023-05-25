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
            v-for="data in filteredData"
            :key="data.id"
          >
            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ data.name }}
            </th>
            <td class="py-4 px-6">
              {{ data.color }}
            </td>
            <td class="py-4 px-6">
              {{ data.category }}
            </td>
            <td class="py-4 px-6">
              {{ data.price }}
            </td>
            <td class="py-4 px-6">
              {{ data.price }}
            </td>
            <td class="py-4 px-6">
              {{ data.price }}
            </td>
            <td class="py-4 px-6">
              {{ data.price }}
            </td>
            <td class="py-4 px-6">
              {{ data.price }}
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
      productyObj: [
        {
          id: 1,
          name: 'Azus',
          color: 'Gold',
          category: 'Ipad',
          price: 5000
        },
        {
          id: 2,
          name: 'Samsung',
          color: 'Silver',
          category: 'Phone',
          price: 6000
        },
        {
          id: 3,
          name: 'Apple',
          color: 'Rose Gold',
          category: 'Laptop',
          price: 7000
        }
      ],
      establishmentFilter: '', // Add a new data property for the filter
      establishments: ['Azus', 'Samsung', 'Apple'] // Add an array of establishment names
    };
  },
  methods:{
     getNonce() {
        axios.get('/api/get-nonce')
          .then(response => {
            const nonce = response.data.nonce;

            const scriptElement = document.createElement('script');
            scriptElement.setAttribute('nonce', nonce);
            scriptElement.src = 'index.js';
            document.head.appendChild(scriptElement);

            const styleElement = document.createElement('style');
            styleElement.setAttribute('nonce', nonce);
            styleElement.innerHTML = `
              .my-style {
                color: red;
              }
            `;
            document.head.appendChild(styleElement);
          })
          .catch(error => {
            console.error('Erreur lors de la récupération du nonce:', error);
          });
      }
    },
    created() {
      this.getNonce();

  },
  computed: {
    filteredData() {
      // Compute the filtered data based on the establishment filter
      if (this.establishmentFilter === '') {
        return this.productyObj; // Return all data if no filter is applied
      } else {
        return this.productyObj.filter(data => data.name === this.establishmentFilter);
      }
    }
  }
};
</script>
