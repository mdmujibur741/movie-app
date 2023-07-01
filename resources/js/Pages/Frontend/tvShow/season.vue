<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Card from '@/Components/Card.vue';



defineProps({
    tvShow : Array,
  season : Array,
 newTvShows : Object,
episodes : Array


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
                  <img v-if="season.poster_path"
                    class="w-full h-full rounded"
                    :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${season.poster_path}`"
                  />
                  <img v-else src="../../../../../public/movie.jpg" alt="">
                </div>
              </div>
              <div class="w-4/12">
                <div class="m-4 p-6">
                  <h1 class="flex text-white font-bold text-4xl">
                    {{ tvShow.name }} <br>
                    {{ season.name }}
                  </h1>
                    <span class="font-xl text-white"> {{ tvShow.created_year }} </span>
                       </div>
           
              </div>

              <div class="w-4/12">
                <div class="m-4 p-6">
                  <h1 class="flex text-white font-bold text-4xl">
                     Latest Tv show
                  </h1>
                  <div class="grid grid-cols-3 gap-2" v-if="newTvShows.length">
                    <Link
                      v-for="tv in newTvShows"
                      :key="tv.id"
                      :href="`/series/${tv.slug}`"
                    >
                      <img v-if="tv.poster_path"
                        class="w-full h-full rounded-lg"
                        :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${tv.poster_path}`"
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
            Episodes
              </h1>
              <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                <Card v-for="episode in episodes" :key="episode.id">
                  <template #image>
                    <Link :href="`/series/${tvShow.slug}/season/${season.slug}/episode/${episode.slug}`">
                      <img v-if="season.poster_path"
                        class=""
                        :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${season.poster_path}`"
                      />
                      <img v-else
                      class=""
                       src="../../../../../public/movie.jpg"
                    />
                    </Link>
                  </template>
                  <Link :href="`/series/${tvShow.slug}/season/${season.slug}/episode/${episode.slug}`">
                    <span class="text-slate-600 dark:text-white">{{
                      episode.name
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
  
