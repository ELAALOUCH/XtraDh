import { createRouter, createWebHistory } from 'vue-router'
import Login from '../Pages/auth/Login.vue'
import NotFound from '@/views/NotFound.vue'
import Forgetpassword from '@/Pages/auth/Forgetpassword.vue'
import Resetpassword from '@/Pages/auth/Resetpassword.vue'
import Wait from '@/Pages/auth/Wait.vue'
import Dash_au from '@/Interfaces/Admin_Univ/Dash_au.vue'
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
