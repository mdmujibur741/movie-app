<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Pagination from "../../Components/Pagination.vue";
import {ref, watch} from'vue';
import { router } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";


const props = defineProps({
       casts : Object,
      filters: Object
})


const form = useForm({
    cast_id : ''
})

const submit = ()=>{
           form.post(route('admin.casts.store'),{
             onSuccess: () => form.reset()
           });
}

const search = ref(props.filters.search);
const perPage = ref(props.filters.perPage);

watch(search, value => {
       router.get('/admin/casts', {search: value, perPage: perPage.value},{
          preserveState : true,
          replace :true
       });
})


function getPage(){
  router.get('/admin/casts', {search: search.value, perPage: perPage.value},{
          preserveState : true,
          replace :true
       });
}

</script>
<template>
  <AdminLayout>
    <section class="min-h-[100vh] bg-indigo-100 p-5 rounded-lg drop-shadow-lg relative">
      
      <div v-if="$page.props.flash.message"  class="toast">
       <div class="toast-icon">
        <i class="fa-regular fa-circle-check"></i>
       </div>
       <div class="text-white max-w-xs ">
         {{ $page.props.flash.message }}
       </div>
     </div>

        <div
            class="mt-4 flex justify-center bg-indigo-100 my-5 p-3 rounded-lg drop-shadow-lg"
          >
            <div>
              <h2 class="text-xl font-bold rounded-lg text-black text-center">
             Cast page
              </h2>
            </div>
           
          </div>
     

        <!-- Tag Form  -->
      
          <form @submit.prevent="submit" class=" p-3  flex justify-end items-center  rounded-lg">
          <div class="bg-blue-100 drop-shadow-lg p-2 flex justify-end rounded-lg">
            <div class="">
                <InputLabel for="cast_id" value="Cast Id" class="mb-3"/>
                <TextInput  id="cast_id" v-model="form.cast_id"  class="mt-1 block w-full px-3 py-1" placeholder="Enter Cast Id"/>
                <InputError class="mt-2" :message="form.errors.cast_id" />
              </div>
  
  
              <div class="flex items-center justify-center mt-7">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                 Generate Cast
                </PrimaryButton>
              </div>
          </div>

          </form>
   

      
                  <!-- Tag Table -->
          <div class="w-full overflow-x-auto drop-shadow-xl rounded-xl">
              <div class="flex my-1 justify-between items-center  gap-5 m-1 ">

                <div class="pt-2 relative  text-gray-600">
                  <TextInput v-model="search" class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                    type="search"  placeholder="Search"/>
                  <span type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                  </span>
                </div>


            
              <div class="pt-2">
                <select @change="getPage()" v-model="perPage" class="block w-24 h-9 px-2 m-0 rounded-lg" >
                  <option value="5" > <b>Per 5</b> </option>
                  <option value="10" > <b>Per 10</b> </option>
                  <option value="20"> <b>Per 20</b> </option>
                  <option value="50"> <b>Per 50</b> </option>
                  <option value="100"> <b>Per 100</b> </option>
           </select>
              </div>
              </div>
            <table class="w-full">
              <thead>
                <tr
                  class="text-sm font-semibold tracking-wide text-left text-gray-900 bg-gray-100 capitalize border-b border-gray-600"
                >
                  <th class="px-4 py-2">SL</th>
                  <th class="px-4 py-2">Name</th>
                  <th class="px-4 py-2">Slug</th>
                  <th class="px-4 py-2">Poster</th>
                  <th class="px-4 py-2">Manage</th>
                </tr>
              </thead>
              <tbody class="bg-white">
                <tr v-for="(cast, index) in props.casts.data" :key="cast.index" class="text-gray-700">
                  <td class="px-4 py-2 border"> {{ index+1 }} </td>
                  <td class="px-4 py-2  border"> {{cast.name}} </td>
                  <td class="px-4 py-2  border"> {{cast.slug}} </td>
                  <td class="px-4 py-2  border"> {{cast.poster_path}} </td>

                  <td class="px-4 py-2  border">
                    <div class="flex justify-start gap-3 lg:gap-2">
                      <Link :href="route('admin.casts.edit',cast.slug)" class="btn-edit">
                        <i class="fa-solid fa-pen-to-square"></i >
                        </Link>
                      <Link :href="route('admin.casts.destroy',cast.slug)" as="button" method="delete" class="btn-delete">
                        <i class="fa-solid fa-trash"></i>
                      </Link>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
              <Pagination :links="props.casts.meta.links"/>
          </div>
       
     
    </section>
  </AdminLayout>
</template>
