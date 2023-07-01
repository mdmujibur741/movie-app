<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Card from '@/Components/Card.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    casts : Object,
   
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
        <h1 class="text-black dark:text-slate-400 text-xl capitalize font-bold">Movies</h1>
      </div>
 
       <div class=" grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 rounded">
        <Card v-for="cast in casts.data" :key="cast.id">
            <template #image>
              <Link :href="`/movies/${cast.slug}`">
                <div class="aspect-w-2 aspect-h-3">
                  <img
                    class="object-cover"
                    :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${cast.poster_path}`"
                  />
                </div>
            
            
               
           
              </Link>
            </template>
            <Link :href="`/movies/${cast.slug}`">
              <div class="dark:text-white font-bold group-hover:text-blue-400">
                {{ cast.name }}
              </div>
            </Link>
          </Card>
       </div>

       <div class="flex justify-center">
        <Pagination :links="casts.links"/>
       </div>

          
     </section>


    
   </main>

    
</FrontendLayout>
</template>
