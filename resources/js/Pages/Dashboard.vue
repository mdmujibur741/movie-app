<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                      <div class="bg-indigo-50 w-full h-24 p-5 rounded-2xl shadow-xl">
                          <h2 class="text-xl ">
                           Movie()
                          </h2>
                      </div>
                      <div class="bg-indigo-50 w-full h-24 p-5 rounded-2xl shadow-xl">
                        <h2 class="text-xl ">
                         Movie()
                        </h2>
                    </div>
                    <div class="bg-indigo-50 w-full h-24 p-5 rounded-2xl shadow-xl">
                        <h2 class="text-xl ">
                         Movie()
                        </h2>
                    </div>
                    <div class="bg-indigo-50 w-full h-24 p-5 rounded-2xl shadow-xl">
                        <h2 class="text-xl ">
                         Movie()
                        </h2>
                    </div>
                    <div class="bg-indigo-50 w-full h-24 p-5 rounded-2xl shadow-xl">
                        <h2 class="text-xl ">
                         Movie()
                        </h2>
                    </div>
                    <div class="bg-indigo-50 w-full h-24 p-5 rounded-2xl shadow-xl">
                        <h2 class="text-xl ">
                         Movie()
                        </h2>
                    </div>
                 </div>
            </div>
        </div>
    </AdminLayout>
</template>
