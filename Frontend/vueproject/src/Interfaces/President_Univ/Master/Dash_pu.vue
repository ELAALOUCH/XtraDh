<template>
  <div class="w-screen overflow-y-hidden h-screen flex">
    <!-- Side bar -->
    <div class="w-[200px] h-full bg-blue-200 text-white" v-show="showSide">
      <div class="h-[50px] w-[200px] bg-blue-950 flex justify-start  items-center ">
        <div class="px-[20px]">
          <h3 class="font-serif text-xl"> Président </h3>
        </div>
      </div>
      <div class="h-[calc(100vh-50px)] bg-blue-800 py-[20px]">
        <div class="flex flex-col justify-between h-full px-[20px] space-y-[10px]">
          <div class=" flex flex-col justify-between space-y-[10px]">



          <router-link to="/ConsoI" class="font-serif inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
             <intervention/>
             consultations des Interventions
            </router-link>

            <router-link to="/GestionpI" class="font-serif inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
             <interges/>
             Gestion des Interventions
            </router-link>


            <router-link to="/ConsultationP" class="font-serif inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
            <eye/> Consultation des paiements
            </router-link>


            <router-link to="/Profilepu" class="font-serif inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
            <Profile/>Profile
            </router-link>

         </div>



          <div class="h-[50px]">
            <div>
              <div @click=signout()  class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md hover:text-gray-800  transition duration-400 ease-in-out">
                <Decconexion/>
                Déconnexion
              </div>
          </div>
          </div>


        </div>
      </div>
    </div>
    <div class="w-full h-full bg-blue-400">
      <div class="h-[50px] bg-blue-100 flex items-center shadow-sm px-[20px] w-full py-[10px] z-10 border-b ">
        <!-- Hambuger menu -->
        <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" w-[25px] h-[25px]">
            <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
          </svg>
        </div>
        <!-- Search bar -->
        <div class="w-[calc(100%-30px)] flex">
          <div class="w-[calc(100%-200px)] flex justify-center ">
            <!-- Search bar -->
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
                Président
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
    <!-- Main  -->
  </div>
</template>
 <script>
 import Decconexion from '@/components/Dashboard/Icons/Decconexion.vue';
 import Profile2 from '@/components/Dashboard/Icons/Profile2.vue';
import Profile from '@/components/Dashboard/Icons/Profile.vue'
import intervention from '@/components/Dashboard/Icons/intervention.vue';
import eye from '@/components/Dashboard/Icons/eye.vue';
import interges from '@/components/Dashboard/Icons/interges.vue';
import axios from 'axios';
  import { mapGetters ,mapActions} from 'vuex'

 export default {
  components:{Decconexion,Profile,Profile2,intervention,eye,interges},
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
  /* getNonce() {
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
},*/
}
 }
</script>

