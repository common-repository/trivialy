<template>
  <div class="help-wrap">
    <div class="help-header">Need Help?</div>
    <div class="help-box">
      <div>Need help with the plugin? Try any of the following:</div>
      <div>
        For assistance in using the plugin, read our
        <a
          href="https://trivialy.co/documentation"
          target="_blank"
          class="link-color"
          >Documentation</a
        >
      </div>
      <div>
        For support, fill out the form on our
        <a href="https://trivialy.co/contact" target="_blank" class="link-color"
          >Contact Us Page</a
        >
      </div>
    </div>
  </div>
</template>

<style scoped>
.help-wrap {
  margin-top: 32px;
}

.help-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
}

.help-box {
  margin-top: 16px;
  background-color: #ffffff;
  padding: 16px 24px;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  gap: 8px;

  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: Inter;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.link-color {
  color: var(--Color-Status-Info, #54a0ff);
  font-family: Inter;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%;
  text-decoration-line: underline;
}
</style>
