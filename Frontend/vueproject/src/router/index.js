import { createRouter, createWebHistory } from 'vue-router'
import Login from '../Pages/auth/Login.vue'
import NotFound from '@/views/NotFound.vue'
const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
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
