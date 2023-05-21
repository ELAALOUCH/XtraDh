import { createRouter, createWebHistory } from 'vue-router'
import Login from '../Pages/auth/Login.vue'
import NotFound from '@/views/NotFound.vue'
import Forgetpassword from '@/Pages/auth/Forgetpassword.vue'
import Resetpassword from '@/Pages/auth/Resetpassword.vue'
import Wait from '@/Pages/auth/Wait.vue'

import Dash_au from '@/Interfaces/Admin_Univ/Master/Dash_au.vue'
import Dash_ae from '@/Interfaces/Admin_Etab/Master/Dash_ae.vue'
import Dash_de from '@/Interfaces/Directeur_Etab/Master/Dash_de.vue'
import Dash_pu from '@/Interfaces/President_Univ/Master/Dash_pu.vue'
import Dash_users from '@/Interfaces/Users/Master/Dash_users.vue'

import Gestionde from '@/Interfaces/Admin_Univ/Gestionde.vue'
import Gestionae from '@/Interfaces/Admin_Univ/Gestionae.vue'
import Gestionpau from '@/Interfaces/Admin_Univ/Gestionpau.vue'
import Profileau from '@/Interfaces/Admin_Univ/Profileau.vue'



import Gestionpae from '@/Interfaces/President_Univ/Gestionpae.vue'
import Gestionpde from '@/Interfaces/President_Univ/Gestionpde.vue'
import GestionpI from '@/Interfaces/President_Univ/GestionpI.vue'
import GestionpG from '@/Interfaces/President_Univ/GestionpG.vue'
import GestionE from '@/Interfaces/President_Univ/GestionE.vue'
import Gestionpp from '@/Interfaces/President_Univ/Gestionpp.vue'
import Gestionpuau from '@/Interfaces/President_Univ/Gestionpuau.vue'


  
import Gestionp from '@/Interfaces/Admin_Etab/Gestionp.vue'
import GestionaI from '@/Interfaces/Admin_Etab/GestionaI.vue'


import Gestiondp from '@/Interfaces/Directeur_Etab/Gestiondp.vue'
import GestiondI from '@/Interfaces/Directeur_Etab/GestiondI.vue'

import Profhome from '@/Interfaces/Users/Profhome.vue' 
import Profln from '@/Interfaces/Users/Profln.vue' 


import store from '@/store';
const routes = [

  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path:'/Forgetpassword',
    name:'Forgetpassword',
    component:Forgetpassword
  },
  {
    path:'/Wait',
    name:'Wait',
    component:Wait
  },
  {
    path:'/Resetpassword',
    name:'Resetpassword',
    component:Resetpassword
  },



  {
    path:'/Dash_au',
    name:'Dash_au',
    component:Dash_au,
    /*beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }

      next()

    },*/
    redirect:'Gestionae',
    children :[
      {
      path: '/Gestionae',
      component: Gestionae
      },
      {
        path:'/Gestionde',
        component:Gestionde
      },
      {
        path:'/Gestionpau',
        component:Gestionpau
      },
      {
        path:'/Profileau',
        component:Profileau
      }

    ]
  },



  {
    path:'/Dash_ae',
    name:'Dash_ae',
    component:Dash_ae,
    /*beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }

      next()

    },*/
    redirect:'Gestionp',
    children :[
      {
        path: '/Gestionp',
        component: Gestionp
      },
      {
        path:'/GestionaI',
        component:GestionaI
      }
]
  },


  {
    path:'/Dash_de',
    name:'Dash_de',
    component:Dash_de,
    /*beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }

      next()

    },*/
    redirect:'Gestiondp',
    children :[
      {
        path: '/Gestiondp',
        component: Gestiondp
      },
      {
        path:'/GestiondI',
        component:GestiondI
      }
]
  },



  {
    path:'/Dash_pu',
    name:'Dash_pu',
    component:Dash_pu,
    /*beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }

      next()

    },*/
    redirect:'Gestionpae',
    children :[
      {
        path: '/Gestionpae',
        component: Gestionpae
      },
      {
        path: '/Gestionpde',
        component:Gestionpde
      },
      {
        path:'/GestionpI',
        component:GestionpI
      },
      {
        path:'/GestionpG',
        component:GestionpG
      },
      {
        path:'/GestionE',
        component:GestionE
      },
      {
        path:'/Gestionpp',
        component:Gestionpp       
      },
      {
        path:'/Gestionpuau',
        component:Gestionpuau       
      }
 
    ]
  },


  {
    path:'/Dash_users',
    name:'Dash_users',
    component:Dash_users,
    /*beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }

      next()
    },*/
    redirect:'Profhome',
    children :[
      {
        path:'/Profhome',
        component:Profhome,
      },
      {
       path:'/Profln',
       component:Profln,
      }
    ]
  },

   {
    path:'/:catchAll(.*)',
    name:'NotFound',
    component: NotFound
   }  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
