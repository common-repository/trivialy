<template>
  <div class="leader-header">Leaderboard</div>
  <LeaderBoardSlider />
</template>

<script>
import LeaderBoardSlider from "./leaderboard/LeaderBoardSlider.vue";
export default {
  data() {
    return {};
  },
  components: {
    LeaderBoardSlider,
  },
};
</script>

<style>
.leader-header {
  margin-bottom: 40px;
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}
</style>
