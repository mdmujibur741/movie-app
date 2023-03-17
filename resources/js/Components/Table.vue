<script setup></script>


<template>
    <table class="w-full">
        <thead>
          <tr
            class="text-sm font-semibold tracking-wide text-left text-gray-900 bg-gray-100 capitalize border-b border-gray-600"
          >
          
       
            <slot name="TableHead"> </slot>
            
          </tr>
        </thead>
        <tbody class="bg-white">
            <slot />
          <tr  class="text-gray-700">
          
       
         
            
          </tr>
        </tbody>
      </table>
</template>