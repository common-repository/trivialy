import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "./components/AdminPanelComponents/pages/DashboardComponent.vue";
import Drag from "./components/AdminPanelComponents/pages/DragComponent.vue";
import QuizType from "./components/AdminPanelComponents/pages/QuizTypeSlider.vue";
import Spin from "./components/AdminPanelComponents/pages/SpinComponent.vue";

import About from "./components/AdminPanelComponents/pages/AboutComponent.vue";
import CreateDrag from "./components/AdminPanelComponents/pages/Drag/CreateDragComponent.vue";
import EditDrag from "./components/AdminPanelComponents/pages/Drag/EditDragComponent.vue";
import Leaderboard from "./components/AdminPanelComponents/pages/LeaderboardComponent.vue";
import Setting from "./components/AdminPanelComponents/pages/SettingComponent.vue";
import EditSpin from "./components/AdminPanelComponents/pages/Spin/EditSpinComponent.vue";
import Upgrade from "./components/AdminPanelComponents/pages/UpgradeComponent.vue";
import CreateSpin from "./components/AdminPanelComponents/pages/spin/CreateSpinComponent.vue";

// popup
import Popup from "./components/AdminPanelComponents/pages/PopupComponent.vue";
import CreatePopup from "./components/AdminPanelComponents/pages/popup/CreatePopUpComponent.vue";
import EditPopup from "./components/AdminPanelComponents/pages/popup/EditPopUpComponent.vue";
// import Popup from "./components/AdminPanelComponents/Shared/CommingSoon.vue";

//scratch
import Scratch from "./components/AdminPanelComponents/pages/ScratchComponent.vue";
import CreateScratch from "./components/AdminPanelComponents/pages/scratch/CreateScratchComponent.vue";
import EditScratch from "./components/AdminPanelComponents/pages/scratch/EditScratchComponent.vue";
// import Scratch from "./components/AdminPanelComponents/Shared/CommingSoon.vue";

//other
import MyCampaing from "./components/AdminPanelComponents/Quiz/MyCampaign.vue";
import EditQuiz from "./components/AdminPanelComponents/pages/QuizType/EditQuizComponent.vue";

// const routes = [
//   //home
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy",
//     name: "home",
//   },
//   // dashboard
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&dash",
//     name: "dashboard",
//     component: Dashboard,
//   },
//   // quiz
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&quiztype_text",
//     name: "quiz",
//     component: QuizType,
//   },

//   //spin
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&spin",
//     name: "spin",
//     component: Spin,
//   },
//   // drag
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&drag",
//     name: "drag",
//     component: Drag,
//   },
//   // scratch
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&scratch",
//     name: "scratch",
//     component: Scratch,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&createScratch",
//     name: "createScratch",
//     component: CreateScratch,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&editScratch/:id",
//     name: "edit_scratch",
//     component: EditScratch,
//   },
//   //popup
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&popup",
//     name: "popup",
//     component: Popup,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&createPopUp",
//     name: "createPopUp",
//     component: CreatePopup,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&editPopup/:id",
//     name: "editPopUp",
//     component: EditPopup,
//   },

//   // leaderboard
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&leaderboard",
//     name: "leaderboard",
//     component: Leaderboard,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&settings",
//     name: "settings",
//     component: Setting,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&upgrade",
//     name: "upgrade",
//     component: Upgrade,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&about",
//     name: "about",
//     component: About,
//   },

//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&createDrag",
//     name: "createDrag",
//     component: CreateDrag,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&createSpin",
//     name: "createSpin",
//     component: CreateSpin,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&editSpin/:id",
//     name: "edit_spin",
//     component: EditSpin,
//   },
//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&editDrag/:id",
//     name: "edit_drag",
//     component: EditDrag,
//   },

//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&quizCampaign",
//     name: "quizCampaing",
//     component: MyCampaing,
//   },

//   {
//     path: "/trivaly/wp-admin/admin.php?page=netro_trivialy&editQuiz/:id",
//     name: "editQuiz",
//     component: EditQuiz,
//   },
// ];

const routes = [
  //home
  {
    path: "/wp-admin/admin.php?page=netro_trivialy",
    name: "home",
  },
  // dashboard
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&dash",
    name: "dashboard",
    component: Dashboard,
  },
  // quiz
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&quiztype_text",
    name: "quiz",
    component: QuizType,
  },

  //spin
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&spin",
    name: "spin",
    component: Spin,
  },
  // drag
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&drag",
    name: "drag",
    component: Drag,
  },
  // scratch
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&scratch",
    name: "scratch",
    component: Scratch,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&createScratch",
    name: "createScratch",
    component: CreateScratch,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&editScratch/:id",
    name: "edit_scratch",
    component: EditScratch,
  },
  //popup
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&popup",
    name: "popup",
    component: Popup,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&createPopUp",
    name: "createPopUp",
    component: CreatePopup,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&editPopup/:id",
    name: "editPopUp",
    component: EditPopup,
  },

  // leaderboard
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&leaderboard",
    name: "leaderboard",
    component: Leaderboard,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&settings",
    name: "settings",
    component: Setting,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&upgrade",
    name: "upgrade",
    component: Upgrade,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&about",
    name: "about",
    component: About,
  },

  {
    path: "/wp-admin/admin.php?page=netro_trivialy&createDrag",
    name: "createDrag",
    component: CreateDrag,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&createSpin",
    name: "createSpin",
    component: CreateSpin,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&editSpin/:id",
    name: "edit_spin",
    component: EditSpin,
  },
  {
    path: "/wp-admin/admin.php?page=netro_trivialy&editDrag/:id",
    name: "edit_drag",
    component: EditDrag,
  },

  {
    path: "/wp-admin/admin.php?page=netro_trivialy&quizCampaign",
    name: "quizCampaing",
    component: MyCampaing,
  },

  {
    path: "/wp-admin/admin.php?page=netro_trivialy&editQuiz/:id",
    name: "editQuiz",
    component: EditQuiz,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  localStorage.setItem("lastRoute", to.name);
  next();
});

export default router;
