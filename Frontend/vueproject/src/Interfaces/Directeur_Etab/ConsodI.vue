<template>
    <div>
      <h3 class="text-2xl font-serif text-left py-2">Consultation des interventions</h3>

      <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100 ">
        <table class="w-full text-sm text-left text-gray-500 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
            <tr>
              <th scope="col" class="py-3 px-6">
               Intitule_intervention
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
                  Annee_univ
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Semestre
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Date_debut
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Date_fin
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                  Nbr_heures
              </th>
              <th scope="col" class="py-3 px-6">
                  Visa_uae
              </th>
              <th scope="col" class="py-3 px-6">
                Visa_etb
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b  " v-for="data in interv " :key="data.id">
             <th class="py-4 px-6 font-medium text-gray-900 ">
                {{ data.Intitule_Intervention  }}
             </th>
             <td class="py-4 px-6">
                {{ data.prof_nom }}
              </td><td class="py-4 px-6">
                {{ data.prenom }}
              </td>
              <td class="py-4 px-6">
                 {{ data.Annee_univ  }}
              </td>
             <td class="py-4 px-6">
                 {{ data.Semestre  }}
              </td>
             <td class="py-4 px-6">
                 {{ data.Date_debut  }}
              </td>
             <td class="py-4 px-6">
                 {{ data.Date_fin  }}
              </td>
             <td class="py-4 px-6">
                 {{ data.Nbr_heures  }}
              </td>
             <td class="py-4 px-6">
                 {{ data.visa_etb  }}
              </td>
             <td class="py-4 px-6">
                 {{ data.visa_uae  }}
              </td>              
          </tr>
          </tbody>
        </table>
      </div>
    </div>


  </template>

  <script>
import axios from 'axios';
  export default {
    components: {},
  data(){
    return {
        interv :  []
    }
  },
  async mounted(){
  const response = await axios.get('/directeuretabintervvalid');
   this.interv=response.data
   console.log(response.data)

  },}

  </script>
