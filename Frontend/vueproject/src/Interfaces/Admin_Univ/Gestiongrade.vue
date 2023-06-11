<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Listes de grade</h3>
  
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>

              <th scope="col" class="py-3 px-6">
                Designantion
              </th>

              <th scope="col" class="py-3 px-6">
                Charge_statutaire
              </th>

              <th scope="col" class="py-3 px-6">
                Taux_horaire_Vocation
              </th>

              <th scope="col" class="py-3 px-6">
             <div class="flex justify-end" >
               <creer/>
              </div>
            </th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="data in Obj" :key="data.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <td class="py-4 px-6" >
                {{ data.designation }}
              </td>
              <td class="py-4 px-6" >
                {{ data.charge_statutaire}}
              </td>
              <td class="py-4 px-6" >
                {{ data.Taux_horaire_Vocation}}
              </td>
              <td class="py-4 px-6 text-right">
                <div class="inline-flex">
                  <router-link :to="`/Gestiongrade/Edit/${data.id}`" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-l">
                      Edit
                  </router-link>
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
  import creer from '@/components/Dashboard/grade/creer.vue'
  //import Create from '@/components/Dashboard/Prof/Create.vue'
  import axios from 'axios';
  export default {
    components: { creer },
  data(){
    return {
        Obj:'',
    }
  },
  async mounted() {
        try {
           const response=await axios.get('/grade')
           console.log(response.data)
           this.Obj=response.data
          this.showModal = false;
        } catch (error) {
          //console.error(error);
        }},
  methods:{
    togglemodal(){
    this.showmodal=!this.showmodal
  }, 
  }}
  
  
  
  </script>
  
  <style>
  .scrollable {
    max-width: 100%;
    overflow-x: scroll;
  }
  </style>
  





 