<template>
  <PuzzleComponent
    :drag="this.drag"
    :image="this.image"
    :link="this.link"
    @leaderboardDataSaved="showLeaderboard"
  />
</template>
<script>
import PuzzleComponent from "./ImageSlider/PuzzleComponent.vue";
export default {
  props: {
    board: {
      type: String,
      required: true,
    },
    image: {
      type: String,
      required: true,
    },
    link: String,
  },

  data() {
    return {};
  },
  methods: {
    showLeaderboard(data) {
      this.$emit("leaderboardDataSaved", data);
    },
  },
  components: {
    PuzzleComponent,
  },
};
</script>
