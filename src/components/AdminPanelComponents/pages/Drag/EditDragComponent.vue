<template>
  <div class="drag-wrap">
    <div class="drag-main-header">
      <div class="drag-header">
        <svg
          style="cursor: pointer"
          @click="this.$router.push({ name: 'drag' })"
          data-v-7078eae5=""
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
        >
          <path
            data-v-7078eae5=""
            d="M22.0001 12.0003C22.0001 12.5523 21.5531 13.0003 21.0001 13.0003H5.41413L10.7071 18.2933C11.0981 18.6842 11.0981 19.3163 10.7071 19.7073C10.5121 19.9023 10.2561 20.0003 10.0001 20.0003C9.74407 20.0003 9.48804 19.9023 9.29304 19.7073L2.29401 12.7083C2.20101 12.6153 2.12797 12.5054 2.07697 12.3824C1.97597 12.1384 1.97597 11.8622 2.07697 11.6182C2.12797 11.4952 2.20101 11.3853 2.29401 11.2923L9.29304 4.29325C9.68403 3.90225 10.3161 3.90225 10.7071 4.29325C11.0981 4.68425 11.0981 5.31631 10.7071 5.70731L5.41413 11.0003H21.0001C21.5531 11.0003 22.0001 11.4483 22.0001 12.0003Z"
            fill="#25314C"
          ></path>
        </svg>
        Drag n Match
      </div>
      <div v-if="isPublish" class="campaign-time">
        <div>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="25"
            viewBox="0 0 24 25"
            fill="none"
          >
            <path
              d="M11.99 2.5C6.47 2.5 2 6.98 2 12.5C2 18.02 6.47 22.5 11.99 22.5C17.52 22.5 22 18.02 22 12.5C22 6.98 17.52 2.5 11.99 2.5ZM12 20.5C7.58 20.5 4 16.92 4 12.5C4 8.08 7.58 4.5 12 4.5C16.42 4.5 20 8.08 20 12.5C20 16.92 16.42 20.5 12 20.5ZM11.78 7.5H11.72C11.32 7.5 11 7.82 11 8.22V12.94C11 13.29 11.18 13.62 11.49 13.8L15.64 16.29C15.98 16.49 16.42 16.39 16.62 16.05C16.83 15.71 16.72 15.26 16.37 15.06L12.5 12.76V8.22C12.5 7.82 12.18 7.5 11.78 7.5Z"
              fill="#FF5858"
            />
          </svg>
        </div>
        <div>{{ timeDifference }}</div>
      </div>
    </div>
    <div class="admin-drag-content">
      <div class="drag-image-container">
        <div
          v-if="!thumbnailImageSource && !showImg"
          class="img-upload-section"
        >
          <div class="img-upload-header">
            <div class="img-upload-header-text">Upload Your File</div>
            <div class="img-upload-header-des">File should be .jpg</div>
            <div class="img-upload-header-des">
              Image size W-268 pixels and H- 268 pixels
            </div>
          </div>
          <div class="img-select-container">
            <div class="img-upload-logo">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="48"
                height="48"
                viewBox="0 0 48 48"
                fill="none"
              >
                <g clip-path="url(#clip0_564_4311)">
                  <path
                    d="M48.0008 5.25C48.0008 17.75 48.0008 30.25 48.0008 42.75C47.9758 42.825 47.9258 42.8875 47.9133 42.9625C47.4758 45.4375 45.7133 47.3 43.2758 47.8625C43.1008 47.9 42.9258 47.95 42.7383 48C30.2383 48 17.7383 48 5.23828 48C5.16328 47.975 5.10078 47.9375 5.02578 47.9125C2.53828 47.475 0.688281 45.7125 0.125781 43.275C0.0882813 43.1 0.0382813 42.9125 -0.0117188 42.7375C0.00078125 30.25 0.00078125 17.75 0.00078125 5.25C0.0257813 5.1625 0.0757812 5.075 0.0882813 4.9875C0.575781 2.5625 2.01328 0.9875 4.35078 0.225C4.65078 0.1375 4.95078 0.075 5.25078 0C17.7508 0 30.2508 0 42.7508 0C42.8383 0.025 42.9258 0.075 43.0133 0.0875C44.8383 0.425 46.2633 1.375 47.1633 2.9875C47.5383 3.6875 47.7258 4.4875 48.0008 5.25ZM45.0008 21.9C45.0008 21.575 45.0008 21.4125 45.0008 21.25C45.0008 16.2875 45.0008 11.3125 45.0008 6.35C45.0008 4.2125 43.7883 3 41.6758 3C29.9008 3 18.1258 3 6.33828 3C4.21328 3 3.00078 4.2125 3.00078 6.35C3.00078 18.125 3.00078 29.9 3.00078 41.6875C3.00078 41.825 3.00078 41.975 3.00078 42.1125C3.03828 43.325 3.83828 44.4 4.97578 44.825C5.25078 44.925 5.41328 44.8875 5.61328 44.65C10.7758 38.525 15.9633 32.4125 21.1258 26.3C22.0008 25.275 22.8258 25.225 23.7758 26.175C27.3008 29.7 30.8258 33.225 34.3508 36.75C36.9758 39.375 39.6133 42 42.2258 44.6375C42.4883 44.9125 42.7133 44.95 43.0508 44.8125C43.7258 44.525 44.2383 44.0875 44.6133 43.4625C44.8133 43.125 44.7883 42.9125 44.4883 42.625C39.9258 38.0875 35.3758 33.5375 30.8133 28.9875C30.6883 28.8625 30.4883 28.7875 30.3258 28.6875C33.4383 25.1875 36.4008 21.8375 39.4008 18.4875C40.0133 17.8125 40.9258 17.825 41.6008 18.4875C42.3133 19.1875 43.0133 19.9 43.7258 20.6C44.1258 21 44.5133 21.4 45.0008 21.9Z"
                    fill="#A9B2F8"
                  />
                  <path
                    d="M15.0125 22.5C10.875 22.5 7.5 19.1375 7.5 15C7.5 10.85 10.8625 7.5 15.0125 7.5C19.1375 7.5 22.4875 10.85 22.5 14.975C22.5125 19.1125 19.15 22.4875 15.0125 22.5Z"
                    fill="#A9B2F8"
                  />
                </g>
                <defs>
                  <clipPath id="clip0_564_4311">
                    <rect width="48" height="48" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </div>
            <div class="img-upload-content">
              <div class="img-upload-header-des">Click to Upload File</div>
              <div class="upload-group">
                <label for="fileInput" class="custom-file-label"
                  >Choose File</label
                >
                <input
                  type="file"
                  id="fileInput"
                  class="upload-btn"
                  accept="image/jpeg, image/jpg"
                  v-on:change="handleFileUpload($event)"
                />
              </div>
            </div>
          </div>
        </div>
        <div v-if="!showImgBool" class="remove-img" @click="removeImg">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="32"
            height="32"
            viewBox="0 0 32 32"
            fill="none"
          >
            <path
              d="M12.5802 20.1269L12.5742 20.133L12.5683 20.1393C12.4914 20.2217 12.3658 20.2738 12.2271 20.2738C12.0993 20.2738 11.9753 20.2282 11.874 20.1269C11.6826 19.9355 11.6826 19.6121 11.874 19.4207L19.4207 11.874C19.6121 11.6826 19.9355 11.6826 20.1269 11.874C20.3183 12.0654 20.3183 12.3888 20.1269 12.5802L12.5802 20.1269Z"
              stroke="white"
            />
            <path
              d="M19.7738 20.7738C19.5205 20.7738 19.2671 20.6805 19.0671 20.4805L11.5205 12.9338C11.1338 12.5471 11.1338 11.9071 11.5205 11.5205C11.9071 11.1338 12.5471 11.1338 12.9338 11.5205L20.4805 19.0671C20.8671 19.4538 20.8671 20.0938 20.4805 20.4805C20.2805 20.6805 20.0271 20.7738 19.7738 20.7738Z"
              fill="white"
            />
            <path
              d="M20.0013 30.3346H12.0013C4.7613 30.3346 1.66797 27.2413 1.66797 20.0013V12.0013C1.66797 4.7613 4.7613 1.66797 12.0013 1.66797H20.0013C27.2413 1.66797 30.3346 4.7613 30.3346 12.0013V20.0013C30.3346 27.2413 27.2413 30.3346 20.0013 30.3346ZM12.0013 3.66797C5.85464 3.66797 3.66797 5.85464 3.66797 12.0013V20.0013C3.66797 26.148 5.85464 28.3346 12.0013 28.3346H20.0013C26.148 28.3346 28.3346 26.148 28.3346 20.0013V12.0013C28.3346 5.85464 26.148 3.66797 20.0013 3.66797H12.0013Z"
              fill="white"
            />
          </svg>
        </div>
        <div
          v-if="showImgBool"
          class="remove-img fromApi"
          @click="removeApiImg"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="32"
            height="32"
            viewBox="0 0 32 32"
            fill="none"
          >
            <path
              d="M12.5802 20.1269L12.5742 20.133L12.5683 20.1393C12.4914 20.2217 12.3658 20.2738 12.2271 20.2738C12.0993 20.2738 11.9753 20.2282 11.874 20.1269C11.6826 19.9355 11.6826 19.6121 11.874 19.4207L19.4207 11.874C19.6121 11.6826 19.9355 11.6826 20.1269 11.874C20.3183 12.0654 20.3183 12.3888 20.1269 12.5802L12.5802 20.1269Z"
              stroke="white"
            />
            <path
              d="M19.7738 20.7738C19.5205 20.7738 19.2671 20.6805 19.0671 20.4805L11.5205 12.9338C11.1338 12.5471 11.1338 11.9071 11.5205 11.5205C11.9071 11.1338 12.5471 11.1338 12.9338 11.5205L20.4805 19.0671C20.8671 19.4538 20.8671 20.0938 20.4805 20.4805C20.2805 20.6805 20.0271 20.7738 19.7738 20.7738Z"
              fill="white"
            />
            <path
              d="M20.0013 30.3346H12.0013C4.7613 30.3346 1.66797 27.2413 1.66797 20.0013V12.0013C1.66797 4.7613 4.7613 1.66797 12.0013 1.66797H20.0013C27.2413 1.66797 30.3346 4.7613 30.3346 12.0013V20.0013C30.3346 27.2413 27.2413 30.3346 20.0013 30.3346ZM12.0013 3.66797C5.85464 3.66797 3.66797 5.85464 3.66797 12.0013V20.0013C3.66797 26.148 5.85464 28.3346 12.0013 28.3346H20.0013C26.148 28.3346 28.3346 26.148 28.3346 20.0013V12.0013C28.3346 5.85464 26.148 3.66797 20.0013 3.66797H12.0013Z"
              fill="white"
            />
          </svg>
        </div>
        <img
          v-if="showImg || puzzleImage"
          :src="thumbnailImageSource || showImg"
          alt="img"
          class="show-img"
        />
      </div>

      <div class="input-section-group">
        <div class="grid-container">
          <div class="input-group">
            <label for="">Title</label>
            <input
              type="text"
              placeholder="Campaign Title will be here"
              v-model="drag.title"
            />
          </div>
          <div class="input-group">
            <label for="">Board Size</label>
            <select name="" id="" v-model="drag.board_size">
              <option value="3x3" selected>3 X 3</option>
              <option value="" disabled style="color: #ffce29">
                ─────────────────────────────────────────────
              </option>
              <option value="4x4" disabled>4 X 4</option>
            </select>
          </div>
          <div class="input-group">
            <label for="">Reward Message</label>
            <input type="text" v-model="drag.reward" />
          </div>
          <div class="input-group">
            <label for="">Coupon</label>
            <input type="text" v-model="drag.coupon" />
          </div>

          <div class="input-group">
            <label for="">Time</label>
            <select v-model="drag.campaign_time" disabled>
              <option disabled>Select Campaign Time</option>
              <option value="3 Days">3 Days</option>
              <option value="" disabled style="color: #ffce29">
                ─────────────────────────────────────────────
              </option>
              <option value="6 Hours" disabled>6 Hours</option>
              <option value="12 Hours" disabled>12 Hours</option>
              <option value="24 Hours" disabled>24 Hours</option>
              <option value="7 Days" disabled>7 Days</option>
              <option value="30 Days" disabled>30 Days</option>
            </select>
          </div>
          <div class="input-group">
            <label for="">Popup Timing</label>
            <select v-model="drag.popup_time">
              <option disabled>Select Popup Timing</option>
              <option value="30 seconds">30 seconds</option>
              <option value="" disabled style="color: #ffce29">
                ─────────────────────────────────────────────
              </option>
              <option value="15 seconds" disabled>15 seconds</option>
              <option value="1 Minutes" disabled>1 Minutes</option>
              <option value="5 Minutes" disabled>5 Minutes</option>
              <option value="30 Minutes" disabled>30 Minutes</option>
              <option value="1 Hour" disabled>1 Hour</option>
            </select>
          </div>
          <div class="input-group">
            <label class="">Status</label>

            <select
              v-model="drag.live_status"
              :disabled="temp_live_status == 3"
            >
              <option value="1">
                {{ temp_live_status == "3" ? "Re-Publish" : "Publish" }}
              </option>
              <option value="2">Pending</option>
              <option value="3">Completed</option>
            </select>
          </div>
        </div>
      </div>

      <div class="footer-section">
        <div class="preview-btn" @click="previewCamp">Preview</div>
        <div class="cancel-btn" @click="this.$router.push({ name: 'drag' })">
          Cancel
        </div>
        <div
          class="update-btn"
          @click="checkStatus"
          :style="temp_live_status == 3 ? 'display:none' : ''"
        >
          Update
        </div>
      </div>
    </div>
  </div>
  <Loader v-if="isLoading" />
  <PreviewCampaign
    v-if="isPreview"
    @close="closePreview"
    :imageUrl="previewImageUrl"
  />
</template>

<script>
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Loader from "../../Shared/AdminLoaderComponent.vue";
import PreviewCampaign from "../../Shared/PreviewCampaign.vue";
export default {
  mounted() {
    this.itemId = this.$route.params.id;
    this.SingleDragData();
  },
  data() {
    return {
      previewImageUrl: wpApiSettings.imagePath + "/previewCampaign/drag.png",
      puzzleImage: "",
      isImage: false,
      isLoading: false,
      isPublish: false,
      isPreview: false,
      drag: {},
      showImg: "",
      tempStatus: 0,
      temp_live_status: 0,
      timeDifference: "00d 00h 00m 00s",
      newTimeDifference: "",
      time: "",
      showImgBool: false,
    };
  },
  components: {
    Loader,
    PreviewCampaign,
    //    Slider
  },
  computed: {
    thumbnailImageSource() {
      if (this.puzzleImage) {
        return URL.createObjectURL(this.puzzleImage);
      }
    },
  },
  methods: {
    previewCamp() {
      this.isPreview = true;
    },
    closePreview() {
      this.isPreview = false;
    },
    SingleDragData() {
      this.isLoading = true;
      axios
        .get(
          wpApiSettings.root + "custom/v1/get-drag-quiz-data/" + this.itemId,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.drag = response.data;
          this.tempStatus = response.data.live_status;
          this.temp_live_status = response.data.live_status;
          this.time = response.data.time;
          this.showImg = response.data.image;
          this.showImgBool = true;

          if (this.drag.live_status == 1) {
            this.isLoading = false;
            this.isPublish = true;

            // console.log(this.drag.campaign_time);

            // this.timeDifference = this.calculateTimeDifference();
            setInterval(() => {
              this.timeDifference = this.calculateTimeDifference(
                this.drag.campaign_time
              );
            }, 1000);
          }
          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    handleFileUpload(event) {
      this.puzzleImage = event.target.files[0];
      this.isImage = true;
    },
    removeImg() {
      (this.puzzleImage = ""), (this.isImage = false);
    },
    removeApiImg() {
      this.showImg = "";
      this.showImgBool = false;
    },

    parseCampaignTime(campaignTime) {
      const match = campaignTime.match(/^(\d+)\s+(\w+)$/);
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
          case "day":
          case "days":
            return value * 24 * 60 * 60 * 1000;
          default:
            return 0; // unknown unit
        }
      }
      return 0; // invalid format
    },

    calculateTimeDifference(campaign_time) {
      // Convert this.time to a Date object
      const quizTime = new Date(this.time.replace(" ", "T"));

      // Calculate the total quiz time by adding campaign_time
      const quizEndTime =
        quizTime.getTime() + this.parseCampaignTime(campaign_time);

      // console.log(quizEndTime);

      // Get the current time
      const currentTime = new Date().getTime();

      // Calculate the remaining time in milliseconds
      let remainingTime = quizEndTime - currentTime;

      if (remainingTime <= 0) {
        // Quiz has ended
        return "00d 00h 00m 00s";
      } else {
        // Calculate days, hours, minutes, and seconds
        const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        remainingTime %= 1000 * 60 * 60 * 24;
        const hours = Math.floor(remainingTime / (1000 * 60 * 60));
        remainingTime %= 1000 * 60 * 60;
        const minutes = Math.floor(remainingTime / (1000 * 60));
        remainingTime %= 1000 * 60;
        const seconds = Math.floor(remainingTime / 1000);

        // Format and return the time difference
        return `${this.formatTimeComponent(days)}d ${this.formatTimeComponent(
          hours
        )}h ${this.formatTimeComponent(minutes)}m ${this.formatTimeComponent(
          seconds
        )}s`;
      }
    },

    formatTimeComponent(component) {
      // Helper function to format time components (days, hours, minutes, seconds)
      return component < 10 ? `0${component}` : component;
    },
    checkStatus() {
      this.isLoading = true;
      if (this.drag.live_status == 1) {
        if (this.drag.live_status == this.tempStatus) {
          this.createDrag(this.drag.live_status, this.drag.time);
        } else {
          axios
            .get(wpApiSettings.root + "custom/v1/check-live-status", {
              headers: {
                "X-WP-Nonce": wpApiSettings.nonce,
              },
            })
            .then((response) => {
              if (response.data.success == true) {
                this.isLoading = false;
                toast.error("You have already publish another", {
                  position: toast.POSITION.BOTTOM_RIGHT,
                });
              } else {
                let formattedDate = this.getCurrentTime();
                this.createDrag(this.drag.live_status, formattedDate);
              }
            })
            .catch((error) => {
              this.isLoading = false;
              this.error = "Error fetching data: " + error.message;
            });
        }
      } else {
        this.createDrag(this.drag.live_status, this.drag.time);
      }
    },

    getCurrentTime() {
      var currentDate = new Date();

      var formattedDate = currentDate.toISOString().split("T")[0];
      var formattedTime =
        ("0" + currentDate.getHours()).slice(-2) +
        ":" +
        ("0" + currentDate.getMinutes()).slice(-2) +
        ":" +
        ("0" + currentDate.getSeconds()).slice(-2);

      var currentTime = formattedDate + " " + formattedTime;

      return currentTime;
    },

    createDrag(status, time) {
      this.isLoading = true;
      const superAdminData = {
        board_size: this.drag.board_size,
      };

      if (this.puzzleImage == "") {
        newUploadImage = this.drag.image;
      } else {
        newUploadImage = this.puzzleImage;
      }

      let updateDragData = new FormData();
      updateDragData.append("title", this.drag.title);
      updateDragData.append("board_size", this.drag.board_size);
      updateDragData.append("image", newUploadImage);
      updateDragData.append("reward", this.drag.reward);
      updateDragData.append("coupon", this.drag.coupon);
      updateDragData.append("campaign_time", this.drag.campaign_time);
      updateDragData.append("popup_time", this.drag.popup_time);
      updateDragData.append("live_status", status);
      updateDragData.append("time", time);
      updateDragData.append("link", this.drag.link);

      axios
        .post(
          wpApiSettings.root +
            "custom/v1/update-drag-quiz-data/" +
            this.drag.id,
          updateDragData,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          //   console.log(response);
          this.$router.push({ name: "drag" });
          axios
            .post(base_url + "update_drag/" + this.drag.id, superAdminData)
            .then((response) => {
              this.isLoading = false;
              this.$router.push({ name: "drag" });
            })
            .catch((error) => {
              this.isLoading = false;
              this.error = "Error fetching data: " + error.message;
            });
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
  },
};
</script>

<style scoped>
.preview-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #706aea;
  border-radius: 8px;
  background-color: transparent;
  cursor: pointer;

  color: var(--status-error, #706aea);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}
input {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

select {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.campaign-time {
  display: flex;
  gap: 8px;
  width: 100%;
  max-width: max-content;
}
.remove-img {
  position: absolute;
  left: 17%;
  top: 3%;
  cursor: pointer;
}
.drag-wrap {
  display: flex;
  flex-direction: column;
}
.drag-header {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}
.admin-drag-content {
  position: relative;
  margin-top: 24px;
  display: flex;
  flex-direction: column;
  gap: 40px;
}

.drag-image-container {
  width: 21%;
  height: 268px;
}

select:disabled {
  background-color: #e0e0e0;
  color: #9e9fa7;
}

.img-upload-section {
  background-color: #ffffff;
  padding: 32px 16px;
  border-radius: 12px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);

  display: flex;
  flex-direction: column;
  gap: 32px;
  align-items: center;
}

.img-upload-header {
  display: flex;
  flex-direction: column;
  align-items: center;

  gap: 4px;
}

.img-upload-header-text {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 140%; /* 22.4px */
}

.img-upload-header-des {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  font-family: "Inter", sans-serif;
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 15.6px */
}
.img-select-container {
  width: 80%;
  border: 1px dashed #cad1fb;
  border-radius: 12px;
  display: flex;
  align-items: center;
  padding: 16px;
  flex-direction: column;
  gap: 16px;
}

.img-upload-content {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.img-upload-logo {
  display: flex;
  gap: 16px;
}

.upload-btn {
  display: none;
}

.custom-file-label {
  color: var(--color-primary-color-500, #706aea);
  font-family: "Inter", sans-serif;
  font-size: 12px;
  font-style: normal;
  cursor: pointer;
  font-weight: 600;
  line-height: 130%;
}

.input-group {
  display: flex;
  flex-direction: column;
  max-width: 100%;
  flex: 1;
}

.input-section {
  display: flex;
  width: 100%;
  align-items: center;
  gap: 16px;
}

.input-group label {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.input-group select {
  margin-top: 8px;
  padding: 12px 16px;
  border-radius: 8px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);
  max-width: 100%;
}

.input-group input {
  margin-top: 8px;
  padding: 12px 16px;
  border-radius: 8px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);
}

.footer-section {
  display: flex;
  justify-content: end;
  gap: 8px;
}

.cancel-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #f55151;
  border-radius: 8px;
  background-color: transparent;
  cursor: pointer;

  color: var(--status-error, #f55151);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}

.update-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 8px;
  background-color: #706aea;
  cursor: pointer;

  color: var(--color-natural-50, #fff);

  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}

.show-img {
  height: 100%;
  width: 100%;
  border-radius: 12px;
}
.drag-main-header {
  display: flex;
  justify-content: space-between;
  color: #ff5858;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%;
}

/* dev ayan */

.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr; /* Two columns with equal width */
  gap: 16px;
}
</style>
