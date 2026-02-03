<script setup lang="ts">
import {
  EllipsisHorizontalIcon,
  ChevronDownIcon,
} from "@heroicons/vue/24/outline";
import { computed, ref, Teleport, watch } from "vue";
import type { Inventaris } from "../../types/inventaris";

const dropdownPosition = ref({ top: 0, left: 0 });
const activeDropdownId = ref<string>("");

const toggleDropdown = (id: string, event: MouseEvent) => {
  if (activeDropdownId.value === id) {
    activeDropdownId.value = "";
  } else {
    activeDropdownId.value = id;

    const target = (event.target as HTMLElement).closest("button");
    if (target) {
      const rect = target.getBoundingClientRect();
      dropdownPosition.value = {
        top: rect.bottom + 8,
        left: rect.right - 130,
      };
    }
  }
};

const closeDropdown = () => {
  activeDropdownId.value = "";
};

const colorPill = {
  1: "bg-teal-200 text-teal-600",
  2: "bg-red-200 text-red-600",
  3: "bg-orange-200 text-orange-600",
  4: "bg-gray-200 text-gray-600",
};

const currentPage = ref(1);
const itemsPerPage = ref(5);

const props = defineProps<{
  inventaris: Inventaris[];
  query: string;
}>();

const emit = defineEmits<{
  (e: "edit", inventaris: Inventaris): void;
  (e: "delete", inventaris: Inventaris): void;
}>();

const paginatedInventaris = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return props.inventaris.slice(start, end);
});

const totalPages = computed(() => {
  return Math.ceil(props.inventaris.length / itemsPerPage.value);
});

watch([props.query, itemsPerPage], () => {
  currentPage.value = 1;
});

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};

const goToPage = (page: number) => {
  currentPage.value = page;
};
</script>

<template>
  <div
    class="w-full bg-white p-6 rounded-2xl border-gray-100"
    @click="closeDropdown"
  >
    <div class="overflow-x-auto min-h-100">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="text-center">
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100"
            >
              No
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100"
            >
              InventarisID
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100"
            >
              Barang
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100"
            >
              Type
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100 text-center"
            >
              Serial Number
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100 text-center"
            >
              Spesifikasi
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100 text-center"
            >
              Status
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100 text-center"
            >
              Assign
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100 text-center"
            >
              Department
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100 text-center"
            >
              Action
            </th>
          </tr>
        </thead>

        <tbody class="text-sm">
          <tr
            v-for="(inv, index) in paginatedInventaris"
            :key="inv.id"
            class="group hover:bg-gray-50 transition-colors text-center"
          >
            <td class="py-5 font-medium text-gray-900 border-b border-gray-100">
              {{ index + 1 + itemsPerPage * (currentPage - 1) }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ inv.id }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ inv.name }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ inv.type }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ inv.serial_number }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ inv.spesifikasi }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              <span
                class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium inset-ring"
                :class="colorPill[inv.status.id]"
                >{{ inv.status.name }}</span
              >
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              <span
                class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium inset-ring bg-cyan-100 text-blue-600"
                >{{
                  inv.assigned_user == null ? "-" : inv.assigned_user.name
                }}</span
              >
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ inv.department == null ? "-" : inv.department.name }}
            </td>

            <td class="py-5 border-b border-gray-100 text-center">
              <button
                @click.stop="toggleDropdown(inv.id, $event)"
                class="inline-flex items-center justify-center w-8 h-8 text-gray-500 border rounded-xl hover:bg-gray-100 hover:text-gray-900 transition-all cursor-pointer"
                :class="
                  activeDropdownId === inv.id ? 'bg-gray-100 text-gray-900' : ''
                "
              >
                <EllipsisHorizontalIcon class="w-7 h-7 font-bold" />
              </button>
              <Teleport to="body"
                ><div
                  v-if="activeDropdownId === inv.id"
                  @click.stop
                  class="absolute right-0 top-full mt-3 w-32 bg-black rounded-xl shadow-xl z-50 flex flex-col py-1 animate-fade-in-down origin-top-right mr-4 md:mr-0"
                  :style="{
                    top: dropdownPosition.top + 'px',
                    left: dropdownPosition.left + 'px',
                  }"
                >
                  <div
                    class="absolute -top-1 right-3 w-3 h-3 bg-black transform rotate-45"
                  ></div>

                  <button
                    @click="
                      () => {
                        emit('edit', inv);
                        closeDropdown();
                      }
                    "
                    class="flex items-center gap-2 px-4 py-2.5 text-left text-white text-sm hover:bg-gray-800 transition-colors first:rounded-t-xl cursor-pointer"
                  >
                    <PencilSquareIcon class="w-4 h-4" />
                    <span>Edit</span>
                  </button>

                  <button
                    @click="
                      () => {
                        emit('delete', inv);
                        closeDropdown();
                      }
                    "
                    class="flex items-center gap-2 px-4 py-2.5 text-left text-white text-sm hover:bg-gray-800 transition-colors last:rounded-b-xl cursor-pointer"
                  >
                    <TrashIcon class="w-4 h-4" />
                    <span>Delete</span>
                  </button>
                </div></Teleport
              >
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <p
      v-if="props.inventaris.length === 0"
      class="text-center text-gray-500 pt-7"
    >
      No data.
    </p>

    <div
      v-if="props.inventaris.length > 0"
      class="flex flex-col md:flex-row items-center justify-between mt-8 text-sm text-gray-600"
    >
      <div class="flex items-center gap-2 mb-4 md:mb-0">
        <span>Showing</span>
        <div class="relative">
          <select
            v-model="itemsPerPage"
            class="appearance-none pl-3 pr-8 py-1.5 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer text-gray-900 font-medium"
          >
            <option :value="5">5</option>
            <option :value="10">10</option>
            <option :value="20">20</option>
          </select>
          <ChevronDownIcon
            class="w-4 h-4 text-gray-500 absolute right-2 top-2.5 pointer-events-none"
          />
        </div>
        <span>items per page</span>
      </div>

      <div class="flex items-center gap-1">
        <button
          @click="prevPage"
          :disabled="currentPage === 1"
          class="px-3 py-1 font-medium hover:text-gray-900 cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed"
        >
          Previous
        </button>

        <button
          v-for="page in totalPages"
          :key="page"
          @click="goToPage(page)"
          class="w-8 h-8 flex items-center justify-center rounded-lg transition-colors cursor-pointer"
          :class="
            currentPage === page
              ? 'border border-gray-300 font-bold text-gray-900 bg-white'
              : 'hover:bg-gray-100 text-gray-600'
          "
        >
          {{ page }}
        </button>

        <button
          @click="nextPage"
          :disabled="currentPage === totalPages"
          class="px-3 py-1 font-medium hover:text-gray-900 cursor-pointer disabled:opacity-30 disabled:cursor-not-allowed"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>
