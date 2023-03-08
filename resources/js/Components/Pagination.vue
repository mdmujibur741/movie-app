<template>
    <div v-if="(links.length > 3)" class="p-1 flex justify-center items-center mt-1">
        <nav class="isolate inline-flex gap-x-0.5 shadow-sm px-5 py-2 bg-gray-50 drop-shadow-lg rounded-xl" aria-label="Pagination">      
            <Link v-for="link in links" :key="link.id" :href="link.url" class="relative z-10 inline-flex items-center border border-green-400 bg-indigo-50 px-3 py-1 text-sm font-medium text-gray-600 focus:z-20 rounded-xl " v-html="link.label"/> 
          </nav>
      </div>
</template>


<script setup>
        import { Link } from '@inertiajs/vue3';

        defineProps({
               links: Object
        })
</script>