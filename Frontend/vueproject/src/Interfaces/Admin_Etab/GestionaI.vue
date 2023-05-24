<template>
  <div>
    <div class="max-w-sm mx-auto p-2 bg-white rounded shadow">



      <div class="mb-2">
        <label for="PPR" class="block text-gray-700 font-bold mb-1">PPR:</label>
        <input type="text" id="PPR" v-model="formData.PPR" required class="w-full border border-gray-300 rounded px-2 py-1">
      </div>


      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded">Submit</button>
      <button type="reset" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">Cancel</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        PPR: '',

      }
    };
  },
  methods: {
    handleSubmit() {
      console.log(this.formData);
      this.formData = {
        PPR: '',

      };
    }
  }
};
</script>