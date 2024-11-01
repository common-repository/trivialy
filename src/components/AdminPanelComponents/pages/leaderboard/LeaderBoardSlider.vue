<template>
  <div>
    <div class="tabs">
      <div
        @click="showTab(1)"
        :class="{ active: activeTab === 1 }"
        class="quiz-tab-header"
      >
        Quiz
      </div>
      <div
        @click="showTab(2)"
        :class="{ active: activeTab === 2 }"
        class="quiz-tab-header"
      >
        Drag n Match
      </div>
    </div>

    <div v-if="activeTab === 1">
      <Quiz />
    </div>

    <div v-if="activeTab === 2">
      <Drag />
    </div>
  </div>
</template>

<script>
import Quiz from "./QuizLeaderBoardComponent.vue";
import Drag from "./DragLeaderBoardComponent.vue";

export default {
  data() {
    return {
      activeTab: 1,
    };
  },
  components: {
    Quiz,
    Drag,
  },
  methods: {
    showTab(tabNumber) {
      this.activeTab = tabNumber;
    },
  },
};
</script>

<style scoped>
.tabs {
  display: flex;
  background-color: #eee;
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
  font-family: Inter;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 22.4px */
}

.campaign-header {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter";
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}

.quiz-tab-header {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: Inter;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
</style>
