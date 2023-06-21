 <script setup>
     import { Link,Head, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import Pagination from "@/Components/Pagination.vue";
import AdminLayout from '../../../../Layouts/AdminLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';

import { router } from '@inertiajs/vue3';

const props = defineProps({
    tvShow : Object,
    season : Object,
    episode : Object
    


});


 const form = useForm({
      name : props.episode.name,
      overview : props.episode.overview,
      is_public : props.episode.is_public ? true : false,
    });

const submit = ()=>{
      form.put(route('admin.episodes.update',[ props.tvShow.id, props.season.id, props.episode.id]))
}
</script>


<template>
    <AdminLayout>
    <section class="bg-slate-50 min-h-[100vh] max-w-7xl">
       
    <h2>Episode Edit</h2> 
     
         <!-- form -->
 <form @submit.prevent="submit"  class="lg:w-6/12 w-full mx-auto p-6 drop-shadow-lg bg-gray-100 rounded-lg"> 
            <h3 class="text-2xl font-bold capitalize p-1 mb-5 text-center">Episode Edit</h3>
<div>
 <InputLabel class="font-bold text-slate-900" for="name" value="Name" />
<TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"  placeholder="Enter Name"/>
<InputError class="mt-2" :message="form.errors.name" />
</div>          



<div>
    <InputLabel class="font-bold text-slate-900" for="overview" value="Overview" />
   <TextInput id="overview" v-model="form.overview"  type="text" class="mt-1 block w-full "  placeholder="Enter Overview"/>
   <InputError class="mt-2" :message="form.errors.overview" />
   </div> 





   <div class="block mt-4">
    <label class="flex items-center">
        <Checkbox v-model:checked="form.is_public" name="is_public" />
        <span class="ml-2 text-sm text-gray-600"> Public </span>
    </label>
</div>


<div class="mt-4 flex justify-center">      
<PrimaryButton class="btn-indigo font-bold hover:bg-indigo-800" :class="{ 'opacity-80': form.processing }" :disabled="form.processing">
    Update Episode
</PrimaryButton>

</div>

      
</form>  

      

</section>
</AdminLayout>
</template> 

