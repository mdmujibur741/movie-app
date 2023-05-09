<!-- <script setup>
         import {Link} from '@inertiajs/vue3';
</script>


<template>
    <nav class="fixed top-0 z-50 w-full bg-sky-100 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
          <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
              <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                  <span class="sr-only">Open sidebar</span>
                  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                  </svg>
               </button>
              <a href="https://flowbite.com" class="flex ml-2 md:mr-24">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Flowbite</span>
              </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                  <div>
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                      <span class="sr-only">Open user menu</span>
                      <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                    </button>
                  </div>
                  <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                    <div class="px-4 py-3" role="none">
                      <p class="text-sm text-gray-900 dark:text-white" role="none">
                        Neil Sims
                      </p>
                      <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                        neil.sims@flowbite.com
                      </p>
                    </div>
                    <ul class="py-1" role="none">
                      <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </nav>
      
      <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-indigo-200 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 drop-shadow-xl" aria-label="Sidebar">
         <div class="h-full px-3 pb-4 overflow-y-auto bg-indigo-200 dark:bg-gray-800">
            <ul class="space-y-2">
               <li>
                  <Link :href="route('admin.index')" class="dash-sideNav">
                     <i class="fa-solid fa-gauge text-xl"></i>
                     <span class="ml-3">Dashboard</span>
                  </Link>
               </li>
               <li>
                  <Link :href="route('admin.movies.index')" class="dash-sideNav">
                     <i class="fa-solid fa-film text-xl"></i>
                     <span class="flex-1 ml-3 whitespace-nowrap">Movies</span>

                  </Link>
               </li>
               <li>
                  <Link :href="route('admin.tv-shows.index')" class="dash-sideNav">
                     <i class="fa-solid fa-file-video text-xl"></i>
                     <span class="flex-1 ml-3 whitespace-nowrap">Tv shows</span>
                  
                  </Link>
               </li>
               <li>
                  <Link :href="route('admin.genres.index')" class="dash-sideNav">
                     <i class="fa-solid fa-atom text-xl"></i>
                     <span class="flex-1 ml-3 whitespace-nowrap">Genres</span>
                  </Link>
               </li>
               <li>
                  <Link :href="route('admin.casts.index')" class="dash-sideNav">
                     <i class="fa-regular fa-chess-rook text-xl"></i>
                     <span class="flex-1 ml-3 whitespace-nowrap">Cast</span>
                  </Link>
               </li>
               <li>
                  <Link :href="route('admin.tags.index')" class="dash-sideNav">
                     <i class="fa-solid fa-hashtag text-xl"></i>
                     <span class="flex-1 ml-3 whitespace-nowrap">Tags</span>
                  </Link>
               </li>
            
            </ul>
         </div>
      </aside>
      
      <div class="p-2 sm:ml-64 mt-16">
         <slot />
      </div>
      
</template>

<style scoped>
      span, i{
               font-weight: 800;
      }
</style> -->


<template>
   <div class=" h-screen flex">
     <!-- Side bar -->
     <div class="w-[350px] h-full bg-indigo-900 text-black" v-show="showSide">
       <div class="h-[50px] bg-sky-100 flex justify-start  items-center ">
         <div class="px-[20px]">
           <h3 class="font-bold text-xl">Admin Dashboard</h3>
         </div>
       </div>
       <div class="h-[calc(100vh-50px)] bg-sky-100 py-[20px]">
         <div class="flex flex-col justify-between h-full px-[20px] space-y-[10px]">
           <div class=" flex flex-col justify-between space-y-[10px]">
            <Link :href="route('admin.index')" class="dash-sideNav">
               <i class="fa-solid fa-gauge text-xl"></i>
               <span class="ml-3">Dashboard</span>
            </Link>
<Link :href="route('admin.movies.index')" class="dash-sideNav">
               <i class="fa-solid fa-film text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Movies</span>

            </Link>
<Link :href="route('admin.tv-shows.index')" class="dash-sideNav">
               <i class="fa-solid fa-file-video text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Tv shows</span>
            
            </Link>
<Link :href="route('admin.genres.index')" class="dash-sideNav">
               <i class="fa-solid fa-atom text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Genres</span>
            </Link>
<Link :href="route('admin.casts.index')" class="dash-sideNav">
               <i class="fa-regular fa-chess-rook text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Cast</span>
            </Link>
<Link :href="route('admin.tags.index')" class="dash-sideNav">
               <i class="fa-solid fa-hashtag text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Tags</span>
            </Link>
           
 
           </div>
           <div class="h-[50px]">
             <div>
               <router-link to="/setting" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300 hover:text-gray-800  transition duration-400 ease-in-out">
                 <svg aria-hidden="true" class="mr-2 w-[25px] h-[25px] fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                 </svg>
                 Setting
               </router-link>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="w-full h-full bg-gray-400">
       <div class="h-[50px] bg-gray-100 flex items-center shadow-sm px-[20px] w-full py-[10px] z-10 border-b ">
         <!-- Hambuger menu -->
         <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" w-[25px] h-[25px]">
             <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
             <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
           </svg>
         </div>
         <!-- Search bar -->
 
         <div class="w-[calc(100%-30px)] flex">
           <div class="w-[calc(100%-200px)] flex justify-center ">
             <!-- Search bar -->
             <form class="flex items-center w-[500px]">
               <label for="voice-search" class="sr-only">Search</label>
               <div class="relative w-full">
                 <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                   <svg aria-hidden="true" class="w-5 h-auto text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                   </svg>
                 </div>
                 <input type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." required>
                 <router-link to="/" class="flex absolute inset-y-0 right-0 items-center pr-3">
                   <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd"></path>
                   </svg>
                 </router-link>
               </div>
             </form>
           </div>
           <!-- User login -->
           <div class="w-[200px] ">
             <div class="flex items-center justify-start space-x-4" @click="toggleDrop">
               <img class="w-10 h-10 rounded-full border-2 border-gray-50" src="https://yt3.ggpht.com/hqsxh-Vnbw9OK0_X4DAWh6RkmEUVnL-82SRCyh-IKr9fIXR8zhUCRdBEwgWWL_14q_L8Piod=s108-c-k-c0x00ffffff-no-rj" alt="">
               <div class="font-semibold dark:text-white text-left">
                 <div>Madona ,Dev OP</div>
                 <div class="text-xs text-gray-500 dark:text-gray-400">Admin</div>
               </div>
             </div>
             <!-- Drop down -->
             <div v-show="showDropDown" class="absolute right-[10px] z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
               <div class="py-1 text-left" role="none">
                 <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                 <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                 <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
                 <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                 <form method="POST" action="#" role="none">
                   <button type="submit" class="text-gray-700 block w-full px-4 py-2 text-left text-sm" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
                 </form>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="bg-gray-50 p-[20px]">
         <div class="  rounded-md p-[20px] h-full">
            <slot />
         </div>
       </div>
     </div>
     <!-- Main  -->
   </div>
 </template>
 <script>
  import {Link} from '@inertiajs/vue3';
 export default {
   data() {
     return {
       showDropDown: false,
       showSide: true
     }
   },
   components:{
      Link
   },
   methods: {
     // hide show side bar
     toggleSideBar() {
       this.showSide = !this.showSide
 
     },
     // toggle user 
     toggleDrop() {
       this.showDropDown = !this.showDropDown
 
     }
   }
 
 }
 </script>
 
