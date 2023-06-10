<template>
  <div>
    <h3 class="text-2xl font-bold text-left py-2">Listes des admins d'etablissements</h3>

    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="py-3 px-6">
              email
            </th>
            <th scope="col" class="py-3 px-6">
              type
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
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Etablissement
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
             <div class="flex justify-end" >
                  <create/>
                </div>
           </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in Obj" :key="data.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="py-4 px-6" >
              {{ data.user.email }}
            </td>
            <td class="py-4 px-6" >
              {{ data.user.type }}
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
            <td class="py-4 px-6" >
              {{ data.etablissement.Nom }}
            </td>
            <td class="py-4 px-6 text-right">
              <div class="inline-flex">
               <Edit/>
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
import create from '@/components/Dashboard/Président/create.vue'
import Edit from '@/components/Dashboard/etab/Admin/Edit.vue'
import axios from 'axios'
export default {
  components: {create,Edit},
data(){
  return {
      Obj:'',
  }
},
async mounted() {
      try {
         const response=await axios.get('/administrateur')
         console.log(response.data)
         this.Obj=response.data
          /*console.log(res.data[0].user)
          console.log(res.data[0].prenom)
          console.log(res.data[0].etablissement.Nom)*/ 
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
