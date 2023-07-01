<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import Footer from '@/Components/Footer.vue';
import HomeModal from '../Components/HomeModal.vue';




defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
const open = ref(false);
const openMobileMenu = ref(false);



const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

       

        <div class="min-h-screen bg-gray-100 dark:bg-gray-700">
              <!-- navbar -->
              <div
              class="w-full text-gray-700 bg-white dark:text-gray-200 dark:bg-gray-800"
            >
              <div
                class="
                  flex flex-col
                  max-w-screen-xl
                  px-4
                  mx-auto
                  md:items-center md:justify-between md:flex-row md:px-6
                  lg:px-8
                "
              >
                <div class="p-4 flex flex-row items-center justify-between space-x-2">
                  <Link
                    href="/"
                    class="
                      text-lg
                      font-semibold
                      tracking-widest
                      text-gray-900
                      uppercase
                      rounded-lg
                      dark:text-white
                      focus:outline-none focus:shadow-outline
                    "
                    >Movie App</Link
                  >
                  <HomeModal class="w-40 md:w-72" />
                  <button
                    class="md:hidden rounded-lg focus:outline-none focus:shadow-outline"
                    @click="openMobileMenu = !openMobileMenu"
                  >
                  <i v-show="!openMobileMenu" class="fa-solid fa-bars w-6 h-6"></i>
                
                   
                  </button>
                </div>
                <nav
                  :class="{ flex: openMobileMenu, hidden: !openMobileMenu }"
                  class="
                    flex-col flex-grow
                    pb-4
                    md:pb-0 md:flex md:justify-end md:flex-row
                  "
                >
                  <Link
                    class="
                      bg-transparent
                      px-4
                      py-2
                      mt-2
                      text-sm
                      font-semibold
                      rounded-lg
                      dark:hover:bg-gray-600
                      dark:focus:bg-gray-600
                      dark:focus:text-white
                      dark:hover:text-white
                      dark:text-gray-200
                      md:mt-0 md:ml-4
                      hover:text-gray-900
                      focus:text-gray-900
                      hover:bg-gray-200
                      focus:bg-gray-200 focus:outline-none focus:shadow-outline
                    "
                    href="/movies"
                    >Movies</Link
                  >
                  <Link
                    class="
                      bg-transparent
                      px-4
                      py-2
                      mt-2
                      text-sm
                      font-semibold
                      rounded-lg

                      md:mt-0 md:ml-4
                      hover:text-gray-900
                      focus:text-gray-900
                      hover:bg-gray-200
                      focus:bg-gray-200 focus:outline-none focus:shadow-outline
                    "
                    href="/series"
                    >Tv Shows</Link
                  >
                  <Link
                    class="
                      bg-transparent
                      px-4
                      py-2
                      mt-2
                      text-sm
                      font-semibold
                      rounded-lg
             
                      md:mt-0 md:ml-4
                      hover:text-gray-900
                      focus:text-gray-900
                      hover:bg-gray-200
                      focus:bg-gray-200 focus:outline-none focus:shadow-outline
                    "
                    href="/casts"
                    >Casts</Link
                  >
                    
                 <Dropdown/>
        
                </nav>
              </div>
            </div>



            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>

     <Footer/>
</template>
