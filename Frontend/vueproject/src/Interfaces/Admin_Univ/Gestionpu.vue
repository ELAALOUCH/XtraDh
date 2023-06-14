<template>
  <div>

    <h3 class="text-2xl font-serif text-left py-2">Gestion du président </h3>


    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100">
      <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
          <tr>
            <th scope="col" class="py-3 px-6">
              email
            </th>
           
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

            <th scope="col" class="py-3 px-6 ">
             <div class="ml-[380px] text-center  " >
                  <create/>
              </div>
           </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in Obj" :key="data.id" class="bg-white border-b">
            <td class="py-4 px-6" >
              {{ data.email }}
            </td>
           
            <td class="py-4 px-6" >
              {{ data.PPR }}
            </td>
            <td class="py-4 px-6" >
              {{ data.Nom }}
            </td>
            <td class="py-4 px-6" >
              {{ data.prenom }}
            </td>

            <td class="py-4 px-6 text-right">
              <div class="inline-flex">
                <router-link :to="`/Gestionpu/Edit/${data.id}`" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full mr-2">
                    Modifier
                </router-link>

               <button   class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full" @click="deleteAdm(data)">

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
import create from '@/components/Dashboard/Président/create.vue'
import axios from 'axios'
export default {
  components: {create},
data(){
  return {
      Obj:[],
  }
},
async mounted() {
      try {
         const response=await axios.get('/listepresidentuaeforadminuae')
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
async deleteAdm(data)
  {
   const response = axios.delete('/deleteadm/'+data.id).then(()=>{
      let index = this.Obj.indexOf(data);
      console.log(index)
      this.Obj.splice(index,1);
    });
    console.log(response)
    
  } 
}}

</script>

<style>
.scrollable {
  max-width: 100%;
  overflow-x: scroll;
}
</style>
