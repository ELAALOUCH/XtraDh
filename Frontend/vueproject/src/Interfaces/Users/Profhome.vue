<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Bonjour {{  }} , voila vous données</h3>

      <div class="overflow-x-auto relative  sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="py-3 px-6">
                PPR
              </th>
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
                  Date_naissance
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Etablissement
                </div>
              </th>
              <th scope="col" class="py-3 px-6"></th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in productyObj " :key="data.id">
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
              <td class="py-4 px-6 text-right">
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
  data(){
    return {
        name:'',
        color:'',
        category:'',
        price:null,
        productyObj:[
        {
            id:1,
            name:'Azus',
            color:'Gold',
            category:' Ipad ',
            price:5000
        },

    ],

    }
  },
  methods:{
    togglemodal(){
    this.showmodal=!this.showmodal
  },/* getNonce() {
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
    },*/
  }
  }

  </script>

  <style>

  </style>
