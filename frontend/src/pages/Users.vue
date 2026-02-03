<script setup lang="ts">
import { computed, onMounted, ref } from "vue";
import {
  MagnifyingGlassIcon,
  BarsArrowUpIcon,
  BarsArrowDownIcon,
} from "@heroicons/vue/24/outline";
import AppLayout from "../components/layout/AppLayout.vue";
import UserTable from "../components/tables/UserTable.vue";
import {
  Position,
  type CreateUserPayload,
  type Department,
  type UpdateUserPayload,
  type User,
} from "../types/user";
import { createUser, deleteUser, getUsers, updateUser } from "../api/users";
import CreateUserModal from "../components/modal/CreateUserModal.vue";
import { getDepartments, getPositions } from "../api/utils";
import EditUserModal from "../components/modal/EditUserModal.vue";
import DeleteUserModal from "../components/modal/deleteUserModal.vue";

const users = ref<User[]>([]);
const loading = ref<boolean>(false);
const error = ref<string>("");
const positions = ref<Position[]>([]);
const departments = ref<Department[]>([]);

const isCreateModalOpen = ref<boolean>(false);
const handleOpenModal = () => {
  isCreateModalOpen.value = !isCreateModalOpen.value;
};
const handleCreateUser = async (data: CreateUserPayload) => {
  try {
    await createUser(data);
  } catch (e) {
    error.value = "Failed to create user!";
  } finally {
    isCreateModalOpen.value = !isCreateModalOpen.value;
    await fetchUser();
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
    await fetchUser();
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
    await fetchUser();
  }
};

const sort = ref<string>("ascending");
const sortUser = () => {
  if (sort.value === "ascending") {
    sort.value = "descending";
    users.value.sort((a, b) => b.id - a.id);
  } else {
    sort.value = "ascending";
    users.value.sort((a, b) => a.id - b.id);
  }
};

const searchQuery = ref<string>("");
const filteredUser = computed(() => {
  if (!searchQuery) {
    return users.value;
  }

  const loweringQuery = searchQuery.value.toLowerCase();

  return users.value.filter((user) => {
    return (
      user.name.toLowerCase().includes(loweringQuery) ||
      user.position.name.toLowerCase().includes(loweringQuery) ||
      user.department.name.toLowerCase().includes(loweringQuery)
    );
  });
});

const fetchUser = async () => {
  loading.value = true;

  try {
    users.value = await getUsers();
    positions.value = await getPositions();
    departments.value = await getDepartments();
  } catch (e) {
    error.value = "Failed to get users!";
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchUser();
});
</script>

<template>
  <AppLayout>
    <div class="flex flex-row justify-between">
      <h1 class="text-xl font-semibold mb-6">Management Anggota</h1>

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
            placeholder="Search Anggota"
          />

          <div
            class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer group"
            @click="sortUser"
            v-if="sort === 'ascending'"
          >
            <BarsArrowUpIcon
              class="w-5 h-5 text-slate-500 transition-colors group-hover:text-slate-800"
            />
          </div>
          <div
            class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer group"
            @click="sortUser"
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
            Tambah Anggota
          </button>
        </div>
      </div>
    </div>
    <p class="flex items-center justify-center min-h-9/12" v-if="loading">
      Loading...
    </p>
    <p v-if="error">{{ error }}</p>
    <div v-if="!loading && !error">
      <UserTable
        :users="filteredUser"
        :query="searchQuery"
        @edit="handleEditOpenModal"
        @delete="handleDeleteOpenModal"
      />
    </div>
    <CreateUserModal
      :positions="positions"
      :departments="departments"
      :is-open="isCreateModalOpen"
      @close="isCreateModalOpen = false"
      @save="handleCreateUser"
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
