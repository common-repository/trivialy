<template>
  <!-- <form id="optionsForm" @submit.prevent="start">
    <div>
      <button>Start</button>
    </div>
  </form> -->
</template>

<script>
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
  },
  mounted() {
    this.getBoardSize();
    this.gameImage = this.image;
    this.start();
  },
  data() {
    return {
      gameImage: "",
      size: {
        horizontal: 3,
        vertical: 3,
      },
    };
  },

  methods: {
    start() {
      this.$emit("gameStart", {
        image: this.gameImage,
        size: this.size,
      });
    },
    getBoardSize() {
      if (this.drag.board_size === "3x3") {
        this.size.horizontal = 3;
        this.size.vertical = 3;
      } else if (this.drag.board_size === "4x4") {
        this.size.horizontal = 4;
        this.size.vertical = 4;
      }
    },

    /**
     * Reset the options.
     */
    reset() {
      this.gameImage = null;
      document.querySelector("#optionsForm").reset();
    },
  },
};
</script>

<style lang="scss" scoped>
img {
  border: 1px solid #ccc;
  margin-bottom: 8px;
}

label[for="file"] {
  color: #368ba0;
  cursor: pointer;
  display: inline-block;
  margin-right: 12px;
}

input[type="number"] {
  height: 24px;
  font-size: 14px;
  border: 1px solid #ccc;
}

button {
  -webkit-appearance: none;
  padding: 6px 12px;
  background: #1ca76a;
  color: #fff;
  border-radius: 3px;
  border: 0;
  font-size: 14px;
  cursor: pointer;
  margin-top: 10px;
}
</style>
