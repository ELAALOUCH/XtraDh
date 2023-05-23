<template>
  <div>
    <h3 class="text-2xl font-bold text-left py-2">Information du président</h3>

    <div class="overflow-x-auto relative sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="py-3 px-6">
              Email
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Mot de passe
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Type            
              </div>
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
                Prénom            
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex items-center">
                Établissement
              </div>
            </th>
            <th scope="col" class="py-3 px-6">
              <div class="flex justify-end">
                <create/>
              </div>
            </th>             
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="data in productObj" :key="data.id">
            <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ data.email }}
            </td>
            <td class="py-4 px-6">
              {{ data.password }}
            </td>
            <td class="py-4 px-6">
              {{ data.type }}
            </td>
            <td class="py-4 px-6">
              {{ data.ppr }}
            </td>              
            <td class="py-4 px-6">
              {{ data.nom }}
            </td>              
            <td class="py-4 px-6">
              {{ data.prenom }}
            </td>
            <td class="py-4 px-6">
              {{ data.etablissement }}
            </td>
  
            <td class="py-4 px-6 text-right">
              <div class="inline-flex">
                <Edit/>
                <button class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 rounded-i" @click="">
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
import Edit from '@/components/Dashboard/Président/Edit.vue'

export default {
  components: {
    create,
    Edit
  },
  data() {
    return {
      email: '',
      password: '',
      type: '',
      ppr: null,  
      nom: '',
      prenom: '',
      etablissement: '',
      productObj: [
        {
          id: 1,
          email: 'example@example.com',
          password: 'password123',
          type: 'Administrateur',
          ppr: 123456789,
          nom: 'Doe',
          prenom: 'John',
          etablissement: 'École XYZ',
        },
      ],
    }
  },
  methods: {
    toggleModal() {
      this.showModal = !this.showModal;
    },
  }
}
</script>

<style>
</style>