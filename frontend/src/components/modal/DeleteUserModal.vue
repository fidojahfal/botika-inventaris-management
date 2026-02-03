<script setup lang="ts">
import { ref, watch } from "vue";
import { XMarkIcon, ChevronDownIcon, TrashIcon } from "@heroicons/vue/24/outline";
import type { Department, Position, User } from "../../types/user";

const props = defineProps<{
  isOpen: boolean;
  user: User | null;
}>();

const emit = defineEmits(["close", "confirm"]);

const formData = ref({
  id: null,
  name: "",
});

watch(
  () => props.user,
  (u) => {
    if (!u) return;
    formData.value = {
      id: u.id,
    };
  },
  { immediate: true },
);

const handleDelete = () => {
  emit("confirm", formData.value);
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
        class="relative bg-white w-full max-w-[400px] rounded-[2.5rem] shadow-2xl p-8 text-center transform transition-all scale-100"
      >
        <div class="flex justify-center mb-6">
          <div
            class="w-20 h-20 bg-rose-500 rounded-[1.8rem] flex items-center justify-center shadow-lg shadow-red-200"
          >
            <TrashIcon class="w-10 h-10 text-white" />
          </div>
        </div>

        <h2 class="text-xl font-bold text-gray-900 mb-3">Delete Data</h2>

        <p class="text-gray-500 text-sm leading-relaxed mb-8 px-2">
          Are you sure you want to delete member
          <span class="font-bold text-gray-900">{{ user?.name }}</span
          >? This action cannot be undone.
        </p>

        <div class="space-y-3">
          <button
            @click="handleDelete"
            class="w-full py-4 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-2xl shadow-xl shadow-red-100 transition-all active:scale-95 cursor-pointer"
          >
            Delete Data
          </button>

          <button
            @click="$emit('close')"
            class="w-full py-2 text-gray-500 hover:text-gray-900 font-bold text-sm transition-colors cursor-pointer"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </Teleport>
</template>
