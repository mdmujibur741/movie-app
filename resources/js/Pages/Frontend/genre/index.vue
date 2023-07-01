<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Card from '@/Components/Card.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    movies : Object,
    genre : String,
})

</script>

<template>
    <Head title="Home" />
    <FrontendLayout>
   <main class="lg:w-10/12 md:w-11/12 sm:w-full mx-auto">


    <!-- Movie Section -->
     <section class="bg-blue-50 dark:bg-gray-900 dark:text-white mt-4 p-3 rounded">
        <div  class=" m-2 p-2 text-2xl font-bold text-indigo-600 dark:text-indigo-300
        "
      >
        <h1 class="text-black dark:text-slate-400 text-xl capitalize font-bold"> {{ genre }} Movies</h1>
      </div>
 
       <div class=" grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 rounded">
        <Card v-for="movie in movies.data" :key="movie.id">
            <template #image>
              <Link :href="`/movies/${movie.slug}`">
                <div class="aspect-w-2 aspect-h-3">
                  <img
                    class="object-cover"
                    :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${movie.poster_path}`"
                  />
                </div>
                <div
                  class=" absolute x-10 left-2 top-2 h-6 w-12 bg-gray-800 group-hover:bg-gray-700 text-blue-400 text-center rounded
                  " >
                  Latest
                </div>
            
                <div
                  class="
                    absolute
                    inset-y-0
                    left-1/2
                    right-1/2
                    z-10
                    invisible
                    group-hover:visible
                    flex
                    items-center
                    justify-center
                  "
                >
               <div>
                <i class="fa-solid fa-circle-play h-16 w-16 text-blue-700 bg-gray-50 rounded-full"></i>
               </div>
             
                 
                </div>
                <div
                  class="
                    absolute
                    flex flex-wrap
                    z-10
                    bottom-2
                    left-2
                    text-indigo-300 text-sm
                    font-bold
                    group-hover:text-blue-700
                  "
                >
                  
                </div>
              </Link>
            </template>
            <Link :href="`/movies/${movie.slug}`">
              <div class="dark:text-white font-bold group-hover:text-blue-400">
                {{ movie.title }}
              </div>
            </Link>
          </Card>
       </div>

       <div class="flex justify-center">
        <Pagination :links="movies.links"/>
       </div>

          
     </section>


    
   </main>

    
</FrontendLayout>
</template>

