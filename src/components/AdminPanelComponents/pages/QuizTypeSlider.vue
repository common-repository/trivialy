<template>
  <div>
    <div class="tabs">
      <div
        @click="showTab(1)"
        :class="{ active: activeTab === 1 }"
        class="quiz-tab-header"
      >
        Text Quiz
      </div>
      <div
        @click="showTab(2)"
        :class="{ active: activeTab === 2 }"
        class="quiz-tab-header premium"
      >
        Image Quiz
        <svg
          height="24"
          viewBox="0 0 24 24"
          width="24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <g id="Layer_2" data-name="Layer 2">
            <path
              d="m18.5 20.5h-13a1 1 0 0 1 0-2h13a1 1 0 0 1 0 2z"
              fill="#9c34c2"
            />
            <path
              d="m21.13 6.25a2 2 0 0 0 -2.24-.08l-2.42 1.4-2.76-4.15a2.06 2.06 0 0 0 -3.42 0l-2.83 4.16-2.36-1.41a2 2 0 0 0 -3.1 2.16l1.47 7.32a2 2 0 0 0 2 1.65h13a2 2 0 0 0 2-1.65l1.53-7.32a2 2 0 0 0 -.87-2.08z"
              fill="#ffce29"
            />
            <circle cx="12" cy="12.5" fill="#ffa500" r="2" />
          </g>
        </svg>
      </div>
    </div>

    <div v-if="activeTab === 1">
      <TextQuiz />
    </div>
  </div>
</template>

<script>
import { trivialy_upgrade_url } from "../../../config";
import TextQuiz from "./QuizType/QuizComponent.vue";

export default {
  mounted() {
    this.initializeActiveTab();
  },
  watch: {
    "$route.query.quizType"(newQuizType) {
      this.initializeActiveTab();
    },
  },
  data() {
    return {
      activeTab: 1,
      router_name: "",
    };
  },
  components: {
    TextQuiz,
  },

  methods: {
    showTab(tabNumber) {
      if (tabNumber === 2) {
        window.open(trivialy_upgrade_url, "_blank");
        this.activeTab = 1;
      } else {
        this.activeTab = tabNumber;
      }
    },
    initializeActiveTab() {
      const quizType = this.$route.query.quizType;

      if (quizType === "image_quiz") {
        this.showTab(2);
      } else if (quizType === "quiz") {
        this.showTab(1);
      } else {
        // Handle other cases or set a default behavior
        this.showTab(1);
      }
    },
  },
};
</script>

<style scoped>
.page-header {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
  margin-bottom: 24px;
}
.tabs {
  display: flex;
  background-color: #eeeeee;
  border-radius: 12px;
  padding: 8px;
}

.tabs div {
  cursor: pointer;
  padding: 12px 24px;
  border-radius: 8px;
}

.tabs div.active {
  background-color: #ffffff;
  color: #2f2f2f;
}

.quiz-tab-header {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.premium {
  display: flex;
  align-items: center;
  gap: 8px;
}
</style>
