<template>
  <div class="w-screen h-screen flex">
    <!-- Side bar -->
    <div class="w-[400px] h-full bg-blue-200 text-white" v-show="showSide">
      <div class="h-[50px] bg-blue-950 flex justify-start  items-center ">
        <div class="px-[20px]">
          <h3 class="font-bold text-xl">Président Univ</h3>
        </div>
      </div>
      <div class="h-[calc(100vh-50px)] bg-blue-800 py-[20px]">
        <div class="flex flex-col justify-between h-full px-[20px] space-y-[10px]">
          <div class=" flex flex-col justify-between space-y-[10px]">



          <router-link to="/ConsoI" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
             <intervention/>
             consultations des Interventions
            </router-link>

            <router-link to="/GestionpI" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
             <interges/>
             Gestion des Interventions
            </router-link>


            <router-link to="/ConsultationP" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
            <eye/> Consultation de paiments
            </router-link>


            <router-link to="/Profilepu" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-blue-200 hover:bg-blue-300  hover:text-blue-800 transition duration-400 ease-in-out">
            <Profile/> Profile
            </router-link>

         </div>



          <div class="h-[50px]">
            <div>
              <div @click=signout()  class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300 hover:text-gray-800  transition duration-400 ease-in-out">
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
            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
          </svg>
        </div>
        <!-- Search bar -->
        <div class="w-[calc(100%-30px)] flex">
          <div class="w-[calc(100%-200px)] flex justify-center ">
            <!-- Search bar -->
          </div>
          <!-- User login -->
          <div class="w-[200px] ">
            <div class="flex items-center justify-start space-x-4" @click="toggleDrop">
              <img class="w-10 h-10 rounded-full border-2 border-blue-50" src="@/assets/images/download.jpg">
              <div class="font-semibold dark:text-white text-left">
                <div v-if="authenticated">{{ user.email }}</div>
                <div class="text-xs text-blue-500 dark:text-blue-400">Admin</div>
              </div>
            </div>
          </div>
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

