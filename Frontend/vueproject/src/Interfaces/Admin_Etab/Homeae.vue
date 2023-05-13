<template>
    <div>
      <h3 class="text-2xl font-bold text-left py-2">Listes des profs</h3>
      <div class="flex justify-center items-end space-x-3">
        <div>
            <h1>Nom</h1>
            <input type="text" class="border  border-gray-500 px-3 py-2" v-model="name">
        </div>
        <div>
            <h1>Prénom</h1>
            <input type="text" class="border  border-gray-500 px-3 py-2" v-model="color">
        </div>
        <div>
            <h1>Ecole</h1>
            <input type="text" class="border  border-gray-500 px-3 py-2 " v-model="category">
        </div>
        <div>
            <h1>nombres d'heures</h1>
            <input type="text" class="border  border-gray-500 px-3 py-2" v-model="price">
        </div>
        <div class="">
           <button class="bg-gray-600 text-white px-3 py-2 hoover:bg-gray-500" @click="saved(haveid)">Save</button>
        </div>
      </div>
      <div class="overflow-x-auto relative  sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="py-3 px-6">
                Product name
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Color
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                      <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"></path>
                    </svg></a>
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Category
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                      <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"></path>
                    </svg></a>
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <div class="flex items-center">
                  Price
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                      <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"></path>
                    </svg></a>
                </div>
              </th>
              <th scope="col" class="py-3 px-6">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 " v-for="data in productyObj " :key="data.id">
              <th class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
               {{ data.name }}
              </th>
              <td class="py-4 px-6">
                {{ data.color }}
              </td>
              <td class="py-4 px-6">
                {{ data.category }}
              </td>
              <td class="py-4 px-6">
                {{ data.price }}
              </td>
              <td class="py-4 px-6 text-right">
                <div class="inline-flex">
                 <button  class="bg-blue-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="getdata(data.id)">
                   Edit
                 </button>
                 <button   class="bg-red-500 hoover:bg-blue-400 text-white font-bold py-2 px-4 rounded-i" @click="delet(data.id)">
                   Delete
                 </button>                 
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
    </div>
  </template>
  
  <script>
  export default {
  data(){
    return {
        name:'',
        color:'',
        category:'',
        price:null,  
        productyObj:[
        {
            id:1,
            name:'Azus',
            color:'Gold',
            category:' Ipad ',
            price:5000
        }
    ]
    }
  },
  methods:{
       delet(id){
        var index=this.productyObj.findIndex((data)=>data.id==id)
        this.productyObj.splice(index,1)
       },
       getdata(id){
        var dataObj=this.productyObj.filter((data)=>(data.id==id))
        //assign to input
        this.name=dataObj[0].name
        this.color=dataObj[0].color
        this.category=dataObj[0].category
        this.price=dataObj[0].price       
    },
       saved(haveid){
        //update
        if(haveid){
        var dataObj=this.productyObj.filter((data)=>(data.id==id))
        dataObj[0].name=this.name
        dataObj[0].color=this.color
        dataObj[0].category=this.category
        dataObj[0].price=this.price
        }else{
            //add data
        const id=this.productyObj.length+1
        const data={
            id:id,
            name:this.name,
            color:this.color,
            category:this.category,
            price:this.price,
        }
        this.productyObj.push(data); 
        }
    }
       }

  }

  </script>
  
  <style>
  
  </style>