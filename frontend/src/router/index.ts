import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Users from "../pages/Users.vue";
import Inventaris from "../pages/Inventaris.vue";
import Analytics from "../pages/Analytics.vue";

const routes = [
  { path: "/login", component: Login, meta: { guest: true } },
  { path: "/users", component: Users, meta: { requiresAuth: true } },
  { path: "/inventaris", component: Inventaris, meta: { requiresAuth: true } },
  { path: "/analytics", component: Analytics, meta: { requiresAuth: true } },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, _, next) => {
  const token = localStorage.getItem("token");

  if (to.meta.requiresAuth && !token) {
    next("/login");
  } else if (to.meta.guest && token) {
    next("/users");
  } else {
    next();
  }
});

export default router;
