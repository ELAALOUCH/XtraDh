<template>
  <section class="container w-full mx-auto p-6 font-mono">
   <h3 class="text-2xl font-serif text-left pb-4">Gestion des Interventions</h3>
   <div class="w-full mb-8 overflow-hidden rounded-lg ">
     <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-200 ">
       <table class="w-full">
         <thead>
           <tr class="text-sm  tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
             <th class="px-2 py-3">Nom</th>
             <th class="px-2 py-3">Prenom</th>
             <th class="px-2 py-3">intervention</th>
             <th class="px-2 py-3"> Etab</th>
             <th class="px-2 py-3"> Annee</th>
             <th class="px-2 py-3"> Semestre </th>
             <th class="px-2 py-3"> Nbr_hrs</th>
             <th class="px-2 py-3"> debut </th>
             <th class="px-2 py-3"> fin </th>

             <th scope="col" class="py-3 px-6 text-center">
              <router-link to="/Gestioninterv/Create">
               <button class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
                ajouter
              </button>
              </router-link>
           </th>

           </tr>
         </thead>
         <tbody class="bg-white">
           <tr class="text-gray-700"  v-for="data in interv " :key="data">
             <td class="px-2 py-3 text-sm  border">{{ data.prof_Nom }}</td>
             <td class="px-2 py-3 text-sm  border">
               {{ data.prenom }}
             </td>
             <td class="px-2 py-3 border">
               <div class="flex items-center text-sm">
                 <div>
                   <p class=" text-black">{{ data.Intitule_Intervention }} </p>
                 </div>
               </div>
             </td>
             <td class="px-2 py-3 text-sm  border">{{ data.Nom_etb }}</td>
             <td class="px-2 py-3 text-sm  border">{{ data.Annee_univ }}</td>
             <td class="px-2 py-3 text-sm  border">{{ data.Semestre }}</td>
             <td class="px-2 py-3 text-sm  border text-center">{{ data.Nbr_heures }}</td>
             <td class="px-2 py-3 text-sm  border"> {{ data.Date_debut }}</td>
             <td class="px-2 py-3 text-sm  border">{{ data.Date_fin }}</td>
             
             <td class="border-solid border-2 border-gray-100 py-4 px-6 text-right">
              <div class="inline-flex">
                <div class="py-4 px-6 text-right">
              <div class="inline-flex">
                <router-link :to="`Gestioninterv/Edit/${data.id_intervention}`" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mx-2 rounded-full">
                Modifier
                </router-link>
               <button class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-full " @click="deleteinterv(data)">
                Supprimer
               </button>                  
              </div>
            </div>                
              </div>
            </td>

            
             </tr>
         </tbody>
       </table>
     </div>
   </div>
 </section>
 </template>
 
 
 <script>

 import axios from 'axios';
 export default {
   components: {},
 data(){
   return {
       interv : []
   }
 },

 async mounted()
 {
   const response = await axios.get('/intervention')
   this.interv = response.data 
   console.log(this.interv)
 },

 methods:{
async deleteinterv(data)
  {
   const response = axios.delete('/intervention/'+data.id_intervention).then(()=>{
      let index = this.interv.indexOf(data);
      console.log(index)
      this.interv.splice(index,1);
    });
    console.log(response)
    
  } 
 }
 
 }
 
 </script>
 