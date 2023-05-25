<template>
  <div>
    <div class="max-w-sm mx-auto p-2 bg-white rounded shadow">
      <div class="mb-2">
        <label for="PPR" class="block text-gray-700 font-bold mb-1">PPR:</label>
        <input type="text" id="PPR" v-model="formData.PPR" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>

      <div v-if="success" class="bg-green-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ success }}</span>
      </div>

      <button type="submit" @click="handleSubmit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded">Submit</button>
      <button type="reset" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">Cancel</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      formData: {
        PPR: '',
      },
      success: ''
    };
  },
  methods: {
    handleSubmit() {
      console.log(this.formData);
      this.success = 'Successfully added';
      this.formData.PPR = '';
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
  };
</script>
