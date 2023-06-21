 <script setup>
     import { Link,Head, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import Pagination from "@/Components/Pagination.vue";
import AdminLayout from '../../../Layouts/AdminLayout.vue';

import { router } from '@inertiajs/vue3';

const props = defineProps({
    season : Object,
    tvShow : String
})


const form = useForm(props.season)

const submit = ()=>{
     form.put(route('admin.seasons.update',[ props.tvShow, props.season.slug]))
}
</script>


<template>
    <AdminLayout>
    <section class="bg-slate-50 min-h-[100vh] max-w-7xl">
       
   
     
         <!-- form -->
      <form @submit.prevent="submit"  class="lg:w-6/12 w-full mx-auto p-6 drop-shadow-lg bg-gray-100 rounded-lg">
            <h3 class="text-2xl font-bold capitalize p-1 mb-5 text-center">Season Edit</h3>
<div>
<InputLabel class="font-bold text-slate-900" for="name" value="Name" />
<TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"  placeholder="Enter Name"/>
<InputError class="mt-2" :message="form.errors.name" />
</div>         


<div class="mt-4">
<InputLabel class="font-bold text-slate-900" for="priority" value="Poster_path" />
<TextInput id="poster_path" v-model="form.poster_path" type="text"  class="mt-1 block w-full" placeholder="Enter Poster_path"/>
<InputError class="mt-2" :message="form.errors.poster_path" />
</div>




<div class="mt-4 flex justify-center">      
<PrimaryButton class="btn-indigo font-bold hover:bg-indigo-800" :class="{ 'opacity-80': form.processing }" :disabled="form.processing">
    Update Season
</PrimaryButton>

</div>

      
</form> 

      

</section>
</AdminLayout>
</template> 

