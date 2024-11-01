<template>
  <div v-if="!isLeaderboard" class="l-content">
    <img :src="imagePath + 'drag-banner.jpg'" alt="" />
  </div>
  <div v-if="!isLeaderboard" class="r-content">
    <div class="popup-header">
      <div class="close-btn" @click="closePopup">
        <svg
          width="20"
          height="20"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <g id="close">
            <path
              id="Vector"
              d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z"
              fill="#3A3F57"
            />
          </g>
        </svg>
      </div>
    </div>
    <div v-if="!isPlay" class="popup-body">
      <div class="drag-img">
        <img :src="imagePath + 'DRAG.png'" alt="" width="125" height="125" />
      </div>
      <div class="popup-body-header">
        <div class="body-play-header">Get Ready to play!</div>
        <div class="body-main-header">Drag n Match</div>
        <div class="body-des">
          Get upto 80% off by Dragging and Matching the image given. No time
          limit or no trial limit. Do at your pace to get offers.
        </div>
      </div>
      <div class="popup-footer">
        <button @click="playDrag">Let's Start</button>
      </div>
    </div>
    <Play
      v-if="isPlay"
      :drag="drag"
      :image="image"
      :link="drag.link"
      @leaderboardDataSaved="showLeaderboard"
    />
  </div>
  <DragLeaderBoard
    v-if="isLeaderboard"
    @close="closePopup"
    :leaderboardData="leaderboard"
    :coupon="drag.coupon"
    :link="drag.link"
  />
</template>

<script>
import axios from "axios";
import DragLeaderBoard from "../shared/DragLeaderBoardComponent.vue";
import Play from "./PlayDragComponent.vue";
export default {
  props: {
    id: Number,
  },
  mounted() {
    this.fetchDragQuiz();
  },
  data() {
    return {
      isPlay: false,
      drag: {},
      image: "",
      isLeaderboard: false,
      leaderboard: [],
      link: "",
      imagePath: wpApiSettings.imagePath,
    };
  },

  methods: {
    showLeaderboard(data) {
      this.isLeaderboard = data.createdData.success;
      this.leaderboard = data.createdData.data;
      this.link = data.link;
      // console.log(this.link);
    },
    fetchDragQuiz() {
      axios
        .get(wpApiSettings.root + "custom/v1/get-drag-quiz-data/" + this.id, {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          this.drag = response.data;
          this.image = response.data.image;

          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
          console.log(this.error);
        });
    },

    closePopup() {
      this.$emit("close");
    },
    playDrag() {
      this.isPlay = true;
    },
  },
  components: {
    Play,
    DragLeaderBoard,
  },
};
</script>

<style scoped>
.popup-footer button {
  border: none;
  cursor: pointer;
  padding: 20px 16px;
  width: 200px;
  border-radius: 12px;
  background-color: #706aea;

  color: var(
    --color-text-colors-50-white-high-emp,
    var(--Color-Natural-50, #fff)
  );
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%; /* 22px */
}
.body-des {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);

  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
}
.body-main-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/H1-H6/H4 | Title 2 | Mobile H2 | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 40px;
  font-style: normal;
  font-weight: 700;
  line-height: 110%; /* 44px */
  letter-spacing: -1.6px;
}
.body-play-header {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);

  /* Text/Body/Body 1 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 28px */
}
.popup-body-header {
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.popup-body {
  height: 88%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 40px;
}
.r-content {
  width: 100%;
  padding: 24px;
}
.popup-header {
  display: flex;
  justify-content: end;
}
.close-btn {
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 4px 4px 20px 0px rgba(0, 0, 0, 0.4);
  border-radius: 100px;
  padding: 6px;
  cursor: pointer;
}
.l-content img {
  width: 210px;
  border-radius: 24px 0 0 24px;
  object-fit: cover;
}

.l-content img {
  border-radius: 24px 0 0 24px;
  object-fit: cover;
  width: 210px;
}

@media screen and (max-width: 1023px) {
  .l-content img {
    width: 190px;
  }
}

@media screen and (max-width: 767px) {
  .l-content {
    display: none;
  }

  .r-content {
    padding: 40px 16px;
  }

  .popup-body {
    align-items: center;
  }

  .body-play-header {
    font-size: 16px;
    line-height: 140%;
    text-align: center;
    text-transform: none;
  }

  .body-main-header {
    font-size: 24px;
    font-weight: 700;
    line-height: 120%;
    text-align: center;
  }

  .body-des {
    text-align: center;
    font-size: 14px;
    line-height: 130%;
  }

  .drag-img img {
    height: 120px;
    width: 120px;
  }

  .popup-footer button {
    padding: 16px 20px;
    font-size: 16px;
    line-height: 140%; /* 22.4px */
  }
}
</style>
