import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";

const routes = [{ path: "/login", component: Login }];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, _, next) => {
  const token = localStorage.getItem("token");

  if (to.meta.requiresAuth && !token) {
    next("/login");
  } else {
    next();
  }
});

export default router;
