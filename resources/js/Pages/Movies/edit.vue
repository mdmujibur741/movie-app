 <script setup>
     import { Link,Head, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import Pagination from "@/Components/Pagination.vue";
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';

import { router } from '@inertiajs/vue3';

const props = defineProps({
    movie : Object
})


const form = useForm({
           title : props.movie.title,
           release_date : props.movie.release_date,
           poster_path : props.movie.poster_path,
           is_public : props.movie.is_public ? true : false

});

const submit = ()=>{
      form.put(route('admin.movies.update', props.movie.id))
}
</script> 


<template>
    <AdminLayout>
    <section class="bg-slate-50 min-h-[100vh] max-w-7xl">
       
   
            <h2 class="text-center bg-blue-600 text-xl uppercase  rounded-md p-3 mb-3 text-white">{{props.movie.title}}</h2>
         <!-- form -->
        <form @submit.prevent="submit"  class="lg:w-6/12 w-full mx-auto p-6 drop-shadow-lg bg-gray-100 rounded-lg">
            <h3 class="text-2xl font-bold capitalize p-1 mb-5 text-center">Movie Edit</h3>
<div>
<InputLabel class="font-bold text-slate-900" for="title" value="Title" />
<TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full"  placeholder="Enter Title"/>
<InputError class="mt-2" :message="form.errors.title" />
</div>         

<div class="mt-4">
    <InputLabel class="font-bold text-slate-900" for="release_date" value="Release Year" />
    <TextInput id="release_date" v-model="form.release_date" type="text"  class="mt-1 block w-full" placeholder="Enter Release Date"/>
    <InputError class="mt-2" :message="form.errors.release_date" />
    </div>

<div class="mt-4">
<InputLabel class="font-bold text-slate-900" for="priority" value="Poster_path" />
<TextInput id="poster_path" v-model="form.poster_path" type="text"  class="mt-1 block w-full" placeholder="Enter Poster_path"/>
<InputError class="mt-2" :message="form.errors.poster_path" />
</div>


<div class="block mt-4">
    <label class="flex items-center">
        <Checkbox v-model:checked="form.is_public" name="is_public" />
        <span class="ml-2 text-sm text-gray-600"> Public </span>
    </label>
</div>


<div class="mt-4 flex justify-center">      
<PrimaryButton class="btn-indigo font-bold hover:bg-indigo-800" :class="{ 'opacity-80': form.processing }" :disabled="form.processing">
    Update Tv show
</PrimaryButton>

</div>

      
</form> 

      

</section>
</AdminLayout>
</template>