<template>
  <div>
    <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
      Ajouter 
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 max-w-xl">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>

        <h2 class="text-2xl font-bold mb-4">Ajouter Admin Etab </h2>
        <div class="mb-4">
          <label for="type" class="block text-gray-700 font-bold mb-2">Etablisssement:</label>
          <select id="type" v-model="formData.Etablissement" required class="border rounded w-full py-2 px-3">
            <option v-for ="etb in formData.etabs" :key="etb.id" :value="etb.id" >{{ etb.Nom }}</option>
            
          </select>
        </div>
    


        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            @click="submitForm">
            Ajouter
          </button>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2"
            @click="closeModal">
            Annuler
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      showModal: false,
      formData: {
        PPR: '',
        email : '',
        type : 'admin_etb',
        Nom : '',
        prenom : '',
        Etablissement : '',
        etabs : []
      }
    };
  }, 
  async created(){
            const etbs = await axios.get('http://127.0.0.1:8000/api/etablissement'); 
            console.log(etbs.data)    
            etbs.data.forEach(e => {
              if(e.Nom!='UAE'){
                this.formData.etabs.push(e)
              }            
            });
          
           //this.etabs = etbs.data ; 
        },
  methods: {
    closeModal() {
      this.showModal = false;
    },
    async submitForm() {
        console.log(this.formData.type)
        const response = await axios.post('/storeadminetb',{
          Nom :  this.formData.Nom, 
          email : this.formData.email,
          PPR : this.formData.PPR,
          type : this.formData.type,  
          prenom : this.formData.prenom,
          Etablissement : this.formData.Etablissement
        })
        .then(()=>{
           this.formData.Nom = '' 
           this.formData.email = ''
           this.PPR = ''
           this.formData.prenom = ''
        })

      //this.closeModal();
      //window.location.reload();
      console.log(response)
    }
  }
};
</script>

<style>
.modal {
  z-index: 9999;
}

.modal-overlay {
  z-index: -1;
}

.close {
  color: #aaa;
  cursor: pointer;
}

.close:hover {
  color: #000;
}
</style>