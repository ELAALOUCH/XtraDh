<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Consulter les etats de paiments</h3>

      <div class="overflow-x-auto relative sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="py-3 px-6">
                id_intervenant
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  id_etab
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
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="data in productyObj" :key="data.id">
              <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ data.id_intervenant }}
              </th>
              <td class="py-4 px-6">
                {{ data.id_etab }}
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
                {{ data.Net }}
              </td>
              <td class="py-4 px-6">
                {{ data.Annee_univ }}
              </td>
              <td class="py-4 px-6">
                {{ data.semestre }}
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
            id_intervenant: '12',
            id_etab: 'azerr',
            VH: 'ytn',
            Taux_H: 'aertbsf',
            Brut: 'dsd',
            IR: 'sdfsd',
            Net: 'fsfd',
            Annee_univ: '2002',
            semestre: 'Sa'
          }
        ]
      };
    },
    methods:{
         /*getNonce() {
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

    }*/
  }
  };
  </script>
