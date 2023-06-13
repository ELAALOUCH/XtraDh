import { createRouter, createWebHistory } from 'vue-router'
import store from '@/store';

import Login from '../Pages/auth/Login.vue'
import NotFound from '@/views/NotFound.vue'
import NotFound2 from '@/views/NotFound2.vue'
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
import Gestionpau from '@/Interfaces/Admin_Univ/Gestionpau.vue'
import Gestiondeau from '@/Interfaces/Admin_Univ/Gestiondeau.vue'
import Gestioninterv from '@/Interfaces/Admin_Univ/Gestioninterv.vue'
import Editpu from '@/components/Dashboard/Président/Editpu.vue'
import Editae from '@/components/Dashboard/etab/Admin/Editae.vue'
import Gestiongrade from '@/Interfaces/Admin_Univ/Gestiongrade.vue'
import Gestionetab from '@/Interfaces/Admin_Univ/Gestionetab.vue'
import editetb from '@/components/Dashboard/etablissement/editetb.vue'
import editgrd from '@/components/Dashboard/grade/editgrd.vue'
import Editpau from '@/components/Dashboard/Prof/Editpau.vue'
import Editdau from '@/components/Dashboard/etab/Directeur/Editdau'
import createint from '@/components/Dashboard/Intervention/createint.vue'
import editinterv from '@/components/Dashboard/Intervention/editinterv.vue'





import GestionpI from '@/Interfaces/President_Univ/GestionpI.vue'
import ConsultationP from '@/Interfaces/President_Univ/ConsultationP.vue'
import ConsoI from '@/Interfaces/President_Univ/ConsoI.vue'
import Profilepu from '@/Interfaces/President_Univ/Profilepu.vue'



import Gestionp from '@/Interfaces/Admin_Etab/Gestionp.vue'
import GestionaI from '@/Interfaces/Admin_Etab/GestionaI.vue'
import Gestionde from '@/Interfaces/Admin_Etab/Gestionde.vue'
import Profileae from '@/Interfaces/Admin_Etab/Profileae.vue'
import crintadminet from '@/components/Dashboard/Intervention/crintadminet.vue'
import edintadminet from '@/components/Dashboard/Intervention/edintadminet.vue'





import GestiondI from '@/Interfaces/Directeur_Etab/GestiondI.vue'
import Profilede from '@/Interfaces/Directeur_Etab/Profilede.vue'
import ConsodI from '@/Interfaces/Directeur_Etab/ConsodI.vue'
import Consodp from '@/Interfaces/Directeur_Etab/Consodp.vue'
import Editd from '@/components/Dashboard/etab/Directeur/Editd.vue'




import Profileprof from '@/Interfaces/Users/Profileprof.vue'
import interp from '@/Interfaces/Users/interp.vue'
import paimep from '@/Interfaces/Users/paimep.vue'
import ancienfiche from '@/Interfaces//Users/ancienfiche.vue'
import Edit from '@/components/Dashboard/Prof/Edit.vue'



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
 
  },
  {
    path:'/Resetpassword/:token',
    name:'Resetpassword',
    component:Resetpassword,
    
  },


  
  {
    path:'/Dash_au',
    name:'Dash_au',
    component:Dash_au,
    beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }
      const user=store.getters['auth/user'];
     if(user.type!='admin_univ'){
      return next({name:'NotFound2'})
     }
      next()

    },
    redirect:'Gestionae',
    children :[
      {
      path: '/Gestionae',
      component: Gestionae
      },
      {
        path: '/Gestionae/Edit/:id',
        component: Editae
      },
      {
        path:'/Gestionpu',
        component:Gestionpu
      },      
      {
        path:'/Gestionpu/Edit/:id',
        component:Editpu
      },
      {
        path:'/Profileau',
        component:Profileau
      },
      {
        path: '/Gestionpau',
        component: Gestionpau
      },
     {
        path:'/Gestionpau/Edit/:id',
        component:Editpau
      },
      {
        path: '/Gestiondeau',
        component:Gestiondeau
      },
      {
        path:'/Gestiondeau/Edit/:id',
        component:Editdau
      },
      

      {
        path:'/Gestioninterv',
        component:Gestioninterv
      },
      {
        path:'/Gestioninterv/Create',
        component:createint
      },
      {
        path:'/Gestioninterv/Edit/:id',
        component:editinterv
      },


      {
        path:'/Gestiongrade',
        component:Gestiongrade
      },
      {
        path:'/Gestiongrade/Edit/:id',
        component:editgrd
      },
      {
        path:'/Gestionetab',
        component:Gestionetab
      },
      {
        path:'/Gestionetab/Edit/:id',
        component:editetb
      }

    ]
  },



  {
    path:'/Dash_ae',
    name:'Dash_ae',
    component:Dash_ae,
    beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }
      const user=store.getters['auth/user'];
     if(user.type!='admin_etb'){
      return next({name:'NotFound2'})
     }
      next()

    },
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
        component:edintadminet
      },
      {
        path:'/GestionaI/Create',
        component:crintadminet
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
    beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }
      const user=store.getters['auth/user'];
     if(user.type!='directeur_etb'){
      return next({name:'NotFound2'})
     }
      next()

    },
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
    beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }
      const user=store.getters['auth/user'];
     if(user.type!='president_univ'){
      return next({name:'NotFound2'})
     }
      next()

    },
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
    beforeEnter: (to, from, next) => {
      
      if(!store.getters['auth/authenticated']) {
        return next({ name: 'Login' })
      }
      const user=store.getters['auth/user'];
     if(user.type!='prof'){
      return next({name:'NotFound2'})
     }
      next()

    },
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
       {
        path:'/ancienfiche',
        component:ancienfiche
       }
    ]
  },

   {
    path:'/:catchAll(.*)',
    name:'NotFound',
    component: NotFound
   }  
   ,
   {
    path:'/NotFound2',
    name:'NotFound2',
    component: NotFound2
   }  
   ,
   
   
]





const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
