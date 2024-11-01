<template>
  <div class="general-wrap">
    <div class="general-card">
      <div class="card-text-section">
        <div class="card-header">Email Notification (Upcoming)</div>
        <div class="card-description">
          Email notifications for quiz completion or other events
        </div>
      </div>
      <div class="card-input-section">
        <label class="switch">
          <input type="checkbox" />
          <span class="slider round"></span>
        </label>
      </div>
    </div>
    <div class="general-card">
      <div class="card-text-section">
        <div class="card-header">Reminders (Upcoming)</div>
        <div class="card-description">
          Automatic reminders for upcoming quizzes
        </div>
      </div>
      <div class="card-input-section">
        <label class="switch">
          <input type="checkbox" />
          <span class="slider round"></span>
        </label>
      </div>
    </div>
  </div>
</template>

<style scoped>
.general-wrap {
  margin-top: 28px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.card-text-section {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.general-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #ffffff;
  padding: 24px;
  border-radius: 12px;
}

.card-header {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  font-family: "Inter";
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 140%; /* 28px */
}

.card-description {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter";
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
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
