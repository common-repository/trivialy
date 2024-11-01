<template>
  <div class="app-container">
    <div class="content-container">
      <main>
        <router-view></router-view>
      </main>
    </div>
    <Footer />
  </div>
  <div class="terms-page" v-if="!termsApproved">
    <TermsPage @updateTerms="continueAction()" />
  </div>
</template>

<script>
import Footer from "./Navigations/FooterComponent.vue";
import Navbar from "./Navigations/QuizNavbarComponent.vue";
import TermsPage from "./Shared/TermsPage.vue";
export default {
  mounted() {
    this.continueAction();
    this.$router.push({
      name: "quiz",
      query: { quizType: "quiz" },
    });

    // console.log(this.$route);
  },

  data() {
    return {
      campaignData: [],
      campaignEndTime: "",
      termsApproved: false,
      data: {},
    };
  },
  components: {
    Navbar,
    Footer,
    TermsPage,
  },
  watch: {
    termsApproved(newValue) {
      if (newValue == true) {
        this.fetchUserData();
      }
    },
  },
  methods: {
    continueAction() {
      const agreed = localStorage.getItem("agreed");
      // console.log(agreed);
      // You can then perform actions based on the retrieved value
      if (agreed) {
        this.termsApproved = true;
      } else {
        this.termsApproved = false;
      }
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
          // this.checkPacakge(response.data.user_email);
          this.data = {
            wp_user_email: response.data.user_email,
            wp_user_name: response.data.user_name,
          };

          // console.log(data);
        })
        .catch((error) => {
          // Handle error
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
  },
};
</script>

<style scoped>
html,
body,
.app-container {
  height: 100%;
  margin: 0;
}

/* Style for the app container */
.app-container {
  display: flex;
  flex-direction: column;
}

/* Style for the navbar */

/* Style for the content container (sidebar + main content) */

main {
  background-color: #f7f7f7;
  flex-grow: 1;
  padding: 40px;
}
</style>
