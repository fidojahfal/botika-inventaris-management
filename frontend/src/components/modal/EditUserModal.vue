<script setup lang="ts">
import { ref, watch } from "vue";
import { XMarkIcon, ChevronDownIcon } from "@heroicons/vue/24/outline";
import type { Department, Position, User } from "../../types/user";

const props = defineProps<{
  isOpen: boolean;
  departments: Department[];
  positions: Position[];
  user: User | null;
}>();

const emit = defineEmits(["close", "save"]);

const activeField = ref("");

const formData = ref({
  id: null,
  name: "",
  position_id: null,
  department_id: null,
});

watch(
  () => props.user,
  (u) => {
    if (!u) return;
    formData.value = {
      id: u.id,
      name: u.name,
      position_id: u.position.id,
      department_id: u.department.id,
    };
  },
  { immediate: true },
);

const handleSave = () => {
  emit("save", formData.value);
};
</script>

<template>
  <Teleport to="body">
    <div
      v-if="isOpen"
      class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
    >
      <div
        class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity"
        @click="$emit('close')"
      ></div>

      <div
        class="relative bg-white w-full max-w-lg rounded-[2rem] shadow-2xl overflow-hidden transform transition-all scale-100 p-8"
      >
        <div class="flex justify-between items-start mb-6">
          <div>
            <h2 class="text-2xl font-bold text-gray-900">Edit Data</h2>
            <p class="text-gray-500 text-sm mt-1">
              Make sure everything looks right before saving.
            </p>
          </div>
          <button
            @click="$emit('close')"
            class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors"
          >
            <XMarkIcon class="w-5 h-5 text-gray-500 cursor-pointer" />
          </button>
        </div>

        <div class="space-y-4">
          <div
            class="p-[2px] rounded-2xl transition-all duration-300"
            :class="
              activeField === 'name'
                ? 'bg-gradient-to-r from-teal-300 to-amber-300'
                : 'bg-transparent'
            "
          >
            <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative group">
              <label
                class="block text-xs font-normal transition-colors mb-0.5"
                :class="
                  activeField === 'name'
                    ? 'text-teal-600 font-bold'
                    : 'text-teal-500'
                "
                >Nama</label
              >
              <input
                v-model="formData.name"
                @focus="activeField = 'name'"
                @blur="activeField = ''"
                type="text"
                class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none placeholder-gray-400 text-base"
              />
            </div>
          </div>

          <div
            class="p-[2px] rounded-2xl transition-all duration-300"
            :class="
              activeField === 'position'
                ? 'bg-gradient-to-r from-teal-300 to-amber-300 shadow-sm'
                : 'bg-transparent'
            "
          >
            <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative">
              <label
                class="block text-xs font-normal transition-colors mb-0.5"
                :class="
                  activeField === 'position'
                    ? 'text-teal-600 font-bold'
                    : 'text-teal-500'
                "
                >Jabatan</label
              >
              <div class="relative">
                <select
                  v-model="formData.position_id"
                  @focus="activeField = 'position'"
                  @blur="activeField = ''"
                  class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none appearance-none text-base cursor-pointer pb-1"
                >
                  <option disabled value="">Pilih Jabatan</option>
                  <option
                    v-for="p in props.positions"
                    :key="p.id"
                    :value="p.id"
                  >
                    {{ p.name }}
                  </option>
                </select>
                <ChevronDownIcon
                  class="w-5 h-5 text-gray-400 absolute right-0 top-0 pointer-events-none"
                />
              </div>
            </div>
          </div>

          <div
            class="p-[2px] rounded-2xl transition-all duration-300"
            :class="
              activeField === 'department'
                ? 'bg-gradient-to-r from-teal-300 to-amber-300 shadow-sm'
                : 'bg-transparent'
            "
          >
            <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative">
              <label
                class="block text-xs font-normal transition-colors mb-0.5"
                :class="
                  activeField === 'department'
                    ? 'text-teal-600 font-bold'
                    : 'text-teal-500'
                "
                >Department</label
              >
              <div class="relative">
                <select
                  v-model="formData.department_id"
                  @focus="activeField = 'department'"
                  @blur="activeField = ''"
                  class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none appearance-none text-base cursor-pointer pb-1"
                >
                  <option disabled value="">Pilih Department</option>
                  <option
                    v-for="d in props.departments"
                    :key="d.id"
                    :value="d.id"
                  >
                    {{ d.name }}
                  </option>
                </select>
                <ChevronDownIcon
                  class="w-5 h-5 text-gray-400 absolute right-0 top-0 pointer-events-none"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="flex justify-end items-center gap-3 mt-8">
          <button
            @click="$emit('close')"
            class="px-6 py-3 text-sm font-bold text-gray-700 hover:text-gray-900 transition-colors cursor-pointer"
          >
            Cancel
          </button>
          <button
            @click="handleSave"
            class="px-6 py-3 text-sm font-bold text-white bg-gray-900 rounded-xl hover:bg-black transition-all shadow-lg shadow-gray-200 cursor-pointer"
          >
            Save Changes
          </button>
        </div>
      </div>
    </div>
  </Teleport>
</template>
