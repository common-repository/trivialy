<template>
  <div class="quiz-header">
    <nav class="nav-header">
      <div class="header-text">{{ headerText }}</div>
      <router-link
        v-if="
          !isCreateQuizRoute &&
          !isCreateCustomQuizRoute &&
          !isEditCustomQuizRoute &&
          !isEditQuizRoute
        "
        :to="{ name: 'createQuiz' }"
        class="header-button"
        :class="{ hidden: isCreateQuizRoute }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
        >
          <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z" fill="white" />
        </svg>
        <div class="btn-text">Create Campaign</div>
      </router-link>
      <router-link
        v-if="
          !isCreateCustomQuizRoute &&
          !isCreateQuizRoute &&
          !isEditCustomQuizRoute &&
          !isEditQuizRoute
        "
        :to="{ name: 'createCustomQuiz' }"
        class="header-button"
        :class="{ hidden: isCreateQuizRoute }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
        >
          <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z" fill="white" />
        </svg>
        <div class="btn-text">Create Custom Campaign</div>
      </router-link>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isCreateQuizRoute: false,
      isCreateCustomQuizRoute: false,
      isEditCustomQuizRoute: false,

      isEditQuizRoute: false,
    };
  },
  computed: {
    headerText() {
      if (this.isCreateQuizRoute) {
        return "Create Campaign";
      } else if (this.isCreateCustomQuizRoute) {
        return "Create Custom Campaign";
      } else if (this.isEditCustomQuizRoute) {
        return "Edit Custom Campaign";
      } else if (this.isEditQuizRoute) {
        return "Edit Text Campaign";
      } else {
        return "My Campaigns";
      }
    },
  },
  watch: {
    $route(to, from) {
      this.isCreateQuizRoute = to.name === "createQuiz";
      this.isCreateCustomQuizRoute = to.name === "createCustomQuiz";
      this.isEditCustomQuizRoute = to.name === "editCustomQuiz";
      this.isEditImageQuizRoute = to.name === "editImageQuiz";
      this.isEditQuizRoute = to.name === "editQuiz";
    },
  },
};
</script>

<style scoped>
.quiz-header {
  padding: 16px 40px;
  box-shadow: 0px 7px 15px 0px rgba(219, 23, 23, 0.1);
}
.hidden {
  display: none;
}
a {
  text-decoration: none !important;
}
.header-text {
  color: #1d2327;
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
}

.nav-header {
  display: flex;
  gap: 12px;
  align-items: center;
}

.header-button {
  display: flex;
  gap: 4;
  background-color: #706aea;
  color: #ffffff;
  align-items: center;
  padding: 8px 12px;
  border-radius: 6px;
  cursor: pointer;
}
.btn-text {
  color: var(--color-natural-50, #fff);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}
</style>
