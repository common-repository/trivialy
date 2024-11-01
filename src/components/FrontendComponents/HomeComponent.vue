<template>
  <div>
    <div v-if="isShow" class="front-wrap">
      <div class="blur-background">
        <div class="responsive-popup">
          <div class="front-popup">
            <Scratch
              v-if="isScratch"
              @close="closePopup"
              :scratchId="ids.scratchId"
            />
            <Drag v-if="isDrag" @close="closePopup" :id="ids.dragId" />
            <CustomQuiz
              v-if="isCustomQuiz"
              @close="closePopup"
              :customQuizId="ids.customQuizId"
            />
            <Popup
              v-if="isPopupQuiz"
              @close="closePopup"
              :popupId="ids.popupId"
            />
            <Spin v-if="isSpin" @close="closePopup" :id="ids.spinId" />
            <ImageQuiz
              v-if="isImageQuiz"
              @close="closePopup"
              :imageQuizId="ids.imageQuizId"
            />
            <SuperQuiz
              v-if="isSuperQuiz"
              @close="closePopup"
              :superQuizId="ids.superQuizId"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Drag from "./Drag/DragComponent.vue";
import ImageQuiz from "./ImageQuiz/ImageQuizComponent.vue";
import Popup from "./Popup/PopupComponent.vue";
import CustomQuiz from "./Quiz/QuizComponent.vue";
import Scratch from "./Scratch/ScratchComponent.vue";
import Spin from "./Spin/SpinComponent.vue";
import SuperQuiz from "./SuperQuiz/SuperQuizComponent.vue";

export default {
  mounted() {
    this.fetchDbPrefix();
    this.checkStatus();

    // this.fetchPopup();
  },
  data() {
    return {
      isShow: false,
      isScratch: false, //Complete
      isSpin: false, //Complete
      isDrag: false, //Complete
      isCustomQuiz: false, //Complete
      isPopup: false,
      isPopupVerify: false, //Complete
      isSuperQuiz: false, //Complete
      isImageQuiz: false, //Complete
      isPopupQuiz: false,

      ids: {
        spinId: 0,
        scratchId: 0,
        dragId: 0,
        customQuizId: 0,
        superQuizId: 0,
        imageQuizId: 0,
        popupId: 0,
      },
      popup_time: null,
      check: true,
      checkIsPopupVerify: null,
      dbPrefix: "",
    };
  },
  components: {
    Scratch,
    Drag,
    CustomQuiz,
    Popup,
    Spin,
    ImageQuiz,
    SuperQuiz,
  },
  watch: {
    isShow(newValue) {
      if (newValue == true) {
        let showTime = localStorage.getItem("showTime");
        if (showTime) {
          if (
            (new Date().getTime() - parseInt(showTime)) / 1000 >
            12 * 60 * 60
          ) {
            this.isShow = true;
            const currentTime = new Date().getTime();
            localStorage.setItem("showTime", currentTime);
          } else {
            this.isShow = false;
          }
        } else {
          const currentTime = new Date().getTime();
          localStorage.setItem("showTime", currentTime);
        }
      }
    },
  },
  methods: {
    fetchDbPrefix() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/get-prefix", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          this.dbPrefix = response.data.prefix;
        })
        .catch((error) => {
          // Handle error
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    parsePopupTime(popupTime) {
      const match = popupTime.match(/^(\d+)\s+(\w+)$/);
      if (match) {
        const value = parseInt(match[1]);
        const unit = match[2].toLowerCase();
        switch (unit) {
          case "second":
          case "seconds":
            return value * 1000;
          case "minute":
          case "minutes":
            return value * 60 * 1000;
          case "hour":
          case "hours":
            return value * 60 * 60 * 1000;
          default:
            return 0; // unknown unit
        }
      }
      return 0; // invalid format
    },
    checkStatus() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/check-live-status", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          this.checkIsPopupVerify == response.data.success;

          // console.log(response.data);

          if (response.data.success == true) {
            this.popup_time = this.parsePopupTime(response.data.popup_time);

            if (response.data.table == this.dbPrefix + "spin_quiz") {
              setInterval(() => {
                if (this.isPopup == false) {
                  this.isShow = true;
                  this.ids.spinId = parseInt(response.data.row_id);
                  this.isSpin = true;
                }
              }, this.popup_time);
            } else if (response.data.table == this.dbPrefix + "drag_quiz") {
              setInterval(() => {
                if (this.isPopup == false) {
                  this.isShow = true;
                  this.ids.dragId = parseInt(response.data.row_id);
                  this.isDrag = true;
                }
              }, this.popup_time);
            } else if (response.data.table == this.dbPrefix + "scratch_quiz") {
              setInterval(() => {
                if (this.isPopup == false) {
                  this.isShow = true;
                  this.ids.scratchId = parseInt(response.data.row_id);
                  this.isScratch = true;
                }
              }, this.popup_time);
            } else if (response.data.table == this.dbPrefix + "quiz") {
              setInterval(() => {
                if (this.isPopup == false) {
                  this.isShow = true;
                  this.ids.superQuizId = parseInt(response.data.row_id);
                  this.isSuperQuiz = true;
                }
              }, this.popup_time);
            } else if (response.data.table == this.dbPrefix + "image_quiz") {
              setInterval(() => {
                if (this.isPopup == false) {
                  this.isShow = true;
                  this.ids.imageQuizId = parseInt(response.data.row_id);
                  this.isImageQuiz = true;
                }
              }, this.popup_time);
            } else if (response.data.table == this.dbPrefix + "custom_quiz") {
              setInterval(() => {
                if (this.isPopup == false) {
                  this.isShow = true;
                  this.ids.customQuizId = parseInt(response.data.row_id);
                  this.isCustomQuiz = true;
                }
              }, this.popup_time);
            } else if (response.data.table == this.dbPrefix + "popup_quiz") {
              setInterval(() => {
                if (this.isPopup == false) {
                  // console.log(response.data);
                  this.isShow = true;
                  this.ids.popupId = parseInt(response.data.row_id);
                  this.isPopupQuiz = true;
                }
              }, this.popup_time);
            }
          } else if (response.data.success == false) {
            this.isShow = false;
          }
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },

    closePopup() {
      this.isShow = false;
      if (this.isDrag == true) {
        this.isDrag = false;
      } else if (this.isCustomQuiz == true) {
        this.isCustomQuiz = false;
      } else if (this.isImageQuiz == true) {
        this.isImageQuiz = false;
      } else if (this.isScratch == true) {
        this.isScratch = false;
      } else if (this.isSpin == true) {
        this.isSpin = false;
      } else if (this.isSuperQuiz == true) {
        this.isSuperQuiz = false;
      } else if (this.isPopupQuiz == true) {
        this.isPopupQuiz == false;
      }
    },
    closeUniquePopup() {
      this.isShow = false;
      this.isPopup = false;
      this.isPopupVerify = false;
    },
  },
};
</script>

<style scoped>
.close-btn {
  cursor: pointer;
}

.blur-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background: inherit;
  background: rgba(0, 0, 0, 0.8); /* Adjust the blur amount as needed */
  z-index: 999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 16px;
}

.responsive-popup {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  padding: 20px 0;
}

.front-popup {
  width: 100%;
  max-width: 800px;
  background-color: white;
  border-radius: 28px 24px 24px 28px;
  max-height: 739px;
  display: flex;
  height: 520px;
}

@media screen and (max-width: 767px) {
  .front-popup {
    height: 590px;
    border-radius: 12px;
  }
}
</style>
