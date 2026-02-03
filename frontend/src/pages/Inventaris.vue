<script setup lang="ts">
import { computed, onMounted, ref } from "vue";
import {
  MagnifyingGlassIcon,
  BarsArrowUpIcon,
  BarsArrowDownIcon,
} from "@heroicons/vue/24/outline";
import AppLayout from "../components/layout/AppLayout.vue";
import {
  type Department,
  type UpdateUserPayload,
  type User,
} from "../types/user";
import { createUser, deleteUser, updateUser } from "../api/users";
import {
  getAssignedUser,
  getDepartments,
  getStatusInventaris,
} from "../api/utils";
import EditUserModal from "../components/modal/user/EditUserModal.vue";
import DeleteUserModal from "../components/modal/user/DeleteUserModal.vue";
import InventarisTable from "../components/tables/InventarisTable.vue";
import type {
  AssignedUser,
  CreateInventarisPayload,
  Inventaris,
  Status,
} from "../types/inventaris";
import { createInventaris, getInventaris } from "../api/inventaris";
import CreateInventarisModal from "../components/modal/inventaris/CreateInventarisModal.vue";

const inventaris = ref<Inventaris[]>([]);
const loading = ref<boolean>(false);
const error = ref<string>("");
const status = ref<Status[]>([]);
const assignedUsers = ref<AssignedUser[]>([]);
const departments = ref<Department[]>([]);

const isCreateModalOpen = ref<boolean>(false);
const handleOpenModal = () => {
  isCreateModalOpen.value = !isCreateModalOpen.value;
};
const handleCreateInventaris = async (data: CreateInventarisPayload) => {
  try {
    await createInventaris(data);
  } catch (e) {
    error.value = "Failed to create Inventaris!";
  } finally {
    isCreateModalOpen.value = !isCreateModalOpen.value;
    await fetchInventaris();
  }
};

const isEditModalOpen = ref<boolean>(false);
const selectedUser = ref<User | null>(null);
const handleEditOpenModal = (user: User) => {
  isEditModalOpen.value = !isEditModalOpen.value;
  selectedUser.value = user;
};
const handleEditUser = async (data: UpdateUserPayload) => {
  try {
    await updateUser(data.id, data);
  } catch (e) {
    error.value = "Failed to update user!";
  } finally {
    isEditModalOpen.value = !isEditModalOpen.value;
    await fetchInventaris();
  }
};

const isDeleteModalOpen = ref<boolean>(false);
const handleDeleteOpenModal = (user: User) => {
  isDeleteModalOpen.value = !isDeleteModalOpen.value;
  selectedUser.value = user;
};
const handleDeleteUser = async (data: { id: number }) => {
  try {
    await deleteUser(data.id);
  } catch (e) {
    error.value = "Failed to update user!";
  } finally {
    isDeleteModalOpen.value = !isDeleteModalOpen.value;
    await fetchInventaris();
  }
};

const sort = ref<string>("ascending");
const sortInventaris = () => {
  if (sort.value === "ascending") {
    sort.value = "descending";
    inventaris.value.sort((a, b) => b.id.localeCompare(a.id));
  } else {
    sort.value = "ascending";
    inventaris.value.sort((a, b) => a.id.localeCompare(b.id));
  }
};

const searchQuery = ref<string>("");
const filteredInventaris = computed(() => {
  if (!searchQuery) {
    return inventaris.value;
  }

  const loweringQuery = searchQuery.value.toLowerCase();
  console.log(loweringQuery);
  return inventaris.value.filter((inv) => {
    return (
      inv.id.toLowerCase().includes(loweringQuery) ||
      inv.name.toLowerCase().includes(loweringQuery) ||
      inv.serial_number.toLowerCase().includes(loweringQuery) ||
      inv.spesifikasi.toLowerCase().includes(loweringQuery) ||
      (inv.status?.name ?? "").toLowerCase().includes(loweringQuery) ||
      (inv.type?.name ?? "").toLowerCase().includes(loweringQuery) ||
      (inv.assigned_user?.name ?? "").toLowerCase().includes(loweringQuery) ||
      (inv.department?.name ?? "").toLowerCase().includes(loweringQuery)
    );
  });
});

const fetchInventaris = async () => {
  loading.value = true;

  try {
    inventaris.value = await getInventaris();
    departments.value = await getDepartments();
    status.value = await getStatusInventaris();
    assignedUsers.value = await getAssignedUser();
  } catch (e) {
    error.value = "Failed to get inventaris!";
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchInventaris();
});
</script>

<template>
  <AppLayout>
    <div class="flex flex-row justify-between">
      <h1 class="text-xl font-semibold mb-6">Data Inventaris</h1>

      <div class="flex items-center gap-3">
        <div class="relative w-xs max-w-md group">
          <div
            class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none"
          >
            <MagnifyingGlassIcon class="w-5 h-5 text-slate-500" />
          </div>

          <input
            v-model="searchQuery"
            type="text"
            class="block w-full py-4 pl-12 pr-12 text-sm font-light text-slate-900 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-slate-200 placeholder-slate-500"
            placeholder="Search Inventaris"
          />

          <div
            class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer group"
            @click="sortInventaris"
            v-if="sort === 'ascending'"
          >
            <BarsArrowUpIcon
              class="w-5 h-5 text-slate-500 transition-colors group-hover:text-slate-800"
            />
          </div>
          <div
            class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer group"
            @click="sortInventaris"
            v-if="sort === 'descending'"
          >
            <BarsArrowDownIcon
              class="w-5 h-5 text-slate-500 transition-colors group-hover:text-slate-800"
            />
          </div>
        </div>
        <div
          class="flex items-center justify-center bg-black rounded-2xl py-3 px-4"
        >
          <button
            @click="handleOpenModal"
            class="flex items-center gap-3 text-md font-medium bg-gradient-to-r from-teal-300 to-amber-300 bg-clip-text text-transparent cursor-pointer"
          >
            <span
              class="w-5 h-5 bg-gradient-to-r from-teal-300 to-amber-300 icon-mask-plus"
            ></span>
            Tambah Data
          </button>
        </div>
      </div>
    </div>
    <p class="flex items-center justify-center min-h-9/12" v-if="loading">
      Loading...
    </p>
    <p v-if="error">{{ error }}</p>
    <div v-if="!loading && !error">
      <InventarisTable
        :inventaris="filteredInventaris"
        :query="searchQuery"
        @edit="handleEditOpenModal"
        @delete="handleDeleteOpenModal"
      />
    </div>
    <CreateInventarisModal
      :assigned-users="assignedUsers"
      :status-inventaris="status"
      :departments="departments"
      :is-open="isCreateModalOpen"
      @close="isCreateModalOpen = false"
      @save="handleCreateInventaris"
    />
    <EditUserModal
      :positions="positions"
      :departments="departments"
      :user="selectedUser"
      :is-open="isEditModalOpen"
      @close="isEditModalOpen = false"
      @save="handleEditUser"
    />
    <DeleteUserModal
      :user="selectedUser"
      :is-open="isDeleteModalOpen"
      @close="isDeleteModalOpen = false"
      @confirm="handleDeleteUser"
    />
  </AppLayout>
</template>
