<script setup lang="ts">
import { ArrowLeftOnRectangleIcon } from "@heroicons/vue/20/solid";
import { MoonIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";
import { logout } from "../../api/utils";
import { useRouter } from "vue-router";

const isDark = ref<boolean>(false);
const router = useRouter();

const toggleTheme = () => {
  isDark.value = !isDark.value;
};

const handleLogout = async () => {
  await logout();
  localStorage.removeItem("token");
  localStorage.removeItem("user");

  router.push("/login");
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
      <div class="flex gap-1">
        <MoonIcon class="w-6 h-6 stroke-[1.5]" />
        <span>Dark Theme</span>
      </div>
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
        @click="handleLogout"
        class="text-sm font-semibold flex items-center gap-2 cursor-pointer"
      >
        <ArrowLeftOnRectangleIcon class="w-6 h-6 stroke-[1.5]" />
        Logout
      </button>
    </div>
  </div>
</template>
