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
      tag : Object,
})


const form = useForm(props.tag)

const submit = ()=>{
           form.put(route('admin.tags.update', props.tag.slug),{
             onSuccess: () => form.reset()
           });
}

</script>


<template>
  <AdminLayout>
        <section class="min-h-[80vh] bg-indigo-300 p-5">
                 
            <form @submit.prevent="submit" class="bg-indigo-100 p-3 drop-shadow-md  rounded-lg w-full lg:w-4/12 mx-auto">
              <h3 class="text-2xl font-extrabold text-blue-800 text-center">Tag Edit</h3> 
              <div >
                  <InputLabel for="tag_name" value="Tag Name" class="mb-3"/>
                  <TextInput  id="tag_name" v-model="form.tag_name"  class="mt-1 block w-full px-3 py-1"/>
                  <InputError class="mt-2" :message="form.errors.tag_name" />
                </div>
    
    
                <div class="flex items-center justify-center mt-4">
                  <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Edit Tag
                  </PrimaryButton>
                </div>
    
              </form>
        </section>
  </AdminLayout>

</template>