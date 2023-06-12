<template>
    <div>
      <h3 class="text-2xl font-serif text-left py-2">Listes de grade</h3>
  
      <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
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

              <th scope="col" class="py-3 pl-16">
             <div class="flex justify-center" >
               <creer/>
              </div>
            </th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="data in Obj" :key="data.id" class="bg-white border-b ">
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

                  <router-link :to="`/Gestiongrade/Edit/${data.id_Grade}`" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full mr-2">
                      Edit
                  </router-link>
                 <button   class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full" @click="deletegrade(data)">

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
        Obj:[],
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
  async deletegrade(data){
    const response = await axios.delete('/grade/'+data.id_Grade)
    let index = this.Obj.indexOf(data);
    this.Obj.splice(index,1);
  } 
  }}
  
  
  
  </script>
  
  <style>
  .scrollable {
    max-width: 100%;
    overflow-x: scroll;
  }
  </style>
  





 