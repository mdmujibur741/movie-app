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


const props = defineProps({
      tags : Object,
      filters: Object
})


const form = useForm({
       tag_name : ''
})

const submit = ()=>{
           form.post(route('admin.tags.store'),{
             onSuccess: () => form.reset()
           });
}

const search = ref(props.filters.search);
const perPage = ref(props.filters.perPage);

watch(search, value => {
       router.get('/admin/tags', {search: value, perPage: perPage.value},{
          preserveState : true,
          replace :true
       });
})


function getPage(){
  router.get('/admin/tags', {search: search.value, perPage: perPage.value},{
          preserveState : true,
          replace :true
       });
}

</script>
<template>
  <AdminLayout>
    <section class="min-h-[100vh] bg-indigo-100 p-5 rounded-lg drop-shadow-lg">
        <div
            class="mt-4 flex justify-center bg-indigo-100 my-5 p-3 rounded-lg drop-shadow-lg"
          >
            <div>
              <h2 class="text-xl font-bold rounded-lg text-black text-center">
                Tag 
              </h2>
            </div>
           
          </div>
      <div class="grid lg:grid-cols-6 gap-4">

        <!-- Tag Form  -->
        <div class="lg:col-span-2">
          <form @submit.prevent="submit" class="bg-indigo-100 p-3 drop-shadow-md  rounded-lg">
            <div >
              <InputLabel for="tag_name" value="Tag Name" class="mb-3"/>
              <TextInput  id="tag_name" v-model="form.tag_name"  class="mt-1 block w-full px-3 py-1"/>
              <InputError class="mt-2" :message="form.errors.tag_name" />
            </div>


            <div class="flex items-center justify-center mt-4">
              <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Add Tag
              </PrimaryButton>
            </div>

          </form>
        </div>

        <div class="lg:col-span-4">
                  <!-- Tag Table -->
          <div class="w-full overflow-x-auto drop-shadow-xl rounded-xl">
              <div class="flex my-1 justify-between  gap-5 m-1 ">

                <div class="pt-2 relative  text-gray-600">
                  <TextInput v-model="search" class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                    type="search"  placeholder="Search"/>
                  <span type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                  </span>
                </div>


            
                <div class="pt-2">
                  <select @change="getPage()" v-model="perPage" class="mt-1 block w-24 h-9 rounded-lg" >
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
                  <th class="px-4 py-2">Manage</th>
                </tr>
              </thead>
              <tbody class="bg-white">
                <tr v-for="(tag, index) in props.tags.data" :key="tag.index" class="text-gray-700">
                  <td class="px-4 py-2 border"> {{ index+1 }} </td>
                  <td class="px-4 py-2  border"> {{tag.tag_name}} </td>
                  <td class="px-4 py-2  border"> {{tag.slug}} </td>

                  <td class="px-4 py-2  border">
                    <div class="flex justify-start gap-3 lg:gap-2">
                      <Link :href="route('admin.tags.edit',tag.slug)" class="btn-edit"
                        ><i class="fa-solid fa-pen-to-square"></i
                      ></Link>
                      <Link href="" class="btn-delete">
                        <i class="fa-solid fa-trash"></i>
                      </Link>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
              <Pagination :links="props.tags.meta.links"/>
          </div>
        </div>
      </div>
    </section>
  </AdminLayout>
</template>
