<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Listes des directeurs d'établissement</h3>
      
      <div class="overflow-x-auto relative  sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="py-3 px-6">
                Product name
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Color
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Category             
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Price
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Grade
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                  Salary
              </th>
              <th scope="col" class="py-3 px-6">

                <div class="flex items-center">
                  <Create />
                </div> 
             </th>             
              <th scope="col" class="py-3 px-6">
                <span class="sr-only">Edit</span>
              </th>
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
              <td class="py-4 px-6">
                {{ data.price }}
              </td>
              <td class="py-4 px-6 text-right">
                <div class="inline-flex">
                 <button  class="bg-blue-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="">
                   Edit
                 </button>
                 <button   class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="">
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
  import Create from '@/components/Dashboard/etab/Directeur/Create.vue'
 
  export default {
    components: {Create},
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
  },},

  }

  </script>
  
  <style>
  
  </style>