<template>
  <div>
    <div class="overflow-x-auto relative  sm:rounded-lg  overflow-y-auto h-[560px] w-[1200px] ">
      <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
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
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Grade
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Email
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Type
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex justify-end" >
                <Create/>
              </div> 
           </th>             
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-b  " v-for="data in profs " :key="data.id">
            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
             {{ data.PPR }}
            </th>
            <td class="py-4 px-6" >
              {{ data.Nom }}
            </td>
            <td class="py-4 px-6">
              {{ data.prenom }}
            </td>
            <td class="py-4 px-6">
              {{ data.Date_Naissance }}
            </td>
            <td class="py-4 px-6" >
              {{ data.etab_permanant.Nom }}
            </td>
            <td class="py-4 px-6" >
              {{ data.grade.designation }}
            </td>
            <td class="py-4 px-6" >
              {{ data.user.email }}
            </td>
            <td class="py-4 px-6">
              {{ data.user.type }}
            </td>
            <td class="py-4 px-6 text-right">
              <div class="inline-flex">
               <Edit/>
               <button class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="">
                 Delete
               </button>                  
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Create from '@/components/Dashboard/Intervention/Create.vue'
export default {
  components:{Create},
  data() {
    return {
      formData: {
        PPR: '',

      },
      success: ''
    };
  },
  methods: {
    handleSubmit() {
      
    },
  },


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
      },
    created(){
      this.getNonce();
    }*/
    }
</script>
