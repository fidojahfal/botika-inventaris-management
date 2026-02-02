<script setup lang="ts">
import SideBarAccount from "../sidebar/SideBarAccount.vue";
import SideBarLogo from "../sidebar/SideBarLogo.vue";
import SideBarNav from "../sidebar/SideBarNav.vue";
</script>

<template>
  <div class="flex min-h-screen bg-white text-gray-900">
    <aside class="w-[260px] border-r border-gray-200 px-4 py-6 flex flex-col">
      <side-bar-logo />

      <side-bar-nav />

      <side-bar-account />
    </aside>

    <main class="flex-1 px-10 py-8">
      <slot />
    </main>
  </div>
</template>
