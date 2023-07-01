<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Card from '@/Components/Card.vue';



defineProps({
  movies: Array,
   cast: Array,
   casts : Object
 
});


</script>






<template>
  <FrontendLayout>
    <main  class="my-2 bg-purple-100 dark:bg-slate-600">
    <section class="bg-purple-600 dark:bg-slate-700">
         <div class="max-w-6xl mx-auto m-4 p-2">
           <div class="flex">
             <div class="w-4/12">
               <div class="w-full">
                 <img v-if="cast.poster_path"
                   class="w-full h-full rounded"
                   :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${cast.poster_path}`"
                 />
                 <img v-else src="../../../../../public/movie.jpg" alt="">
               </div>
             </div>
             <div class="w-4/12">
               <div class="m-4 p-6">
                 <h1 class="flex text-white font-bold text-4xl">
                   {{ cast.name }} <br>
                  
                 </h1>
                 <h3 class="flex text-white font-bold text-2xl">
                      Cast Movies ({{ movies.length }})
                 </h3>
                      </div>
          
             </div>

             <div class="w-4/12">
               <div class="m-4 p-6">
                 <h1 class="flex text-white font-bold text-4xl">
                    Latest Cast
                 </h1>
                 <div class="grid grid-cols-3 gap-2" v-if="casts.length">
                   <Link
                     v-for="lCast in casts"
                     :key="lCast.id"
                     :href="`/casts/${lCast.slug}`"
                   >
                     <img v-if="lCast.poster_path"
                       class="w-full h-full rounded-lg"
                       :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${lCast.poster_path}`"
                     />

                     <img v-else src="../../../../../public/movie.jpg" class="w-full h-full rounded-lg" alt="">
                   </Link>
                 </div>
           
                 </div>    
           </div>
              
             </div>
           </div>
           
       </section>  
 <section
         class="max-w-6xl mx-auto bg-purple-200 dark:bg-gray-900 p-2 rounded"
       >
         <div class="flex justify-between">
           <div class="w-full mx-auto">
             <h1 class="flex text-slate-600 dark:text-white font-bold text-xl">
           Movies
             </h1>
             <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
               <Card v-for="movie in movies" :key="movie.id">
                 <template #image>
                   <Link :href="`/movies/${movie.slug}`">
                     <img v-if="movie.poster_path"
                       class=""
                       :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${movie.poster_path}`"
                     />
                     <img v-else
                     class=""
                      src="../../../../../public/movie.jpg"
                   />
                   </Link>
                 </template>
                 <Link :href="`/movies/${movie.slug}`">
                   <span class="text-slate-600 dark:text-white">{{
                     movie.title
                   }}</span>
                 </Link>
               </Card>
             </div>
           </div>
           

         
         </div>
     
       </section>   
 
       
     </main>
   </FrontendLayout> 

    

    </template>
  

  
  <style scoped>
     

  </style>