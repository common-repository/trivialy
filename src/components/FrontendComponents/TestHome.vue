<template>
  <div>
    <div class="front-wrap">
      <div class="blur-background">
        <div class="responsive-popup">
          <div class="front-popup">
            <Quiz v-if="isQuiz" />
            <Spin v-if="isSpin" />
            <Drag v-if="isDrag" />
            <Popup v-if="isPopup" />
            <Scratch v-if="isScratch" />
          </div>
        </div>
      </div>
    </div>
    <!-- Your main content goes here -->
  </div>
</template>

<script>
import Spin from "./Spin/SpinComponent.vue";
import Quiz from "./Quiz/QuizComponent.vue";
import Drag from "./Drag/DragComponent.vue";
import Popup from "./Popup/PopupComponent.vue";
import Scratch from "./Scratch/ScratchComponent.vue";

export default {
  data() {
    return {
      isQuiz: false,
      isSpin: true,
      isDrag: false,
      isPopup: false,
      isScratch: false,
    };
  },
  components: {
    Spin,
    Quiz,
    Drag,
    Popup,
    Scratch,
  },
  methods: {},
};
</script>

<style scoped>
.blur-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: inherit;
  background: rgba(0, 0, 0, 0.8); /* Adjust the blur amount as needed */
}

.responsive-popup {
  margin: 120px 203px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.front-popup {
  width: 100vw;
  max-width: 1035px;
  background-color: white;
  border-radius: 24px;
  max-height: 739px;
  height: auto;
  display: flex;
}
</style>
