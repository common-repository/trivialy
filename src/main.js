import axios from "axios";
import { createApp } from "vue";
import Home from "./components/AdminPanelComponents/HomeComponent.vue";
import Home2 from "./components/AdminPanelComponents/NoSidebarHome.vue";
import Home3 from "./components/AdminPanelComponents/NoSidebarHomeImage.vue";
import FrontHome from "./components/FrontendComponents/HomeComponent.vue";
import { baseImg_url, base_url } from "./config";
import Router from "./router.js";
import "./style.css";

axios.interceptors.request.use((config) => {
  // Set the X-WP-Nonce header using wpApiSettings.nonce
  config.headers["X-WP-Nonce"] = wpApiSettings.nonce;
  return config;
});

const app = createApp(Home);
app.config.globalProperties.$base_url = base_url;
app.use(Router);
app.mount("#trivialy-plugin");

const app2 = createApp(Home2);
app2.config.globalProperties.$base_url = base_url;
app2.use(Router);
app2.mount("#trivialy-quiz-plugin");

const app3 = createApp(Home3);
app3.config.globalProperties.$base_url = base_url;
app3.use(Router);
app3.mount("#trivialy-image-quiz-plugin");

const frontApp = createApp(FrontHome);
frontApp.config.globalProperties.$base_url = base_url;
frontApp.config.globalProperties.$baseImg_url = baseImg_url;
frontApp.mount("#front-trivialy");
