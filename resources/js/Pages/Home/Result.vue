<template>
  <v-app>
    <navBar />
    <v-main>
      <v-card
        v-if="results.length != 0"
        class="mx-auto mb-6 mt-6"
        max-width="600"
      >
        <div class="pt-4 pb-16">
          <v-card-title class="uppercase"></v-card-title>
          <div class="font-semibold text-lg text-center">Your Result</div>
          <br />
          <div class="mx-6">
            Score: <b>{{ userCorrectedAnswer }}/{{ totalQuestions }} </b>
          </div>
        </div>
        <v-divider></v-divider>
        <v-card-text
          class="px-8 mb-8"
          v-for="(result, id) in results"
          :key="id"
        >
          <div class="text-md mb-6">
            {{ id + 1 }} - {{ result.question.question }}
          </div>
          <div v-for="ans in answers" :key="ans">
            <v-text-field
              v-if="ans.question_id == result.question_id"
              v-model="ans.answer"
              label="Solo"
              height="50"
              class="text-sm"
              solo
              readonly
              rounded
            >
              <template v-slot:prepend-inner>
                <v-icon v-if="ans.is_correct == 1" dark color="success">
                  mdi-check-circle
                </v-icon>
              </template>
            </v-text-field>
          </div>
          <div class="float-left">
            <span class="font-semibold text-md"> Your answer:</span>
            <v-btn color="orange lighten-1" class="ml-2" text>
              {{ result.answer.answer }}</v-btn
            >
          </div>
          <div v-for="ans in answers" :key="ans">
            <div v-if="result.answer_id == ans.id && ans.is_correct == 1">
              <v-btn color="success lighten-2"> correct </v-btn>
            </div>
          </div>
        </v-card-text>
      </v-card>
      <v-card class="mx-auto mb-6 mt-6 text-center" max-width="600" v-else>
        <v-card-text> No result to display</v-card-text>
        <inertia-link :href="route('home')">
          <v-btn class="my-6" color="primary">Go home</v-btn>
        </inertia-link>
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
import navBar from "./Navbar";
export default {
  name: "attemptQuiz",
  components: { navBar },
  props: ["results", "answers", "totalQuestions", "userCorrectedAnswer"],
  data() {
    return {};
  },

  methods: {},
};
</script>
<style scoped>
</style>