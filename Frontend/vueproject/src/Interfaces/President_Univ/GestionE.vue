<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Listes des établissements</h3>
      
      <div class="overflow-x-auto relative  sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="py-3 px-6">
                Code
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Nom            
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Fax
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  ville
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                  Nbr_enseignants
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex justify-end" >
                  <create/>
                </div> 
             </th>             
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in productyObj " :key="data.id">
              <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
               {{ data.Code }}
              </th>
              <td class="py-4 px-6">
                {{ data.Nom }}
              </td>
              <td class="py-4 px-6">
                {{ data.Fax }}
              </td>
              <td class="py-4 px-6">
                {{ data.ville }}
              </td>
              <td class="py-4 px-6">
                {{ data.Nbr_enseignants}}
              </td>

              <td class="py-4 px-6 text-right">
                <div class="inline-flex">
                <Edit/>                 
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    
                
  </template>
  
  <script>
  import create from '@/components/Dashboard/Etablissement/create.vue'
  import Edit from '@/components/Dashboard/Etablissement/Edit.vue'

  export default {
    components: {create,Edit},
  data(){
    return {
      name:'',
        color:'',
        category:'',
        price:null,   
        productyObj:[
        {
            id:1,
            Code:'Azus',
            Nom:'Gold',
            Fax:' Ipad ',
            ville:5000,
            Nbr_enseignants:1500,
        },
        
    ],
  }
},
  methods:{
    togglemodal(){
    this.showmodal=!this.showmodal
  },},

  }

  </script>
  
  <style>
  
  </style>