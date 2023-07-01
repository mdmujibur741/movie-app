<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Card from '@/Components/Card.vue';



defineProps({
  tvShow : Array,
season : String,
episode : Array,
newTvShows : Object

});




</script>






<template>
  
 <FrontendLayout>
     <main  class="my-2 bg-purple-100 dark:bg-slate-600">
     <section class="bg-purple-600 dark:bg-slate-700">
          <div class="max-w-6xl mx-auto m-4 p-2">
            <div class="flex">
              <div class="w-4/12 ">
                <div class="w-full">
                  <img v-if="tvShow.poster_path"
                    class="w-80 rounded"
                    :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${tvShow.poster_path}`"
                  />
                  <img v-else src="../../../../../public/movie.jpg" alt="">
                </div>
              </div>
              <div class="w-6/12">
                <div class="m-4 p-6">
                  <h1 class="flex text-white font-bold text-2xl">
                    {{ tvShow.name }} <br>
                    {{ season }} <br>
                   Episode  {{ episode.episode_number }}
                  </h1>
                    <span class="font-xl text-white"> {{ tvShow.created_year }} </span>
                       </div>
                  <div class="my-2 text-justify text-white dark:text-slate-300">
                         {{ episode.overview }}
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
           Latest Tv Show
              </h1>
              <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                <Card v-for="tv in newTvShows" :key="tv.id">
                  <template #image>
                    <Link :href="`/series/${tv.slug}`">
                      <img v-if="tv.poster_path"
                        class=""
                        :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${tv.poster_path}`"
                      />
                      <img v-else
                      class=""
                       src="../../../../../public/movie.jpg"
                    />
                    </Link>
                  </template>
                  <Link :href="`/series/${tv.slug}`">
                    <span class="text-slate-600 dark:text-white">{{
                      tv.name
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
  
