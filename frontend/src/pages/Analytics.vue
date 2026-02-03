<script setup lang="ts">
import { computed, onMounted, ref } from "vue";
import {
  ClipboardDocumentCheckIcon,
  ExclamationTriangleIcon,
  TagIcon,
  XCircleIcon,
} from "@heroicons/vue/24/outline";

import { Bar } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";
import AppLayout from "../components/layout/AppLayout.vue";
import type { Analytics, Summary } from "../types/inventaris";
import { getAnalytics } from "../api/inventaris";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
);

const analyticsData = ref<Analytics | null>(null);
const isLoading = ref<boolean>(false);
const error = ref<string>("");

const cardConfig = [
  {
    key: "baik", // Sesuai key di JSON "summary"
    label: "Barang Baik",
    icon: ClipboardDocumentCheckIcon,
    colorClass: "text-teal-600 bg-teal-50",
  },
  {
    key: "rusak",
    label: "Barang Rusak",
    icon: ExclamationTriangleIcon,
    colorClass: "text-rose-500 bg-rose-50",
  },
  {
    key: "dilelang",
    label: "Dilelang",
    icon: TagIcon,
    colorClass: "text-amber-600 bg-amber-50",
  },
  {
    key: "tidak_dipakai",
    label: "Tidak Dipakai",
    icon: XCircleIcon,
    colorClass: "text-indigo-600 bg-indigo-50",
  },
];

const stats = computed(() => {
  return cardConfig.map((item) => ({
    ...item,
    count: analyticsData.value?.summary[item.key as keyof Summary] || 0,
  }));
});

const chartData = computed(() => {
  const charItems = analyticsData.value?.chart || [];

  return {
    labels: charItems.map((i) => i.label),
    datasets: [
      {
        label: "Jumlah",
        data: charItems.map((i) => i.value),
        backgroundColor: "#8b5cf6",
        borderRadius: 8,
        barThickness: 50,
      },
    ],
  };
});

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      display: false,
    },
    tooltip: {
      backgroundColor: "#1f2937",
      padding: 12,
      cornerRadius: 8,
    },
  },
  scales: {
    y: {
      beginAtZero: true,
      max: 100,
      border: {
        display: false,
        dash: [5, 5],
      },
      grid: {
        color: "#e5e7eb",
        tickLength: 0,
        borderDash: [8, 4],
      },
      ticks: {
        font: { size: 12 },
        color: "#6b7280",
        padding: 10,
      },
    },
    x: {
      border: {
        display: false,
      },
      grid: {
        display: false,
      },
      ticks: {
        font: { size: 12 },
        color: "#6b7280",
        padding: 10,
      },
    },
  },
};

onMounted(async () => {
  isLoading.value = true;
  try {
    analyticsData.value = await getAnalytics();
  } catch (e) {
    error.value = "Failed to get analytics!";
  } finally {
    isLoading.value = false;
  }
});
</script>

<template>
  <AppLayout>
    <div class="w-full p-6 space-y-8">
      <h1 class="text-xl font-bold text-gray-900">Analytics</h1>

      <p v-if="error">{{ error }}</p>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
          v-for="(item, index) in stats"
          :key="index"
          class="bg-slate-50 p-6 rounded-[1.5rem] relative"
        >
          <div class="flex justify-between items-start mb-4">
            <div
              :class="`w-10 h-10 rounded-full flex items-center justify-center ${item.colorClass}`"
            >
              <component :is="item.icon" class="w-6 h-6" />
            </div>

            <div
              class="w-6 h-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center cursor-pointer hover:bg-gray-300"
            >
              <span class="text-xs font-serif font-bold italic">i</span>
            </div>
          </div>

          <p class="text-gray-500 text-sm font-medium mb-1">{{ item.label }}</p>
          <p class="text-3xl font-bold text-gray-900">{{ item.count }}</p>
        </div>
      </div>

      <div class="w-3/4 h-[400px] bg-white pt-6">
        <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
      </div>
    </div>
  </AppLayout>
</template>
