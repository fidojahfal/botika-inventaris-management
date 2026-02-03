<script setup lang="ts">
import {
  EllipsisHorizontalIcon,
  ChevronDownIcon,
} from "@heroicons/vue/24/outline";
import type { User } from "../../types/user";
import { computed, ref, Teleport, watch } from "vue";

const dropdownPosition = ref({ top: 0, left: 0 });
const activeDropdownId = ref<number | null>(null);

const toggleDropdown = (id: number, event: MouseEvent) => {
  if (activeDropdownId.value === id) {
    activeDropdownId.value = null;
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
  activeDropdownId.value = null;
};

const currentPage = ref(1);
const itemsPerPage = ref(5);

const props = defineProps<{
  users: User[];
  query: string;
}>();

const emit = defineEmits<{
  (e: "edit", user: User): void;
  (e: "delete", user: User): void;
}>();

const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return props.users.slice(start, end);
});

const totalPages = computed(() => {
  return Math.ceil(props.users.length / itemsPerPage.value);
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
          <tr>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100"
            >
              No
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100"
            >
              Nama
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100"
            >
              Jabatan
            </th>
            <th
              class="py-4 text-sm font-bold text-gray-900 tracking-wide border-b border-gray-100"
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
            v-for="(user, index) in paginatedUsers"
            :key="user.id"
            class="group hover:bg-gray-50 transition-colors"
          >
            <td class="py-5 font-medium text-gray-900 border-b border-gray-100">
              {{ index + 1 + itemsPerPage * (currentPage - 1) }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ user.name }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ user.position.name }}
            </td>

            <td class="py-5 text-gray-700 border-b border-gray-100">
              {{ user.department.name }}
            </td>

            <td class="py-5 border-b border-gray-100 text-center">
              <button
                @click.stop="toggleDropdown(user.id, $event)"
                class="inline-flex items-center justify-center w-8 h-8 text-gray-500 border rounded-xl hover:bg-gray-100 hover:text-gray-900 transition-all cursor-pointer"
                :class="
                  activeDropdownId === user.id
                    ? 'bg-gray-100 text-gray-900'
                    : ''
                "
              >
                <EllipsisHorizontalIcon class="w-7 h-7 font-bold" />
              </button>
              <Teleport to="body"
                ><div
                  v-if="activeDropdownId === user.id"
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
                        emit('edit', user);
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
                        emit('delete', user);
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

    <p v-if="props.users.length === 0" class="text-center text-gray-500 pt-7">
      No data.
    </p>

    <div
      v-if="props.users.length > 0"
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
