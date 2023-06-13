<template>
  <div>
    <section class="container mx-auto p-6 font-mono" v-if="date">
    <h3 class="text-2xl font-serif text-left pb-4">Consulter vote procédure de paiement d'année en cours {{ date }}</h3>
    <div class="flex justify-end ">
          <router-link to="/ancienfiche">
                <button class="py-2 px-4 my-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Anciennes fiches de paie</button>
          </router-link>
      </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg " >
    <div class="w-full overflow-x-auto overflow-y-auto h-[calc(100vh-200px)] scrollbar scrollbar-track-gray-100 ">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Etablissement</th>
            <th class="px-4 py-3">Volume Horraire</th>
            <th class="px-4 py-3">Taux_Horraire</th>
            <th class="px-4 py-3">Salaire Brut</th>
            <th class="px-4 py-3">Import sur revenu</th>
            <th class="px-4 py-3">Salaire Net</th>
            <th class="px-4 py-3">Annee_univirsitaire</th>
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
      Nous vous remercions de votre intérêt pour notre service de paiement. Nous souhaitons vous informer que le paiement n'est pas disponible pour le moment. Cependant, soyez assuré que nous mettons tout en œuvre pour rendre cette fonctionnalité accessible dès que possible.
      <br><br>
      Veuillez noter que le paiement sera disponible uniquement entre le 30 juin et le 30 septembre. Pendant cette période, vous pourrez effectuer vos transactions en toute tranquillité.
       <br><br>
      Nous vous prions de nous excuser pour ce désagrément temporaire et vous remercions de votre patience et de votre compréhension. Si vous avez des questions supplémentaires ou avez besoin d'une assistance, n'hésitez pas à nous contacter.
      <br><br>
      Pour télécharger Vos anciennes fiches de paie veuiller cliquer 
      <router-link to="/ancienfiche">
                <button class="py-2 px-4 my-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Anciennes fiches de paie</button>
          </router-link>
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
        message : "Nous vous remercions de votre intérêt pour notre service de paiement. Nous souhaitons vous informer que le paiement n'est pas disponible pour le moment. Cependant, soyez assuré que nous mettons tout en œuvre pour rendre cette fonctionnalité accessible dès que possible. Veuillez noter que le paiement sera disponible uniquement entre le 30 juin et le 30 septembre. Pendant cette période, vous pourrez effectuer vos transactions en toute tranquillité.Nous vous prions de nous excuser pour ce désagrément temporaire et vous remercions de votre patience et de votre compréhension. Si vous avez des questions supplémentaires ou avez besoin d'une assistance, n'hésitez pas à nous contacter."
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
