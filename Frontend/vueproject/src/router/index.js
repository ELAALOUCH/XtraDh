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
import Homeae from '@/Interfaces/Admin_Etab/Homeae.vue'
import Homeau from '@/Interfaces/Admin_Univ/Homeau.vue'
import Homede from '@/Interfaces/Directeur_Etab/Homede.vue'
import Homepu from '@/Interfaces/President_Univ/Homepu.vue'
import Homeu from '@/Interfaces/Users/Homeu.vue'
import Profileae from '@/Interfaces/Admin_Etab/Profileae.vue'
import Profileau from '@/Interfaces/Admin_Univ/Profileau.vue'
import Profilede from '@/Interfaces/Directeur_Etab/Profilede.vue'
import Profilepu from '@/Interfaces/President_Univ/Profilepu.vue'
import Profileu from '@/Interfaces/Users/Profileu.vue'
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
    children :[
      {
      path: '/Homeau',
      component: Homeau
      },
      {
        path: '/Profileau',
        component:Profileau
      }]
  },
  {
    path:'/Dash_ae',
    name:'Dash_ae',
    component:Dash_ae,
    children :[
      {
        path: '/Homeae',
        component: Homeae
      },
      {
        path: '/Profileae',
        component:Profileae
      }]
  },
  {
    path:'/Dash_de',
    name:'Dash_de',
    component:Dash_de,
    children :[
      {
        path: '/Homede',
        component: Homede
      },
      {
        path: '/Profilede',
        component:Profilede
      }]
  },
  {
    path:'/Dash_pu',
    name:'Dash_pu',
    component:Dash_pu,
    children :[
      {
        path: '/Homepu',
        component: Homepu
      },
      {
        path: '/Profilepu',
        component:Profilepu
      }]
  },
  {
    path:'/Dash_users',
    name:'Dash_users',
    component:Dash_users,
    children :[
      {
        path: '/Homeu',
        component: Homeu
      },
      {
        path: '/Profileu',
        component:Profileu
      }]
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
