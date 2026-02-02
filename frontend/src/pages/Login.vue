<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../api/axios";

const router = useRouter();

const email = ref<string>("");
const password = ref<string>("");
const error = ref<string>("");

const login = async () => {
  try {
    const res = await api.post("/login", {
      email: email.value,
      password: password.value,
    });

    localStorage.setItem("token", res.data.token);
    localStorage.setItem("user", JSON.stringify(res.data.user));

    router.push("/");
  } catch (e) {
    error.value = "Failed to login";
  }
};
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <form @submit.prevent="login" class="bg-white p-6 rounded-xl w-96">
      <h1 class="flex justify-center text-2xl font-semibold mb-4">Login</h1>

      <input v-model="email" placeholder="Email" class="input border-1 rounded-lg p-2 w-full " />
      <input
        v-model="password"
        type="password"
        placeholder="Password"
        class="input mt-4 border-1 rounded-lg p-2 w-full"
      />

      <button class="bg-black mt-10 p-2 w-full rounded-xl text-white">Login</button>
      <p v-if="error" class="text-red-500 mt-2">{{ error }}</p>
    </form>
  </div>
</template>
