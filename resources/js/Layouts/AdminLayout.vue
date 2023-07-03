






<template>
  <Head>
    <link v-if="$page.props.setting" rel="icon" type="image/png"  :href="$page.props.setting.favicon"/> 
  </Head>
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
            <Link :href="route('dashboard')" class="dash-sideNav" :class="{ 'active': $page.url.startsWith('/dashboard') }" >
               <i class="fa-solid fa-gauge text-xl"></i>
               <span class="ml-3">Dashboard</span>
            </Link>
<Link :href="route('admin.movies.index')" class="dash-sideNav" :class="{ 'active': $page.url.startsWith('/admin/movies') }">
               <i class="fa-solid fa-film text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap" >Movies</span>

            </Link>
<Link :href="route('admin.tv-shows.index')" class="dash-sideNav" :class="{ 'active': $page.url.startsWith('/admin/tv-shows') }">
               <i class="fa-solid fa-file-video text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Tv shows</span>
            
            </Link>
<Link :href="route('admin.genres.index')" class="dash-sideNav" :class="{ 'active': $page.url.startsWith('/admin/genres') }">
               <i class="fa-solid fa-atom text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Genres</span>
            </Link>
<Link :href="route('admin.casts.index')" class="dash-sideNav" :class="{ 'active': $page.url.startsWith('/admin/casts') }">
               <i class="fa-regular fa-chess-rook text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Cast</span>
            </Link>
<Link :href="route('admin.tags.index')" class="dash-sideNav" :class="{ 'active': $page.url.startsWith('/admin/tags') }">
               <i class="fa-solid fa-hashtag text-xl"></i>
               <span class="flex-1 ml-3 whitespace-nowrap">Tags</span>
            </Link>
           
            <Link :href="route('admin.setting.create')" :class="{ 'active': $page.url.startsWith('/setting') }" class="dash-sideNav">
            
              <i class="fa-solid fa-gear text-xl"></i>
              <span class="flex-1 ml-3 whitespace-nowrap">Setting</span>
           </Link>
 
           </div>
      
         </div>
       </div>
     </div>
     <div class="w-full h-full ">
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
  
           </div>
           <!-- User login -->
           <div class="w-[200px] ">
             <div class="flex items-center justify-start space-x-4" @click="toggleDrop">
               <img class="w-10 h-10 rounded-full border-2 border-gray-50" src="https://yt3.ggpht.com/hqsxh-Vnbw9OK0_X4DAWh6RkmEUVnL-82SRCyh-IKr9fIXR8zhUCRdBEwgWWL_14q_L8Piod=s108-c-k-c0x00ffffff-no-rj" alt="">
               <div class="font-semibold dark:text-white text-left">
                 <div class="capitalize"> {{ $page.props.user.name }} </div>
                 <div class="text-xs text-gray-500 dark:text-gray-400">Admin</div>
               </div>
             </div>
             <!-- Drop down -->
             <div v-show="showDropDown" class="absolute right-[10px] z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
               <div class="py-1 text-left" role="none">
                 <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                 <Link :href="route('logout')" method="post" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Logout</Link>
                
              
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
  import { Head, router } from '@inertiajs/vue3';
 export default {
   data() {
     return {
       showDropDown: false,
       showSide: true
     }
   },
   components:{
      Link,
      Head
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
 
