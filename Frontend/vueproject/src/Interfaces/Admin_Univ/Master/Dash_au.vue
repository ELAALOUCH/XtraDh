<template>
  <div class="w-screen overflow-y-hidden h-screen flex">

    <div class="w-[400px] h-full bg-blue-200 text-white" v-show="showSide">
      <div class="h-[50px] bg-blue-950 flex justify-start  items-center ">
        <div class="px-[20px]">
          <h3 class="font-serif text-xl">Admin d'université</h3>
        </div>
      </div>
      <div class="h-[calc(100vh-50px)] bg-blue-800 py-[20px]">
        <div class="flex flex-col justify-between h-full px-[20px] space-y-[10px]">

          <div class=" flex flex-col justify-between space-y-[10px]">


            <router-link to="/Gestionpu" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-serif rounded-md border-blue-200 hover:bg-blue-200 hover:text-blue-800  transition duration-400 ease-in-out">
                <president class="px-1"  /> Gestion du président 
            </router-link>

            <router-link to="/Gestionae" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-serif rounded-md border-blue-200 hover:bg-blue-200 hover:text-blue-800  transition duration-400 ease-in-out">
                <interventions class="px-1"  /> Gestion d'admins d'établissements
            </router-link>

            <router-link to="/Gestiondeau" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-serif rounded-md border-blue-200 hover:bg-blue-200 hover:text-blue-800  transition duration-400 ease-in-out">
            <interventions class="px-1"  />
            Gestion des directeurs 
            </router-link>

            <router-link to="/Gestionpau" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-serif rounded-md border-blue-200 hover:bg-blue-200 hover:text-blue-800  transition duration-400 ease-in-out">
            <interventions class="px-1"   />
            Gestion des professeurs
            </router-link>

            <router-link to="/Gestioninterv" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-serif rounded-md border-blue-200 hover:bg-blue-200 hover:text-blue-800  transition duration-400 ease-in-out">
            <interventions class="px-1"  />
            Gestion des interventions
            </router-link>

            
            <router-link to="/Gestiongrade" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-serif rounded-md border-blue-200 hover:bg-blue-200 hover:text-blue-800  transition duration-400 ease-in-out">
            <Grade class="px-1"  />
            Gestion des grades
            </router-link>

            <router-link to="/Gestionetab" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-serif rounded-md border-blue-200 hover:bg-blue-200 hover:text-blue-800  transition duration-400 ease-in-out">
            <Shcool class="px-1"  />
            Gestion des établissements
            </router-link>


            <router-link to="/Profileau" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-serif rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
             <Profile class="px-1" /> Profil
            </router-link>


          </div>

          <div class="h-[50px]">
         <div>

    <div @click=signout() class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300 cursor-pointer  hover:text-gray-800 transition duration-400 ease-in-out ">
         <decconexion/>
        Déconnexion
    </div>
  </div>

</div>

        </div>
      </div>
    </div>
    <div class="w-full h-full bg-blue-400">
      <div class="h-[50px] bg-blue-100 flex items-center shadow-sm px-[20px] w-full py-[10px] z-10 border-b ">
        <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" w-[25px] h-[25px]">
            <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
          </svg>
        </div>
        <div class="w-[calc(100%-30px)] flex">
          <div class="w-[calc(100%-200px)] flex justify-center ">
          </div>
          <!-- User login -->

          <ul role="list" class="max-w-sm divide-y divide-gray-200">
            <li class="py-3 sm:py-4">
            <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
                <img class="w-8 h-8 rounded-full" src="@/assets/images/download.jpg" alt="Neil image">
            </div>
            <div class="flex-1 min-w-0">

                <p class="text-l text-gray-500 font-serif truncate " v-if="authenticated">
                  {{ user.email }}
                </p>

            </div>
            <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                Admin
            </span>
          </div>
          </li>
         </ul>  
        </div>
      </div>
      <div class="h-[calc(100vh-50px)] bg-blue-50 p-[20px]">
        <div class="border border-blue-300 rounded-md p-[20px] h-full">
          <router-view/>
        </div>
      </div>
    </div>
  </div>
</template>
 <script>
  import president from '@/components/Dashboard/Icons/president.vue';
 import Decconexion from '@/components/Dashboard/Icons/Decconexion.vue';
import Profile from '@/components/Dashboard/Icons/Profile.vue'
import interventions from '@/components/Dashboard/Icons/interventions.vue';
import intervention from '@/components/Dashboard/Icons/intervention.vue';
import Grade from '@/components/Dashboard/Icons/Grade.vue';
import Shcool from '@/components/Dashboard/Icons/Shcool.vue';

 import {mapGetters, mapActions} from 'vuex';
 import axios from 'axios';
 export default {
  components:{Decconexion,Profile,president,interventions,president,intervention,Grade,Shcool},
  data() {
  return {
    showSide: true
  }
},
computed: {
     ...mapGetters({
         'authenticated': 'auth/authenticated',
         'user': 'auth/user',
     })
 },
methods: {
  toggleSideBar() {
    this.showSide = !this.showSide
  },
  ...mapActions({
     'logout':'auth/logout'
  }),
  signout(){
     this.logout().then(()=>this.$router.push('/'))
  }, 
}

}
</script>
