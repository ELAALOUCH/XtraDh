<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Consulter les etats de paiments</h3>

      <div class="overflow-x-auto relative sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Nom
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Prenom
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  VH
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Taux_H
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Brut
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  IR
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Net
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Annee_univ
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  semestre
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="data in ints" :key="data.id">
              <td class="py-4 px-6">
                {{ data.enseignant.Nom }}
              </td><td class="py-4 px-6">
                {{ data.enseignant.prenom }}
              </td>
              <td class="py-4 px-6">
                {{ data.VH }}
              </td>
              <td class="py-4 px-6">
                {{ data.Taux_H }}
              </td>
              <td class="py-4 px-6">
                {{ data.Brut }}
              </td>
              <td class="py-4 px-6">
                {{ data.IR }}
              </td>
              <td class="py-4 px-6">
                {{ data.NET }}
              </td>
              <td class="py-4 px-6">
                {{ data.Annee_univ }}
              </td>
              <td class="py-4 px-6">
                {{ data.Semestre }}
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
        ints:''
      };
    },
    methods:{
  },
  async mounted(){
    const response = await axios.get('/Paiement');
    this.ints=response.data
    console.log(response.data)
  }
  };
  </script>
