<template>
  <div class="drag-content">
    <Board
      ref="board"
      v-show="playing"
      @restart="restart"
      :drag="drag"
      :link="this.link"
      @leaderboardDataSaved="showLeaderboard"
      @link="passLink"
    />
    <OptionsPane
      ref="optionsPane"
      @gameStart="start"
      v-show="!playing"
      :drag="this.drag"
      :image="this.image"
    />
  </div>
</template>

<script>
import Board from "./Board.vue";
import OptionsPane from "./OptionsPane.vue";
export default {
  props: {
    drag: {
      type: Object,
      required: true,
    },
    image: {
      type: String,
      required: true,
    },
    link: String,
  },

  data() {
    return {
      playing: false,
    };
  },
  components: {
    Board,
    OptionsPane,
  },
  methods: {
    passLink(data) {
      this.$emit("link", data);
    },
    showLeaderboard(data) {
      this.$emit("leaderboardDataSaved", data);
    },
    start(...args) {
      this.playing = true;
      this.$refs.board.start(...args);
    },

    restart() {
      this.playing = false;
      this.$refs.optionsPane.reset();
    },
  },
};
</script>

<style>
.drag-content {
  height: 90%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 40px;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}

a {
  text-decoration: none;
  color: #368ba0;
}

#app {
  font: 14px/20px sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;

  header {
    h1 {
      font-weight: 100;
      height: 80px;
      line-height: 80px;
      font-size: 38px;
    }
  }

  footer {
    color: #555;
    margin-top: 60px;
  }
}

@media screen and (max-width: 767px) {
  .drag-content {
    height: 82%;
  }
}
</style>
