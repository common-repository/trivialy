import { createRouter, createWebHistory } from "vue-router";

const routes = [];

// const routes = [
//   {
//     path: "/wp-admin/admin.php?page=netro_trivaly_quiz",
//     name: "quizCampaing",
//     component: MyCampaing,
//   },
//   {
//     path: "/wp-admin/admin.php?page=netro_trivaly_quiz&createQuiz",
//     name: "createQuiz",
//     component: Quiz,
//   },
//   {
//     path: "/wp-admin/admin.php?page=netro_trivaly_quiz&createCustomQuiz",
//     name: "createCustomQuiz",
//     component: CreateCustomQuiz,
//   },
//   {
//     path: "/wp-admin/admin.php?page=netro_trivaly_quiz&editCustomQuiz/:id",
//     name: "editCustomQuiz",
//     component: EditCustomQuiz,
//   },
//
//   {
//     path: "/wp-admin/admin.php?page=netro_trivaly_quiz&editImageQuiz/:id",
//     name: "editImageQuiz",
//     component: EditImageQuiz,
//   },
// ];

const subMenuRouter = createRouter({
  history: createWebHistory(),
  routes,
});

subMenuRouter.beforeEach((to, from, next) => {
  localStorage.setItem("lastRoute", to.name);
  next();
});

export default subMenuRouter;
