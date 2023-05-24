<template>
  <div>
    <h3 class="text-2xl font-bold text-left py-2">Listes des profs</h3>

    <div class="overflow-x-auto relative  sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
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
                Date_naissance
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Etablissement
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Grade
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Email
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Type
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
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in productyObj " :key="data.id">
            <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
             {{ data.ppr }}
            </th>
            <td class="py-4 px-6">
              {{ data.nom }}
            </td>
            <td class="py-4 px-6">
              {{ data.prenom }}
            </td>
            <td class="py-4 px-6">
              {{ data.date_naissance }}
            </td>
            <td class="py-4 px-6">
              {{ data.etablissement }}
            </td>
            <td class="py-4 px-6">
              {{ data.grade }}
            </td>
            <td class="py-4 px-6">
              {{ data.email }}
            </td>
            <td class="py-4 px-6">
              {{ data.type }}
            </td>
            <td class="py-4 px-6 text-right">
              <div class="inline-flex">
               <Edit/>
               <button class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="">
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
import axios from 'axios';
import Create from '@/components/Dashboard/Prof/Create.vue';
import Edit from '@/components/Dashboard/Prof/Edit.vue';

export default {
  components: { Create, Edit },
  data() {
    return {
      productyObj: [
        {
          ppr: '123456',
          nom: 'John Doe',
          prenom: 'Jane Doe',
          date_naissance: '1990-01-01',
          etablissement: 'Example University',
          grade: 'Professor',
          email: 'johndoe@example.com',
          type: 'Enseignant'
        }
      ],
      showModal: false
    };
  },
  methods: {
    toggleModal() {
      this.showModal = !this.showModal;
    },
    async addEnseignant() {
      try {
        const response = await axios.post('/api/enseignants', {
          ppr: this.name,
          nom: this.color,
          prenom: this.category,
          date_naissance: this.price,
          etablissement: 'Example University',
          grade: 'Professor',
          email: 'johndoe@example.com',
          type: 'Enseignant'
        });
        const newEnseignant = response.data;
        this.productyObj.push(newEnseignant);
        this.name = '';
        this.color = '';
        this.category = '';
        this.price = null;
        this.showModal = false;
      } catch (error) {
        console.error(error);
      }
    }
  }
};
</script>

<style>

</style>