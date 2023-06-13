<template>
  <div>
    <section class="container mx-auto p-6 font-mono" v-if="date">
    <h3 class="text-2xl font-serif text-left pb-4">Consulter vote procédure de paiement d'année en cours {{ date }}</h3>
    <div class="flex justify-end ">
          <router-link to="/ancienfiche">
                <button class="py-2 px-4 my-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Anciennes fiches de paie</button>
          </router-link>
      </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg ">
    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-300px)] scrollbar scrollbar-track-gray-100 ">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Etablissement</th>
            <th class="px-4 py-3">Volume Horaire</th>
            <th class="px-4 py-3">Taux_Horaire</th>
            <th class="px-4 py-3">Salaire Brut</th>
            <th class="px-4 py-3">Import sur revenu</th>
            <th class="px-4 py-3">Salaire Net</th>
            <th class="px-4 py-3">Année_universitaire</th>
            <th class="px-4 py-3">Semestre</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="text-gray-700" v-for="data in paiements" :key="data.id">
            <td class="px-4 py-3 border">
              <div class="flex items-center text-sm">
                <div>
                  <p class="font-semibold text-black">{{ data.Nom }} </p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.VH }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">
              {{ data.Taux_H }}
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Brut }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.IR }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.NET }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Annee_univ }}</td>
            <td class="px-4 py-3 text-ms font-semibold border">{{ data.Semestre }}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
  
    </section>
    <section v-if="!date">



 <div id="alert-additional-content-1" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
  <div class="flex items-center">
    <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
    <span class="sr-only">Info</span>
    <h3 class="text-lg font-medium">INFO  </h3>
  </div>
  <div class="mt-2 mb-4 text-sm">
    Veuillez noter que le paiement sera disponible uniquement entre le 30 juin et le 30 septembre. Pendant cette période, vous pourrez effectuer vos transactions en toute tranquillité.
  </div>
  <div class="flex">
    <button type="button" class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg aria-hidden="true" class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
      <router-link to="/ancienfiche">
                <button class="">Anciennes fiches de paie</button>
      </router-link>
    </button>
  </div>
</div>

    </section>
  </div>
   
  
  </template>

  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        paiements: [
          
        ],
        date : 0,
      };
    },
    async mounted()
    {
      const response = await axios.get('/paiementprof')
      this.paiements = response.data
      console.log(response.data)
      
      // Création d'une instance de l'objet Date pour la date actuelle
      var dateActuelle = new Date();

      // Récupération du mois et du jour actuels
      var moisActuel = dateActuelle.getMonth() + 1; // Les mois commencent à partir de 0, donc on ajoute 1

      // Vérification si la date est entre le 30 juin et le 30 septembre
      if (moisActuel >= 7 && moisActuel <= 9 ) {

        this.date = 1;
      } else {
        this.date = 0;
      }

    }
  };
  </script>
