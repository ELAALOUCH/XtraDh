<template>
    <div>
      <h3 class="text-2xl font-serif text-left py-2">Liste des établissements</h3>
  
      <div class="ow-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100">
        <table class="w-full text-sm text-left text-gray-500 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
              <th scope="col" class="py-3 px-6">
                code
              </th>
              <th scope="col" class="py-3 px-6">
                Nom
              </th>
              <th scope="col" class="py-3 px-6">
                Telephone
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
                <div class="flex items-center">
                  Nbr_enseignants
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
               <div class="flex justify-center" >
                    <creer/>
                </div>
             </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in Obj" :key="data.id" class="bg-white border-b ">
              <td class="py-4 px-6" >
                {{ data.code }}
              </td>
              <td class="py-4 px-6" >
                {{ data.Nom }}
              </td>
              <td class="py-4 px-6" >
                {{ data.Telephone}}
              </td>
              <td class="py-4 px-6" >
                {{ data.Faxe }}
              </td>
              <td class="py-4 px-6" >
                {{ data.ville }}
              </td>
              <td class="py-4 px-6 text-center"  >
                {{ data.Nbr_enseignants }}
              </td>
              <td class="py-4 px-6 text-right">
                <div class="inline-flex">
                  <router-link :to="`/Gestionetab/Edit/${data.id}`" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full mx-2">
                      Modifier
                  </router-link>
                 <button   class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full" @click="deleteetb(data)">
                   Supprimer
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
  import creer from '@/components/Dashboard/etablissement/creer.vue'
  import axios from 'axios'
  export default {
    components: {creer},
  data(){
    return {
        Obj:[],
        error:''
    }
  },
  async mounted() {
        try {
           const response=await axios.get('/etablissement')
           console.log(response.data)
           response.data.forEach(element => {
            if(element.Nom !=='UAE'){
             this.Obj.push(element)
          }
           });
           
          this.showModal = false;
        } catch (error) {
          this.error=error.response.data.errors;
        }},
  methods:{
    togglemodal(){
    this.showmodal=!this.showmodal
  }, 
  async deleteetb(data){
    console.log(data)
    const response = await axios.delete('/etablissement/'+data.id);
   
    let index = this.Obj.indexOf(data)
    this.Obj.splice(index,1)

  }
  }}
  
  
  
  </script>
  
  <style>
  .scrollable {
    max-width: 100%;
    overflow-x: scroll;
  }
  </style>
  