<script setup lang="ts">
import { ref, watch } from "vue";
import { XMarkIcon, ChevronDownIcon } from "@heroicons/vue/24/outline";
import type { Department, Position } from "../../../types/user";
import type { AssignedUser, Status } from "../../../types/inventaris";

const props = defineProps<{
  isOpen: boolean;
  departments: Department[];
  statusInventaris: Status[];
  assignedUsers: AssignedUser[];
}>();

const emit = defineEmits(["close", "save"]);

const activeField = ref("");

const formData = ref({
  id: "",
  name: "",
  type: "",
  serial_number: "",
  spesifikasi: "",
  status_id: null,
  assigned_user_id: null,
  department_id: null,
});

watch(
  () => props.isOpen,
  (isOpen) => {
    if (isOpen) {
      if (props.inventaris) {
        formData.value = {
          name: newInv.name,
          type: newInv.type,
          serial_number: newInv.serial_number,
          spesifikasi: newInv.spesifikasi,
          status_id: newInv.status_id,
          assigned_user_id: newInv.assigned_user_id,
          department_id: newInv.department_id,
        };
      }
    } else {
      formData.value = {
        id: "",
        name: "",
        type: "",
        serial_number: "",
        spesifikasi: "",
        status_id: null,
        assigned_user_id: null,
        department_id: null,
      };
    }
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
        class="relative bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl overflow-hidden transform transition-all scale-100 p-8"
      >
        <div class="flex justify-between items-start mb-6">
          <div>
            <h2 class="text-2xl font-bold text-gray-900">Tambah Data</h2>
            <p class="text-gray-500 text-sm mt-1">
              Make sure everything looks right before creating.
            </p>
          </div>
          <button
            @click="$emit('close')"
            class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors"
          >
            <XMarkIcon class="w-5 h-5 text-gray-500 cursor-pointer" />
          </button>
        </div>

        <div class="space-y-1">
          <div
            class="p-[2px] rounded-2xl transition-all duration-300"
            :class="
              activeField === 'id'
                ? 'bg-gradient-to-r from-teal-300 to-amber-300'
                : 'bg-transparent'
            "
          >
            <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative group">
              <label
                class="block text-xs font-normal transition-colors mb-0.5"
                :class="
                  activeField === 'id'
                    ? 'text-teal-600 font-bold'
                    : 'text-teal-500'
                "
                >Inventaris ID</label
              >
              <input
                v-model="formData.id"
                @focus="activeField = 'id'"
                @blur="activeField = ''"
                type="text"
                class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none placeholder-gray-400 text-base"
              />
            </div>
          </div>

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
                >Barang</label
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
              activeField === 'type'
                ? 'bg-gradient-to-r from-teal-300 to-amber-300'
                : 'bg-transparent'
            "
          >
            <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative group">
              <label
                class="block text-xs font-normal transition-colors mb-0.5"
                :class="
                  activeField === 'type'
                    ? 'text-teal-600 font-bold'
                    : 'text-teal-500'
                "
                >Type</label
              >
              <input
                v-model="formData.type"
                @focus="activeField = 'type'"
                @blur="activeField = ''"
                type="text"
                class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none placeholder-gray-400 text-base"
              />
            </div>
          </div>

          <div
            class="p-[2px] rounded-2xl transition-all duration-300"
            :class="
              activeField === 'serial_number'
                ? 'bg-gradient-to-r from-teal-300 to-amber-300'
                : 'bg-transparent'
            "
          >
            <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative group">
              <label
                class="block text-xs font-normal transition-colors mb-0.5"
                :class="
                  activeField === 'serial_number'
                    ? 'text-teal-600 font-bold'
                    : 'text-teal-500'
                "
                >Serial Number</label
              >
              <input
                v-model="formData.serial_number"
                @focus="activeField = 'serial_number'"
                @blur="activeField = ''"
                type="text"
                class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none placeholder-gray-400 text-base"
              />
            </div>
          </div>

          <div
            class="p-[2px] rounded-2xl transition-all duration-300"
            :class="
              activeField === 'spesifikasi'
                ? 'bg-gradient-to-r from-teal-300 to-amber-300'
                : 'bg-transparent'
            "
          >
            <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative group">
              <label
                class="block text-xs font-normal transition-colors mb-0.5"
                :class="
                  activeField === 'spesifikasi'
                    ? 'text-teal-600 font-bold'
                    : 'text-teal-500'
                "
                >Spesifikasi</label
              >
              <input
                v-model="formData.spesifikasi"
                @focus="activeField = 'spesifikasi'"
                @blur="activeField = ''"
                type="text"
                class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none placeholder-gray-400 text-base"
              />
            </div>
          </div>

          <div
            class="p-[2px] rounded-2xl transition-all duration-300"
            :class="
              activeField === 'status_id'
                ? 'bg-gradient-to-r from-teal-300 to-amber-300 shadow-sm'
                : 'bg-transparent'
            "
          >
            <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative">
              <label
                class="block text-xs font-normal transition-colors mb-0.5"
                :class="
                  activeField === 'status_id'
                    ? 'text-teal-600 font-bold'
                    : 'text-teal-500'
                "
                >Status</label
              >
              <div class="relative">
                <select
                  v-model="formData.status_id"
                  @focus="activeField = 'status_id'"
                  @blur="activeField = ''"
                  class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none appearance-none text-base cursor-pointer pb-1"
                >
                  <option disabled value="">Pilih Status</option>
                  <option
                    v-for="status in props.statusInventaris"
                    :key="status.id"
                    :value="status.id"
                  >
                    {{ status.name }}
                  </option>
                </select>
                <ChevronDownIcon
                  class="w-5 h-5 text-gray-400 absolute right-0 top-0 pointer-events-none"
                />
              </div>
            </div>
          </div>

          <div class="flex">
            <div
              class="p-[2px] rounded-2xl transition-all duration-300 w-full"
              :class="
                activeField === 'assigned_user_id'
                  ? 'bg-gradient-to-r from-teal-300 to-amber-300 shadow-sm'
                  : 'bg-transparent'
              "
            >
              <div class="bg-teal-50 rounded-2xl px-4 py-2.5 relative">
                <label
                  class="block text-xs font-normal transition-colors mb-0.5"
                  :class="
                    activeField === 'assigned_user_id'
                      ? 'text-teal-600 font-bold'
                      : 'text-teal-500'
                  "
                  >Assign</label
                >
                <div class="relative">
                  <select
                    v-model="formData.assigned_user_id"
                    @focus="activeField = 'assigned_user_id'"
                    @blur="activeField = ''"
                    class="w-full bg-transparent border-none p-0 text-gray-900 font-medium focus:ring-0 focus:outline-none appearance-none text-base cursor-pointer pb-1"
                  >
                    <option disabled value="">Assign</option>
                    <option
                      v-for="assign in props.assignedUsers"
                      :key="assign.id"
                      :value="assign.id"
                    >
                      {{ assign.name }}
                    </option>
                  </select>
                  <ChevronDownIcon
                    class="w-5 h-5 text-gray-400 absolute right-0 top-0 pointer-events-none"
                  />
                </div>
              </div>
            </div>
            <div
              class="p-[2px] rounded-2xl transition-all duration-300 w-full"
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
            Create Inventaris
          </button>
        </div>
      </div>
    </div>
  </Teleport>
</template>
