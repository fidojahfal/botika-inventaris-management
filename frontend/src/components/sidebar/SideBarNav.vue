<script setup lang="ts">
import {
  ChartPieIcon,
  ClipboardDocumentListIcon,
  UsersIcon,
} from "@heroicons/vue/24/outline";
import { RouterLink } from "vue-router";

const menuItems = [
  {
    name: "Data Inventaris",
    path: "/inventaris",
    icon: ClipboardDocumentListIcon,
  },
  { name: "Management Anggota", path: "/users", icon: UsersIcon },
  { name: "Analytics", path: "/analytics", icon: ChartPieIcon },
];
</script>

<template>
  <nav class="flex-1 space-y-2">
    <router-link
      v-for="item in menuItems"
      :key="item.name"
      :to="item.path"
      v-slot="{ isActive }"
      custom
    >
      <a
        :href="item.path"
        class="flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group cursor-pointer"
        :class="isActive ? 'bg-gray-100' : 'hover:bg-gray-50 bg-transparent'"
      >
        <div class="flex gap-3">
          <component
            :is="item.icon"
            class="w-6 h-6 stroke-[1.5]"
            :class="
              isActive
                ? 'text-gray-950 font-bold'
                : 'text-gray-800 font-medium group-hover:text-gray-900'
            "
          />
          <span
            class="text-sm"
            :class="
              isActive
                ? 'text-gray-950 font-bold'
                : 'text-gray-800 font-medium group-hover:text-gray-900'
            "
            >{{ item.name }}</span
          >
        </div>

        <div v-if="isActive" class="w-1 h-2.5 bg-black rounded-full"></div>
      </a>
    </router-link>
  </nav>
</template>
