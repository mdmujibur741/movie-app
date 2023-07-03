<script setup>
  import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import {ref, watch} from'vue';
import { router } from "@inertiajs/vue3";


const props = defineProps({
      setting : Array,
})


const form = useForm({
         name : '',
     	logo : '',
     	favicon : '',
     	facebook : '',
     	github : '',
     
})

const SettingSubmit = ()=>{
        
           form.post(route('admin.setting.store'),{
             onSuccess: () => form.reset()
           });
}




const eform = useForm({
         name : props.setting?.name,
     	logo : '',
     	favicon : '',
     	facebook : props.setting?.facebook,
     	github : props.setting?.github,
     
})


const SettingUpdate = ()=>{
        

  router.post(`/admin/setting/${props.setting.id}`,{
        _method: 'put',
        name : eform.name,
     	logo : eform.logo,
     	favicon : eform.favicon,
     	facebook : props.setting?.facebook,
     	github : props.setting?.github,
  })

}
</script>


<template>
  <AdminLayout>
        <section class="min-h-[80vh] bg-indigo-300 p-5">
                 
           <div v-if="setting == null">
            <form @submit.prevent="SettingSubmit" class="bg-indigo-100 p-3 drop-shadow-md  rounded-lg w-full lg:w-4/12 mx-auto">
               
                <h3 class="text-2xl font-extrabold text-blue-800 text-center">Setting Add</h3> 
                <div >
                    <InputLabel for="name" value="App Name" class="mb-3"/>
                    <TextInput  id="name" v-model="form.name"  class="mt-1 block w-full px-3 py-1"/>
                    <InputError class="mt-2" :message="form.errors.name" />
                  </div>
  
                  <div >
                      <InputLabel for="facebook" value="Facebook" class="mb-3"/>
                      <TextInput  id="name" v-model="form.facebook"  class="mt-1 block w-full px-3 py-1"/>
                      <InputError class="mt-2" :message="form.errors.facebook" />
                    </div>
  
                    <div >
                      <InputLabel for="github" value="Github" class="mb-3"/>
                      <TextInput  id="name" v-model="form.github"  class="mt-1 block w-full px-3 py-1"/>
                      <InputError class="mt-2" :message="form.errors.github" />
                    </div>
    
  
                    <div >
                      <InputLabel for="logo" value="Logo" class="mb-3"/>
                      <input type="file"  @input="form.logo = $event.target.files[0]" class="file_up mt-1" />
                      <InputError class="mt-2" :message="form.errors.logo" />
                    </div>
      
                    <div >
                      <InputLabel for="favicon" value="Favicon" class="mb-3"/>
                      <input type="file" @input="form.favicon = $event.target.files[0]" class="file_up mt-1" />
                      <InputError class="mt-2" :message="form.errors.favicon" />
                    </div>
            
      
                  <div class="flex items-center justify-center mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                     Add Setting
                    </PrimaryButton>
                  </div>
      
                </form>
           </div>

           <div v-else>
            <form @submit.prevent="SettingUpdate" method="post" enctype="multipart/form-data" class="bg-indigo-100 p-3 drop-shadow-md  rounded-lg w-full md:w-6/12 mx-auto">
                <h3 class="text-2xl font-extrabold text-blue-800 text-center">Setting Edit</h3> 
                <div >
                    <InputLabel for="name" value="App Name" class="mb-3"/>
                    <TextInput  id="name" v-model="eform.name"  class="mt-1 block w-full px-3 py-1"/>
                    <InputError class="mt-2" :message="eform.errors.name" />
                  </div>
  
                  <div >
                      <InputLabel for="facebook" value="Facebook" class="mb-3"/>
                      <TextInput  id="name" v-model="eform.facebook"  class="mt-1 block w-full px-3 py-1"/>
                      <InputError class="mt-2" :message="eform.errors.facebook" />
                    </div>
  
                    <div >
                      <InputLabel for="github" value="Github" class="mb-3"/>
                      <TextInput  id="name" v-model="eform.github"  class="mt-1 block w-full px-3 py-1"/>
                      <InputError class="mt-2" :message="eform.errors.github" />
                    </div>
    
  
                    <div >
                      <InputLabel for="logo" value="Logo" class="mb-3"/>
                      <input type="file" @input="eform.logo = $event.target.files[0]" class="file_up mt-1" />
                      <InputError class="mt-2" :message="eform.errors.logo" />
                    </div>
      
                    <div >
                      <InputLabel for="favicon" value="Favicon" class="mb-3"/>
                      <input type="file" @input="eform.favicon = $event.target.files[0]" class="file_up mt-1" />
                      <InputError class="mt-2" :message="eform.errors.favicon" />
                    </div>
            
      
                  <div class="flex items-center justify-center mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': eform.processing }" :disabled="eform.processing">
                     Update Setting
                    </PrimaryButton>
                  </div>
      
                </form>
 
                <div class="flex justify-center gap-3 my-12">
                     <img :src="props.setting?.logo" alt="" class="w-28" >
                     <img :src="props.setting?.favicon" alt="" class="w-28" >
                </div>

           </div>
        </section>
  </AdminLayout>

</template>