<template>
  <div class="drag-wrap">
    <!-- page header -->
    <div class="page-header">
      <svg
        @click="this.$router.push({ name: 'popup' })"
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="25"
        viewBox="0 0 24 25"
        fill="none"
        class="cursor-pointer"
      >
        <path
          d="M18.7912 11.5051H7.62124L12.5012 6.6251C12.8912 6.2351 12.8912 5.5951 12.5012 5.2051C12.1112 4.8151 11.4812 4.8151 11.0912 5.2051L4.50124 11.7951C4.11124 12.1851 4.11124 12.8151 4.50124 13.2051L11.0912 19.7951C11.4812 20.1851 12.1112 20.1851 12.5012 19.7951C12.8912 19.4051 12.8912 18.7751 12.5012 18.3851L7.62124 13.5051H18.7912C19.3412 13.5051 19.7912 13.0551 19.7912 12.5051C19.7912 11.9551 19.3412 11.5051 18.7912 11.5051Z"
          fill="black"
        />
      </svg>
      Popup
    </div>

    <div class="admin-drag-content">
      <div class="popup-form-content">
        <div class="input-container">
          <div class="input-section">
            <div class="input-group">
              <label for="">Title</label>
              <input
                type="text"
                placeholder="Enter Your Title Here"
                v-model="popupData.title"
              />
            </div>
          </div>
          <div class="input-section">
            <div class="input-group">
              <label for="">Description</label>
              <textarea
                class="input-desc"
                name=""
                id=""
                placeholder="Enter Description Text"
                v-model="popupData.description"
              ></textarea>
            </div>
          </div>
          <div class="grid-container">
            <div class="input-group">
              <label for="">Campaign Time</label>
              <select v-model="popupData.campaign_time">
                <option disabled>Select Campaign Time</option>
                <option value="3 Days">3 Days</option>
                <option value="" disabled="disabled" style="color: #ffce29">
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
              <select v-model="popupData.popup_time">
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
          </div>
          <div class="check-section">
            <div class="check-btn-section">
              <div class="button-btn">
                <input
                  type="checkbox"
                  v-model="showButton"
                  @click="toggleCheckbox('button')"
                  style="margin-top: 2px"
                />
                <label for="">Button</label>
              </div>
              <div class="button-btn">
                <input
                  type="checkbox"
                  v-model="showCoupon"
                  @click="toggleCheckbox('coupon')"
                  style="margin-top: 2px"
                />
                <label for="">Coupon</label>
              </div>
            </div>
            <hr />
            <div v-if="showButton" class="input-section">
              <div class="input-group">
                <label for="">Button Title</label>
                <input
                  type="text"
                  placeholder="Enter Button Title"
                  v-model="popupData.button_title"
                />
              </div>
              <div class="input-group">
                <label for="">Button Link</label>
                <input
                  type="text"
                  placeholder="Enter Button Link"
                  v-model="popupData.button_link"
                />
              </div>
            </div>
            <div v-if="showCoupon" class="input-section custom-input-section">
              <div class="input-group">
                <label for="">Coupon</label>
                <input
                  type="text"
                  placeholder="Enter Coupon Code"
                  class="coupon-input"
                  v-model="popupData.coupon_code"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="drag-image-container">
          <div
            v-if="!thumbnailImageSource && !showImg"
            class="img-upload-section"
          >
            <div class="img-upload-header">
              <div class="img-upload-header-text">Upload Your File</div>
              <div class="img-upload-header-des">File should be .jpg</div>
              <div class="img-upload-header-des">
                Image size W-380 pixels and H- 739 pixels
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
          <!-- remove-img -->
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
          <!-- remove-img -->
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
      </div>
      <div class="footer-section">
        <div class="preview-btn" @click="previewCamp">Preview</div>
        <div class="cancel-btn" @click="this.$router.push({ name: 'popup' })">
          Cancel
        </div>
        <div class="create-btn" @click="checkStatus()">Create</div>
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
// import Slider from './ImageSlider/PuzzleComponent.vue';
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { base_url } from "../../../../config.js";
import Loader from "../../Shared/AdminLoaderComponent.vue";
import PreviewCampaign from "../../Shared/PreviewCampaign.vue";

export default {
  mounted() {
    this.fetchUserData();
  },
  data() {
    return {
      previewImageUrl: wpApiSettings.imagePath + "/previewCampaign/popup.png",
      isPreview: false,
      puzzleImage: "",
      popupData: {
        id: "",
        image: "",
        title: "",
        popup_time: "Select Popup Timing",
        campaign_time: "Select Campaign Time",
        description: "",
        button_title: "",
        button_link: "",
        coupon_code: "",
        live_status: "",
      },
      status: 1,
      showPopupData: [],
      isImage: false,
      showButton: true,
      showCoupon: false,
      isLoading: false,
      showImg: "",
      showImgBool: false,
      temp_live_status: 0,
      wp_email: "",
      popupCount: 0,
      popupMainData: [],
    };
  },
  components: {
    Loader,
    PreviewCampaign,
  },
  methods: {
    previewCamp() {
      this.isPreview = true;
    },
    closePreview() {
      this.isPreview = false;
    },
    fetchUserData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/user-data", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // Handle successful response
          this.userData = response.data;
          this.wp_email = response.data.user_email;
          this.fetchAllPopupData();
          //   console.log(this.userData);
          this.isLoading = false;
          // console.log(this.spinData);
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchAllPopupData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/get-all-popup-quiz-data", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // Handle successful response
          this.popupCount = response.data.length;
          this.popupMainData = response.data;

          // console.log(this.spinData);
        })
        .catch((error) => {
          // Handle error

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
    toggleCheckbox(checkboxType) {
      if (checkboxType === "button") {
        this.showButton = !this.showButton;
      } else if (checkboxType === "coupon") {
        this.showCoupon = !this.showCoupon;
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

    checkStatus() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/check-live-status", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          if (response.data.success == true) {
            this.status = 2;
            this.createPopup(this.status);
          } else {
            this.createPopup(this.status);
          }
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },

    createPopup(status) {
      var currentDate = this.getCurrentTime();

      let showButtonValue = 0;
      let showCouponValue = 0;
      let superAdminType = [];

      if (this.showButton == true) {
        showButtonValue = 1;
      } else {
        showButtonValue = 0;
      }

      if (this.showCoupon == true) {
        showCouponValue = 1;
      } else {
        showCouponValue = 0;
      }

      superAdminType.push(showButtonValue);
      superAdminType.push(showCouponValue);

      let superAdminData = new FormData();
      superAdminData.append("image", this.puzzleImage);
      superAdminData.append("title", this.popupData.title);
      superAdminData.append("user", this.userData.user_name);
      superAdminData.append("email", this.userData.user_email);
      superAdminData.append("type", JSON.stringify(superAdminType));
      superAdminData.append("status", status);

      let popupData = new FormData();
      popupData.append("image", this.puzzleImage);
      popupData.append("title", this.popupData.title);
      popupData.append("popup_time", this.popupData.popup_time);
      popupData.append("campaign_time", this.popupData.campaign_time);
      popupData.append("description", this.popupData.description);
      popupData.append("button_title", this.popupData.button_title);
      popupData.append("button_link", this.popupData.button_link);
      popupData.append("coupon_code", this.popupData.coupon_code);
      popupData.append("button_select", showButtonValue);
      popupData.append("coupon_select", showCouponValue);
      popupData.append("live_status", status);
      popupData.append("time", currentDate);

      axios
        .post(
          wpApiSettings.root + "custom/v1/save-popup-quiz-data",
          popupData,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((response) => {
          axios
            .post(base_url + "popup", superAdminData, {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            })
            .then((response) => {
              this.isLoading = false;
              if (this.status == 2) {
                this.$router.push({
                  name: "popup",
                  query: { showPendingToast: true },
                });
              } else {
                this.$router.push({
                  name: "popup",
                });
              }
            })
            .catch((error) => {
              this.isLoading = false;
              toast.error("Fill All Section", {
                position: toast.POSITION.BOTTOM_RIGHT,
              });
              this.error = "Error fetching data: " + error.message;
            });
        })
        .catch((error) => {
          this.isLoading = false;
          toast.error("Please Fill All Section", {
            position: toast.POSITION.BOTTOM_RIGHT,
          });
          this.error = "Error fetching data: " + error.message;
        });
    },

    removeApiImg() {
      this.showImg = "";
      this.showImgBool = false;
    },
  },
  computed: {
    thumbnailImageSource() {
      if (this.puzzleImage) {
        return URL.createObjectURL(this.puzzleImage);
      }
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
.popup-form-content {
  display: flex;
  flex-direction: column-reverse;
  gap: 32px;
}
.coupon-input {
  width: 49%;
}
.custom-input-section {
  margin-top: 24px;
}

hr {
  margin-top: 24px;
  margin-bottom: 24px;
  border: 1px solid #e3e3e3;
}
.check-btn-section {
  display: flex;
  gap: 16px;
}
.button-btn {
  display: flex;
  gap: 4px;
  align-items: center;
}

.button-btn label {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 3 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 140%; /* 22.4px */
}
.check-section {
  padding: 24px;
  border-radius: 12px;
  background-color: #fff;
}
.input-group textarea {
  margin-top: 8px;
  resize: none;
  height: 130px;
  padding: 12px 16px;
  border-radius: 8px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);
}
.input-container {
  display: flex;
  flex-direction: column;
  gap: 16px;
  width: 100%;
}
.remove-img {
  position: absolute;
  right: 5%;
  top: 5%;
  cursor: pointer;
}
.drag-wrap {
  display: flex;
  flex-direction: column;
}
.drag-header {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}
.admin-drag-content {
  position: relative;
  /* margin-top: 24px; */
  display: flex;
  flex-direction: column;
  gap: 32px;
}

.drag-image-container {
  position: relative;
  width: 100%;
  max-width: 268px;
  height: 308px;
}

.img-upload-section {
  width: 100%;
  /* height: 415px; */
  background-color: #ffffff;
  padding: 32px 16px;
  border-radius: 12px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);
  display: flex;
  flex-direction: column;
  justify-content: center;
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
  text-align: center;
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 15.6px */
}
.img-select-container {
  width: 100%;
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

.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr; /* Two columns with equal width */
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

  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.input-group input {
  margin-top: 8px;
  padding: 12px 16px;
  border-radius: 8px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);

  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.input-group textarea {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: Inter;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
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

.create-btn {
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
  width: 100%;
  height: 100%;
  border-radius: 12px;
}
.cursor-pointer {
  cursor: pointer;
}
</style>
