<script setup lang="ts">
import { ref } from "vue";

const isDark = ref<boolean>(false);

const toggleTheme = () => {
  isDark.value = !isDark.value;
};
</script>

<template>
  <div
    class="mt-auto p-4 rounded-2xl bg-gray-50 border-gray-300 border shadow-sm"
  >
    <div class="flex items-center gap-3 mb-4">
      <div
        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center"
      >
        👤
      </div>
      <div class="text-cyan-700">
        <p class="text-md font-medium">tiara tiara</p>
        <p class="text-xs">tiara@botika.online</p>
      </div>
    </div>
    <hr class="border-gray-300 my-2" />
    <div
      @click="toggleTheme"
      class="flex items-center justify-between text-sm font-semibold mb-3 cursor-pointer"
    >
      <span>Dark Theme</span>
      <button
        class="relative inline-flex h-5 w-8 items-center rounded-full transition-colors duration-300 focus:outline-none cursor-pointer"
        :class="isDark ? 'bg-black' : 'bg-gray-200'"
      >
        <span class="sr-only">Enable dark mode</span>
        <span
          class="inline-block h-4 w-4 transform rounded-full bg-white shadow-sm transition-transform duration-300"
          :class="isDark ? 'translate-x-3.5' : 'translate-x-0.5'"
        ></span>
      </button>
    </div>
    <hr class="border-gray-300 my-2" />
    <div class="cursor-pointer">
      <button
        class="text-sm font-semibold flex items-center gap-2 cursor-pointer"
      >
        ⎋ Logout
      </button>
    </div>
  </div>
</template>
