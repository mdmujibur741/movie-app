<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Pagination from "@/Components/Pagination.vue";
import {ref, watch} from'vue';
import { router } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';


const props = defineProps({  
      movie :Object,
      trillers : Object,
      casts : Array,
      movieCast : Array,
      tags : Array,
      movieTag : Array
})

const form = useForm({
  name : '',
  embed_html : ''
})

const submitTriller = ()=>{
           form.post(route('admin.movies.addTriller', [props.movie.id]),{
             onSuccess: () => form.reset()
           });
}

const castForm = useForm({
       cast : []
});

const castSubmit = ()=> {
  castForm.post(route('admin.movies.addCast', [props.movie.id]));
}

const tagForm = useForm({
       tag : []
});


const tagSubmit = ()=> {
     tagForm.post(route('admin.movies.addTag',[props.movie.id]));
};

const categories = ref([
  'Triller',"Cast","Tag",
   ])

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

            <TabGroup>

                 <TabList class="flex space-x-1 rounded-xl bg-blue-900 p-1">
                  <Tab
                  v-for="(category,index) in categories"
                  as="template"
                  :key="index"
                  v-slot="{ selected }"
                >
                  <button
                    :class="[
                      'w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700 uppercase',
                      'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-800 focus:outline-none focus:ring-2',
                      selected
                        ? 'bg-white shadow'
                        : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',
                    ]"
                  >
                    {{ category }}
                  </button>
                </Tab>
                 </TabList>


<TabPanels>
  <TabPanel >

                    <div
                          class="mt-14 flex items-center justify-center bg-indigo-100 my-5 p-3 rounded-lg "
                        > 
                      
                                  <form @submit.prevent="submitTriller" class="  w-full items-center  rounded-lg">
                        <div class="bg-blue-100 drop-shadow-lg p-6 rounded-lg w-8/12 mx-auto">
                          
                          <h2 class="text-xl font-bold rounded-lg text-black text-center">
                            Trailer Form
                                </h2>
                              <div class="flex flex-wrap">
                                  <Link v-for="(triler, key) in trillers" :key="key" :href="route('admin.triler.destroy', triler.id )" method="delete"  class="bg-gray-300 rounded-lg mx-1 " > {{  triler.name}} </Link>
                              </div>
                          <div class=" mb-3">
                              <InputLabel for="name" value="Name" class="mb-3"/>
                              <TextInput  id="name" v-model="form.name"  class="mt-1 block w-full px-3 py-1" placeholder="Enter name"/>
                              <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                
                            <div class=" mb-3">
                              <InputLabel for="embed" value="Embed Triller" class="mb-3"/>
                              <textarea v-model="form.embed_html" id="embed"  rows="2" class="mt-1 block w-full px-3 py-1 rounded-md " ></textarea>
                              <InputError class="mt-2" :message="form.errors.embed_html" />
                            </div>

                            <div class="flex items-center justify-center mt-7">
                              <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Add Triller
                              </PrimaryButton>
                            </div>
                        </div>

                        </form>  
                    
                        
                        </div>  
     
                      </TabPanel>

                      <TabPanel> 
                    <!-- cast Form  -->
                <div class="w-full mt-14">
                  
                      
                    <form @submit.prevent="castSubmit" class=" p-3  flex justify-center items-center  rounded-lg">
                      <div class="bg-blue-100 drop-shadow-lg p-6 rounded-lg w-8/12">
                        <h2 class="text-xl font-bold rounded-lg text-black text-center">
                          Cast Form
                              </h2>
                            
                         
                        <div class="my-2">
                          <div class=" gap-x-4 ">
                            <span class="bg-green-600 p-1 text-xs rounded-md text-white" v-for="cast in movieCast" :key="cast.id">
                                    {{ cast.name }}
                            </span>
                    </div>
                          <div  class=" gap-5 my-6">
                            <label v-for="(cast,index) in props.casts" :key="cast.id" class="flex items-center">
                                <input type="checkbox"  class="checkbox" v-model="castForm.cast" :value="cast.id" :id="cast.id"/> 
                                <span class="ml-2 text-sm text-gray-600" :for="cast.id"> {{ cast.name }} </span>
                            </label>
                        </div>
                        

                      
                            <InputError class="mt-2" :message="castForm.errors.cast" />
                          </div>
              
                            
                          <div class="flex items-center justify-center mt-7">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': castForm.processing }" :disabled="castForm.processing">
                              Add Cast
                            </PrimaryButton>
                          </div>
                            
                      </div>
                                  
                      </form> 
                    
                  </div> 
              
                </TabPanel>
      
                <TabPanel> 
                  <!-- Tag Table -->
                  <div class="w-full mt-14">
 
                       
                    <form @submit.prevent="tagSubmit" class=" p-3  flex justify-center items-center  rounded-lg">
                      <div class="bg-blue-100 drop-shadow-lg p-4 rounded-lg w-8/12">
                        <h2 class="text-xl font-bold rounded-lg mt-4 mb-5 text-black text-center">
                          Tag Form
                               </h2>
                         <div class="flex gap-x-4 ">
                                <span class="bg-green-600 p-1 text-xs rounded-md text-white" v-for="tag in movieTag" :key="tag.id">
                                        {{ tag.tag_name }}
                                </span>
                         </div>
                        <div class="my-2">
                        
                          <div  class="flex gap-5 my-6">
                            <label v-for="(tg,index) in props.tags" :key="tg.id" class="flex items-center">
                                <input type="checkbox"  class="checkbox" v-model="tagForm.tag" :value="tg.id" :id="tg.id"/> 
                                <span class="ml-2 text-sm text-gray-600" :for="tg.id"> {{ tg.tag_name }} </span>
                            </label>
                        </div>
                         
            
                       
                            <InputError class="mt-2" :message="tagForm.errors.tag" />
                          </div>
              
                            
                          <div class="flex items-center justify-center mt-7">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': tagForm.processing }" :disabled="tagForm.processing">
                               Add Tag
                            </PrimaryButton>
                          </div>
                      </div>
                                    
                      </form> 
                      {{ tagForm.tags }}  
                  </div>
                </TabPanel>
                </TabPanels>
           </TabGroup>
    </section>
  </AdminLayout>
</template>

<style scoped>
     table img{
              width: 90px;
     }
</style>

