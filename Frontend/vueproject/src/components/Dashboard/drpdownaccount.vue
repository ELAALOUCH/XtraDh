<template> 
    <div class="w-[calc(100%-30px)] flex">
          <div class="w-[calc(100%-200px)] flex justify-center "></div>
          <!-- User login -->
          <div class="w-[200px] ">
            <div class="flex items-center justify-start space-x-4" @click="toggleDrop">
              <img class="w-10 h-10 rounded-full border-2 border-blue-50" src="@/assets/images/download.jpg">
              <div class="font-semibold dark:text-white text-left">
                <div>Madona ,Dev OP</div>
                <div class="text-xs text-blue-500 dark:text-blue-400">Admin</div>
              </div>
            </div>
            <!-- Drop down -->
            <div v-show="showDropDown" class="absolute right-[10px] z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
              <div class="py-1 text-left" role="none">
                <!-- Active: "bg-blue-100 text-blue-900", Not Active: "text-blue-700" -->
                <a href="#" class="text-blue-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                <a href="#" class="text-blue-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
                <a href="#" class="text-blue-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                <form method="POST" action="#" role="none">
                  <button type="submit" class="text-blue-700 block w-full px-4 py-2 text-left text-sm" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
                </form>
              </div>
            </div>
          </div>
        </div>
</template>

<script>
export default{
    data(){
        return{
            showDropDown: false,
        }
    },
    methods:{
        toggleDrop() {
         this.showDropDown = !this.showDropDown   
       }
    }
}



</script>