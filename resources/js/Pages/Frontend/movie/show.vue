<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Card from '@/Components/Card.vue';



defineProps({
  movie: Array,
  newMovies: Object,
   casts: Array,
   tags: Array,
   triller : Array

//   downloads: Array,
});
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'

const isOpen = ref(false)

function closeModal() {
  isOpen.value = false
}
function openModal() {
  isOpen.value = true
}

</script>






<template>
    <FrontendLayout>
     <main  class="my-2 bg-purple-100">
      <section class="bg-purple-600">
          <div class="max-w-6xl mx-auto m-4 p-2">
            <div class="flex">
              <div class="w-3/12">
                <div class="w-full">
                  <img
                    class="w-full h-full rounded"
                    :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${movie.poster_path}`"
                  />
                </div>
              </div>
              <div class="w-8/12">
                <div class="m-4 p-6">
                  <h1 class="flex text-white font-bold text-4xl">
                    {{ movie.title }}
                  </h1>
                  <div class="flex p-3 text-white space-x-4">
                    <span>{{ movie.release_date }}</span>
                    <span class="ml-2 space-x-1">
                      <Link
                        v-for="genre in movie.genres"
                        :key="genre.id"
                        class="font-bold hover:text-blue-500"
                        :href="`/genre/${genre.slug}`"
                      >
                        {{ genre.title }},
                      </Link>
                    </span>
                    <span class="flex space-x-2 gap-x-2">
                      {{ movie.runtime }} Minute
                      <i class="fa-solid fa-clock text-indigo-50 w-4 h-4 mt-1"></i> 
                    </span>
                  </div>
               <div class="flex space-x-4">
                    <button
                      class="
                        px-4
                        py-2
                        text-sm
                        font-medium
                        text-white
                        bg-black
                        rounded-md
                        bg-opacity-20
                        hover:bg-opacity-30
                        focus:outline-none
                        focus-visible:ring-2
                        focus-visible:ring-white
                        focus-visible:ring-opacity-75
                      "
                      v-for="trailer in triller"
                      :key="trailer.id"
                      @click="openModal(trailer)"
                    >
                       Triller
                    </button>
                  </div>   
            </div>
                <div class="p-8 text-white">
                  <p>{{ movie.overview }}</p>
                </div>
              </div>
            </div>
               </div>
        </section> 
      <section
          class="max-w-6xl mx-auto bg-purple-200 dark:bg-gray-900 p-2 rounded"
        >
          <div class="flex justify-between">
            <div class="w-7/12">
              <h1 class="flex text-slate-600 dark:text-white font-bold text-xl">
                Movie Casts
              </h1>
              <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                <Card v-for="cast in casts" :key="cast.id">
                  <template #image>
                    <Link :href="`/casts/${cast.slug}`">
                      <img
                        class=""
                        :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${cast.poster_path}`"
                      />
                    </Link>
                  </template>
                  <Link :href="`/casts/${cast.slug}`">
                    <span class="text-slate-600 dark:text-white">{{
                      cast.name
                    }}</span>
                  </Link>
                </Card>
              </div>
            </div>
            <div class="w-4/12">
              <h1
                class="flex text-slate-600 dark:text-white font-bold text-xl mb-4"
              >
                New Movies
              </h1>
              <div class="grid grid-cols-3 gap-2" v-if="newMovies.length">
                <Link
                  v-for="mv in newMovies"
                  :key="mv.id"
                  :href="`/movies/${mv.slug}`"
                >
                  <img
                    class="w-full h-full rounded-lg"
                    :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${mv.poster_path}`"
                  />
                </Link>
              </div>
            </div>
          
          </div>
          <span v-if="tags"
          v-for="tag in tags"
          :key="tag.id"
          class="font-bold text-black hover:text-indigo-800 cursor-pointer"
          ><Link :href="`/tags/${tag.slug}`" class="ml-2"
            >#{{ tag.tag_name }}</Link
          ></span
        >
        </section> 
  
        
      </main>
    </FrontendLayout>


    <TransitionRoot appear :show="isOpen" as="template">
      <Dialog as="div"  @close="closeModal" class="relative z-10 ">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>
  
        <div class="fixed inset-0 overflow-y-auto ">
          <div
            class="flex min-h-full items-center justify-center p-4 text-center "
          >
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
             
            >
              <DialogPanel
                class="  w-full max-w-3xl transform overflow-x-auto rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                style="maxHeight: 90vh " >
                <DialogTitle
                  as="h3" v-if="triller.length > 0"
                  class="text-lg font-medium leading-6 text-gray-900"
                >
                  {{triller[0].name}}
                </DialogTitle>
                <div class="mt-2 ">
                  <div v-if="triller.length > 0" class="aspect-w-16 aspect-h-9" v-html="triller[0].embed_html">

                  </div>
                </div>
  
                <div class="mt-4">
                  <button
                    type="button"
                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    @click="closeModal"
                  >
                    Close
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>

    </template>
  

  
  <style scoped>
     

  </style>