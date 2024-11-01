<template>
  <div class="package-wrap">
    <div class="package-header">Upgrade</div>
    <div class="package-card">
      <div class="package-card-half">
        <div class="card-header">Current Package:</div>
        <div class="half-card">
          <div class="card-content">FREE</div>
          <a :href="trivialy_url" target="_blank" class="upgrade-redirect">
            Upgrade
          </a>
        </div>
      </div>
      <div class="package-card-half">
        <div class="card-header">Expiration Date:</div>
        <div class="card-content">Not Required</div>
      </div>
    </div>
    <div class="package-full-card">
      <div class="card-inline-content">
        <div class="card-header">Days Remaining:</div>
        <div class="inline-card-content">0 Days</div>
      </div>
      <hr />
      <div class="card-inline-content">
        <div class="card-header">Auto Renew</div>
        <label class="switch">
          <input type="checkbox" :checked="isRenewActive" />
          <span class="slider round"></span>
        </label>
      </div>
      <hr />
      <div class="card-inline-content">
        <div class="card-header">Billing Address:</div>
        <div class="inline-card-content">Not Required</div>
      </div>
    </div>
  </div>

  <Loader v-if="isLoading" />
</template>

<script>
import "vue3-toastify/dist/index.css";
import { trivialy_upgrade_url } from "../../../config";
import Loader from "../Shared/AdminLoaderComponent.vue";
import Popup from "../Shared/Popup.vue";
export default {
  mounted() {},
  data() {
    return {
      activation_code: "",
      email: "",
      wp_email: "",
      userData: [],
      isPopupVisible: false,
      isLoading: false,
      isActive: false,
      isDeactivePopupVisible: false,
      isRenewActive: false,
      SubscriptionData: {
        packageName: "",
        expireDate: "",
        activationCode: "",
        billingAddress: "",
        status: "",
      },
      trivialy_url: trivialy_upgrade_url,
    };
  },
  components: {
    Popup,
    Loader,
  },
  methods: {
    convertDate(timestamp) {
      const date = new Date(parseInt(timestamp) * 1000); // Convert Unix timestamp to milliseconds
      const options = { year: "numeric", month: "long", day: "numeric" };
      return date.toLocaleDateString("en-US", options);
    },
    redirectToTrivialy() {
      window.location.href = trivialy_upgrade_url;
    },
  },
};
</script>

<style scoped>
.half-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.upgrade-redirect {
  color: var(--color-primary-color-500, #706aea);
  text-align: right;
  /* Text/Body/Body 2 | Bold | Semibold 600 */
  font-family: "Inter";
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 23.4px */
  cursor: pointer;
  box-shadow: none;
}
.package-header {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  font-family: "Inter";
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}
.footer-content {
  margin-top: 28px;
  display: flex;
  gap: 12px;
  position: relative;
}

.footer-content .active-input-key {
  position: absolute;
  left: 14px;
  top: 13px;
}

.active-input {
  border: 1px solid #e3e3e3;
  border-radius: 8px;
  padding-left: 16px;
  /* color: var(--color-text-colors-200-white-low-emp, #9e9fa7); */
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter";
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
  padding-left: 48px;
}
.active-input {
  outline: none; /* This removes the outline */
}
.active-input::placeholder {
  color: #9e9fa7;
}
.upgrade-btn {
  outline: none;
  border: none;
  border-radius: 8px;
  padding: 16px 32px;
  background-color: #33d286;
  cursor: pointer;

  color: var(--color-natural-50, #fff);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter";
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}
.package-wrap {
  display: flex;
  flex-direction: column;
  gap: 28px;
}

.inline-card-content {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  text-align: right;
  /* Text/Body/Body 3 | Bold | Semibold 600 */
  font-family: "Inter";
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 140%; /* 22.4px */
}

hr {
  width: 100%;
  border: 1px solid #e3e3e3;
}

.card-inline-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.package-card {
  display: flex;
  gap: 16px;
  width: 100%;
}

.package-card-half {
  background-color: #ffffff;
  padding: 16px 24px;
  width: 100%;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.card-header {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter";
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.card-content {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 2 | Bold | Semibold 600 */
  font-family: "Inter";
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 23.4px */
}

.package-full-card {
  background-color: #ffffff;
  padding: 16px 24px;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

input:checked + .slider {
  background-color: #706aea;
}

input:focus + .slider {
  box-shadow: 0 0 1px #706aea;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
