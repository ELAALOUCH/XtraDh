<template>
  <div>
    <button @click="showModal = true" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded">
      Ajouter 
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" v-if="showModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-content bg-white rounded-lg p-6 max-w-3xl mx-auto">
        <span class="close absolute top-0 right-0 m-4 cursor-pointer" @click="closeModal">&times;</span>

        <div class="mb-4">
          <label for="PPR" class="block text-gray-700 font-bold mb-2">PPR:</label>
          <input type="text" id="PPR" v-model="formData.PPR" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Nom" class="block text-gray-700 font-bold mb-2">Nom:</label>
          <input type="text" id="Nom" v-model="formData.Nom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Prenom" class="block text-gray-700 font-bold mb-2">Prenom:</label>
          <input type="text" id="Prenom" v-model="formData.Prenom" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="Email" class="block text-gray-700 font-bold mb-2">Email:</label>
          <input type="Email" id="Email" v-model="formData.email" required class="border rounded w-full py-2 px-3">
        </div>

        <div class="mb-4">
          <label for="DATE_NAISSANCE" class="block text-gray-700 font-bold mb-2">DATE_NAISSANCE:</label>
          <input type="date" id="DATE_NAISSANCE" v-model="formData.Date_Naissance" required class="border rounded w-full py-2 px-3">
        </div>

       
       
        <div class="mb-4">
          <label for="type" class="block text-gray-700 font-bold mb-2">Grade:</label>
          <select id="type" v-model="formData.grade" required class="border rounded w-full py-2 px-3">
            <option selected value="" disabled >Selectionner le grade</option>
            <option :value="grad.id_Grade" selected v-for="grad  in grads" :key="grad.id_Grade">{{grad.designation}}</option>
            
          </select>
        </div>
        <div class="mb-4" v-if="show">
          <label for="type" class="block text-gray-700 font-bold mb-2">Etablisssement Origine:</label>
          <select id="type" v-model="formData.Etablissement" required class="border rounded w-full py-2 px-3">
            <option selected value="" disabled >Selectionner etablissement </option>
            <option v-for ="etb in formData.etabs" :key="etb.id" :value="etb.id" >{{ etb.Nom }}</option>
            
          </select>
        </div>


        <div class="flex justify-end">
          <button  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            @click="submitForm">
            Ajouter
          </button>
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2"
            @click="closeModal">
            Annuler
          </button>
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-3 rounded relative mt-4" role="alert" v-show="error">
        <span class="block sm:inline" >{{errors}}</span>
      </div>
        </div>
        
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default{
      props : {
        test : {
          type : Number  
        }
      }
          ,
        data(){       
            return {
               showModal: false,
               formData:{
                PPR: '',
                Nom : '',
                Prenom : '',
                Date_Naissance: '',
                grade : '',
                email : '',
                type : 'prof',
                grads : '',
                errors : '',
                Etablissement : '',
                etabs : [],
                
              },
              show : 0,
              errors:'',
            }
        },
        async created(){
          this.show = this.test
          console.log( this.formData.show )
          const grads = await axios.get('/grade');
           this.grads = grads.data ; 
           const etbs = await axios.get('http://127.0.0.1:8000/api/etablissement'); 
         // console.log(etbs.data)    
            etbs.data.forEach(e => {
              if(e.Nom!='UAE'){
                this.formData.etabs.push(e)
              }            
            });
        },
        methods:{
            async submitForm(){
              try{
                const response =  await axios.post('/storeprofetb',{
                    PPR:this.formData.PPR,
                    Nom:this.formData.Nom,
                    prenom:this.formData.Prenom,
                    Date_Naissance:this.formData.Date_Naissance,
                    id_Grade:this.formData.grade,
                    email:this.formData.email,
                    type : this.formData.type,   
                    Etablissement : this.formData.Etablissement 
                 })
                 //console.log(response)
                 this.showModal = false;
                 window.location.reload();
              }catch(e){     
                this.errors = e.response.data.errors ; 
              }             
            },
      closeModal() {
        this.showModal = false;
    },
        }
    }
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