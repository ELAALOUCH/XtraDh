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

import Gestionae from '@/Interfaces/Admin_Univ/Gestionae.vue'
import Profileau from '@/Interfaces/Admin_Univ/Profileau.vue'
import Gestionpu from '@/Interfaces/Admin_Univ/Gestionpu.vue'




import GestionpI from '@/Interfaces/President_Univ/GestionpI.vue'
import ConsultationP from '@/Interfaces/President_Univ/ConsultationP.vue'
import ConsoI from '@/Interfaces/President_Univ/ConsoI.vue'
import Profilepu from '@/Interfaces/President_Univ/Profilepu.vue'


  
import Gestionp from '@/Interfaces/Admin_Etab/Gestionp.vue'
import GestionaI from '@/Interfaces/Admin_Etab/GestionaI.vue'
import Gestionde from '@/Interfaces/Admin_Etab/Gestionde.vue'
import Profileae from '@/Interfaces/Admin_Etab/Profileae.vue'
import Editi from '@/components/Dashboard/Intervention/Editi.vue'



import GestiondI from '@/Interfaces/Directeur_Etab/GestiondI.vue'
import Profilede from '@/Interfaces/Directeur_Etab/Profilede.vue'
import ConsodI from '@/Interfaces/Directeur_Etab/ConsodI.vue'
import Consodp from '@/Interfaces/Directeur_Etab/Consodp.vue'
import Editd from '@/components/Dashboard/etab/Directeur/Editd.vue'




//import Profhome from '@/Interfaces/Users/Profhome.vue' 
import Profileprof from '@/Interfaces/Users/Profileprof.vue'
import interp from '@/Interfaces/Users/interp.vue'
import paimep from '@/Interfaces/Users/paimep.vue'
import Edit from '@/components/Dashboard/Prof/Edit.vue'




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
    component:Wait,
    beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }

      next()

    },
  },
  {
    path:'/Resetpassword/:token',
    name:'Resetpassword',
    component:Resetpassword,
    /*beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }

      next()

    },*/
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
        path:'/Gestionpu',
        component:Gestionpu
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
        path:'/Gestionp/Edit/:id',
        component:Edit
      },
      {
        path:'/GestionaI',
        component:GestionaI
      },
      {
        path:'/GestionaI/Edit/:id',
        component:Editi
      },
      {
        path: '/Gestionde',
        component:Gestionde
      },
      {
        path:'/Gestionde/Edit/:id',
        component:Editd
      },      
      {
        path: '/Profileae',
        component:Profileae
      },
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
    redirect:'Profilede',
    children :[

      {
        path:'/GestiondI',
        component:GestiondI
      },
      {
        path:'/Profilede',
        component:Profilede
      },
      {
        path:'/ConsodI',
        component:ConsodI
      },
      {
        path:'/Consodp',
        component:Consodp
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
    redirect:'Profilepu',
    children :[
      {
        path:'/GestionpI',
        component:GestionpI
      },
      {
        path:'/ConsultationP',
        component:ConsultationP
      },
      {
        path:'/ConsoI',
        component:ConsoI
      }, 
      {
        path:'/Profilepu',
        component:Profilepu   
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
    redirect:'Profileprof',
    children :[
      {
        path:'/Profileprof',
        component:Profileprof
      },
      {
        path:'/interp',
        component:interp
      },
      {
        path:'/paimep',
        component:paimep
      },
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
