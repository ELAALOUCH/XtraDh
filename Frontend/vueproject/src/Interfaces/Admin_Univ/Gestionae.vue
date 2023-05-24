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
          <tr v-for="data in productyObj" :key="data.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
import Create from '@/components/Dashboard/etab/Admin/Create.vue'
import Edit from '@/components/Dashboard/etab/Admin/Edit.vue'

export default {
  components: {Create,Edit},
data(){
  return {
      name:'',
      color:'',
      category:'',
      price:null,  
      Obj:
      {
        Email:'',
        Type:'',
        PPR:'',
        

      }
  }
},
async mounted() {
      try {
        //console.log('aze')
        await axios.get('/Enseignant').then(res => {
          console.log(res)
          this.profs=res.data
        })
        //

        /*
          ppr: this.name,
          nom: this.nom,
          prenom: this.prenom,
          date_naissance: this.date_naissance,
          etablissement: this.etablissement,
          grade: this.grade,
          email: this.email,
          type: this.type*/
        
        this.showModal = false;
      } catch (error) {
        console.error(error);
      }},
methods:{
  togglemodal(){
  this.showmodal=!this.showmodal
},
     }

}

</script>

<style>
.scrollable {
  max-width: 100%;
  overflow-x: scroll;
}
</style>