import { createRouter, createWebHistory } from 'vue-router'
import Login from '../Pages/auth/Login.vue'
import NotFound from '@/views/NotFound.vue'
import Forgetpassword from '@/Pages/auth/Forgetpassword.vue'
import Resetpassword from '@/Pages/auth/Resetpassword.vue'
import Wait from '@/Pages/auth/Wait.vue'
import Dash_au from '@/Interfaces/Admin_Univ/Dash_au.vue'
import Dash_ae from '@/Interfaces/Admin_Etab/Dash_ae.vue'
import Dash_de from '@/Interfaces/Directeur_Etab/Dash_de.vue'
import Dash_pu from '@/Interfaces/President_Univ/Dash_pu.vue'
import Dash_users from '@/Interfaces/Users/Dash_users.vue'

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
    component:Dash_au
  },
  {
    path:'/Dash_ae',
    name:'Dash_ae',
    component:Dash_ae
  },
  {
    path:'/Dash_de',
    name:'Dash_de',
    component:Dash_de
  },
  {
    path:'/Dash_pu',
    name:'Dash_pu',
    component:Dash_pu
  },
  {
    path:'/Dash_users',
    name:'Dash_users',
    component:Dash_users
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
