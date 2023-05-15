<template>
    <footer class="bg-blue-500 py-4 px-8 text-center fixed bottom-0 w-full">
      <p class="text-gray-600 text-sm">
        &copy; {{ currentYear }} XtraDh. All rights reserved.
      </p>
    </footer>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentYear: new Date().getFullYear(),
      };
    },
  };
  </script>