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
              {{ data.user }}
            </td>
            <td class="py-4 px-6" >
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
import axios from 'axios'
export default {
  components: {Create,Edit},
data(){
  return {
      Obj:
      {
        Email:'',
        Type:'',
        PPR:'',
        Nom:'',
        PRENOM:'',
        ETABLISSEMENT:''

      }
  }
},
async mounted() {
      try {
        console.log('aze')
        await axios.get('/Administrateur').then(res => {
         // console.log(res)
          console.log(res.data[0].user)
          console.log(res.data[0].prenom)
          console.log(res.data[0].etablissement.Nom)


          this.obj=res.data
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
}, getNonce() {
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
    }
     }



</script>

<style>
.scrollable {
  max-width: 100%;
  overflow-x: scroll;
}
</style>
