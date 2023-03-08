<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 active:bg-lime-900 focus:outline-none focus:border-gray-100 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
