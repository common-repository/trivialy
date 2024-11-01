<template>
  <div class="board" v-if="!isWinner">
    <div class="drag-header">Drag n Match</div>
    <div class="play-board">
      <div class="frame-wrapper" :style="frameSize">
        <div v-if="valid" class="win">
          <p>You Win!</p>
          <p>Please Wait</p>
        </div>
        <div
          class="original"
          v-if="showingOriginal && image"
          @click="showingOriginal = false"
          :style="{ background: `url(${image})` }"
        ></div>
        <div class="frame" :style="frameSize">
          <Tile
            v-for="tile in tiles"
            :key="tile.position"
            :tile="tile"
            @moving="moveTile"
            ref="tiles"
          />
        </div>
      </div>
    </div>

    <div class="controls">
      <a class="toggle-original" href="#" @click.prevent="showOriginalImage">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="37"
          height="37"
          viewBox="0 0 37 37"
          fill="none"
        >
          <path
            d="M23.87 18.4999C23.87 21.4699 21.47 23.8699 18.5 23.8699C15.53 23.8699 13.13 21.4699 13.13 18.4999C13.13 15.5299 15.53 13.1299 18.5 13.1299C21.47 13.1299 23.87 15.5299 23.87 18.4999Z"
            stroke="#706AEA"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M18.5 30.9051C23.795 30.9051 28.73 27.7851 32.165 22.3851C33.515 20.2701 33.515 16.7151 32.165 14.6001C28.73 9.20008 23.795 6.08008 18.5 6.08008C13.205 6.08008 8.27 9.20008 4.835 14.6001C3.485 16.7151 3.485 20.2701 4.835 22.3851C8.27 27.7851 13.205 30.9051 18.5 30.9051Z"
            stroke="#706AEA"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </a>
      <div href="#" class="timer">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="30"
          height="31"
          viewBox="0 0 30 31"
          fill="none"
        >
          <path
            d="M15 6.3125C9.025 6.3125 4.1625 11.175 4.1625 17.15C4.1625 23.125 9.025 28 15 28C20.975 28 25.8375 23.1375 25.8375 17.1625C25.8375 11.1875 20.975 6.3125 15 6.3125ZM15.9375 16.75C15.9375 17.2625 15.5125 17.6875 15 17.6875C14.4875 17.6875 14.0625 17.2625 14.0625 16.75V10.5C14.0625 9.9875 14.4875 9.5625 15 9.5625C15.5125 9.5625 15.9375 9.9875 15.9375 10.5V16.75Z"
            fill="#706AEA"
          />
          <path
            d="M18.6125 4.8125H11.3875C10.8875 4.8125 10.4875 4.4125 10.4875 3.9125C10.4875 3.4125 10.8875 3 11.3875 3H18.6125C19.1125 3 19.5125 3.4 19.5125 3.9C19.5125 4.4 19.1125 4.8125 18.6125 4.8125Z"
            fill="#706AEA"
          />
        </svg>
        <div class="time">{{ formattedTime }}</div>
      </div>
      <a class="shuffle" href="#" @click.prevent="shuffleTiles">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="37"
          height="37"
          viewBox="0 0 37 37"
          fill="none"
        >
          <path
            d="M22.8346 8.1157C21.5296 7.7257 20.0896 7.4707 18.4996 7.4707C11.3146 7.4707 5.49458 13.2907 5.49458 20.4757C5.49458 27.6757 11.3146 33.4957 18.4996 33.4957C25.6846 33.4957 31.5046 27.6757 31.5046 20.4907C31.5046 17.8207 30.6946 15.3307 29.3146 13.2607"
            stroke="#706AEA"
            stroke-width="2.25"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M24.6947 8.47512L20.3597 3.49512"
            stroke="#706AEA"
            stroke-width="2.25"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M24.6947 8.47559L19.6397 12.1656"
            stroke="#706AEA"
            stroke-width="2.25"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </a>
    </div>
  </div>
  <Winner
    v-if="isWinner"
    :link="link"
    :drag="drag"
    :message="drag.reward"
    :timer="elapsedTime"
    @leaderboardDataSaved="showLeaderboard"
  />
</template>

<script>
import sample from "lodash.sample";
import Tile from "./Tile.vue";
import Winner from "../../shared/WinnerWithLeaderboard.vue";

let backupTiles = null;

export default {
  props: {
    drag: {
      type: Object,
      required: true,
    },
    link: String,
  },
  components: { Tile, Winner },
  mounted() {
    this.shuffleTiles();
    this.beforeDestroy();
    this.startTimer();
  },
  data() {
    return {
      image: null,
      showingOriginal: false,
      size: {
        horizontal: 0,
        vertical: 0,
      },
      tiles: [],
      tileSize: {
        width: 0,
        height: 0,
      },
      elapsedTime: 0,
      paused: false,
      isWinner: false,
    };
  },

  computed: {
    formattedTime() {
      const minutes = Math.floor(this.elapsedTime / 60);
      const seconds = this.elapsedTime % 60;
      return `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
    },
    frameSize() {
      return {
        width: `${this.tileSize.width * this.size.horizontal}px`,
        height: `${this.tileSize.height * this.size.vertical}px`,
      };
    },

    /**
     * The total number of tiles in the current board.
     * @return {Number}
     */
    totalTiles() {
      return this.size.horizontal * this.size.vertical;
    },

    /**
     * Determine if the current board is valid (solved).
     * @return {boolean}
     */
    valid() {
      if (!this.tiles.length) {
        return false;
      }

      for (let i = 0; i < this.totalTiles; ++i) {
        if (this.tiles[i].styles.order !== this.tiles[i].position) {
          return false;
        }
      }
      this.pauseTimer();
      if (this.isWinner == false) {
        this.showWinner();
      }
      return true;
    },
  },

  methods: {
    showLeaderboard(data) {
      this.$emit("leaderboardDataSaved", data);
      this.$emit("link", this.link);
    },

    showWinner() {
      setTimeout(() => {
        this.isWinner = true;
      }, 2000);
    },
    showOriginalImage() {
      this.showingOriginal = true;

      setTimeout(() => {
        this.showingOriginal = false;
      }, 1000);
    },
    startTimer() {
      this.timerInterval = setInterval(() => {
        if (!this.paused) {
          this.elapsedTime += 1;
        }
      }, 1000); // Update elapsed time every 1000 milliseconds (1 second)
    },
    start({ image, size }) {
      this.size = size;
      this.image = image;
      // detect the width and height of the frame
      const img = new Image();
      img.onload = () => {
        this.tileSize.width = Math.floor(img.width / size.horizontal);
        this.tileSize.height = Math.floor(img.height / size.vertical);
        this.generateTiles();
        this.shuffleTiles();
      };
      img.src = image;
    },
    beforeDestroy() {
      // Clear the timer interval when the component is destroyed to avoid memory leaks
      clearInterval(this.timerInterval);
    },

    /**
     * Generate the tiles for the current game.
     */
    generateTiles() {
      this.tiles = [];
      for (let i = 0; i < this.totalTiles; ++i) {
        this.tiles.push({
          styles: {
            background: i === 0 ? "transparent" : `url(${this.image})`,
            backgroundPositionX: `-${
              (i % this.size.horizontal) * this.tileSize.width
            }px`,
            backgroundPositionY: `-${
              Math.floor(i / this.size.horizontal) * this.tileSize.height
            }px`,
            width: `${this.tileSize.width}px`,
            height: `${this.tileSize.height}px`,
            order: i,
          },
          position: i,
          isEmpty: i === 0,
        });
      }
    },

    pauseTimer() {
      this.paused = true;
    },

    /**
     * Shuffle the generated tiles.
     */
    shuffleTiles() {
      // To make sure the puzzle is solvable, we execute a series of random moves
      for (let i = 0, j = this.totalTiles * 5; i < j; ++i) {
        const emptyTile = this.tiles.find((t) => t.isEmpty);
        const movableTiles = this.tiles.filter((t) => {
          return this.getAdjacentOrders(emptyTile).indexOf(t.styles.order) > -1;
        });
        this.switchTiles(emptyTile, sample(movableTiles));
      }

      // Make a backup for later reset
      backupTiles = JSON.stringify(this.tiles);
    },

    /**
     * Move a (movable) tile
     * @param  {Object} tile
     */
    moveTile(tile) {
      if (tile.isEmpty) {
        return;
      }

      // Find the 4 direct (non-diagonal) adjacent tiles and see if any of them is the empty tile
      const target = this.tiles.find((t) => {
        return (
          t.isEmpty && this.getAdjacentOrders(tile).indexOf(t.styles.order) > -1
        );
      });

      // If found the empty tile, just switch the flex order and we're good.
      target && this.switchTiles(target, tile);
    },

    /**
     * Switch two tiles.
     * @param  {Object} a First tile
     * @param  {Object} b Second tile
     */
    switchTiles(a, b) {
      [a.styles.order, b.styles.order] = [b.styles.order, a.styles.order];
    },

    /**
     * Get the four direct (non-diagonal) adjacent tiles' orders of a tile.
     * @param  {Object} tile
     * @return {Array.<Number>}
     */
    getAdjacentOrders(tile) {
      const pos = tile.styles.order;
      return [
        pos % this.size.horizontal ? pos - 1 : null,
        (pos + 1) % this.size.horizontal ? pos + 1 : null,
        pos - this.size.horizontal,
        pos + this.size.horizontal,
      ];
    },

    /**
     * Reset the board.
     */
    reset() {
      this.tiles = JSON.parse(backupTiles);
    },

    /**
     * Restart the game.
     */
    restart() {
      this.$emit("restart");
    },
  },
};
</script>

<style scoped>
.drag-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  text-align: center;
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 44px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%; /* 48.4px */
}
.time {
  color: var(--Color-Primary-Color-500, #706aea);
  text-align: center;
  font-family: "Inter", sans-serif;
  font-size: 28px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 36.4px */
}
.timer {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 6px;
}
.play-board {
  margin-top: 40px;
  border: 1px solid #8789f2;
  padding: 16px;
  border-radius: 16px;
  background-color: #eff1fe;
}
.frame-wrapper {
  margin: 0 auto;
  position: relative;
  .original {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
  }

  div.win {
    display: flex;
    flex-direction: column;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    font-size: 34px;
    margin: 0 0;
    background: rgb(135, 196, 70);
    text-transform: uppercase;
  }
}

.frame {
  display: flex;
  flex-wrap: wrap;
  background-color: #eff1fe;
  background-size: cover;
}

.controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 24px;
}

@media screen and (max-width: 767px) {
  .drag-header {
    font-size: 24px;
    font-weight: 700;
    line-height: 120%;
  }
}
</style>
