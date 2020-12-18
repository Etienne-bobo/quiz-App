<template>
  <v-app>
    <navBar />
    <v-main>
      <v-card class="mx-auto mb-6 mt-6 text-center" max-width="600">
        <div class="pt-4 pb-16">
          <v-card-title class="uppercase">{{ quiz.name }}</v-card-title>
          <span class="font-semibold text-lg">Online Examination</span>
          <span>{{ questionIndex }}/{{ quizQuestions.length }} </span>
        </div>
        <v-divider></v-divider>
        <v-card-text class="px-8" v-for="(question, id) in quizQuestions" :key="id">
          <div v-if="id === questionIndex">
            <p class="text-2xl mb-8 text--primary">
              {{ question.question }}
            </p>
            <v-text-field
              v-for="(choice, id) in question.answers"
              :key="id"
              :value="choice.answer"
              label="Solo"
              height="50"
              solo
              readonly
              rounded
            >
              <template v-slot:prepend-inner>
                <v-radio-group v-model="radioGroup">
                  <v-radio     
                    :key="id"
                    :value="id"
                  ></v-radio>
                </v-radio-group>
              </template>
            </v-text-field>
          </div>
        </v-card-text>
      
        <div class="mb-16 px-6" v-if="questionIndex != quizQuestions.length">
          <v-btn text color="secondary" class="ml-2 float-left" @click="prev">
            previous
          </v-btn>

          <v-btn
            text
            color="primary"
            class="ml-2 white--text float-right"
            @click="next"
          >
            Next
          </v-btn>
        </div>
         <v-card-actions v-if="questionIndex === quizQuestions.length">
          <p>you</p>
        </v-card-actions>
      </v-card>
    </v-main>
  </v-app>
</template>

<script>
import navBar from "./Navbar";
export default {
  name: "attemptQuiz",
  components: { navBar },
  props: ["quizQuestions", "quiz", "time", "authUserHasPlayedQuiz"],
  data() {
    return {
      questionIndex: 0,
    };
  },

  methods: {
    next() {
      this.questionIndex++;
    },
    prev() {
      this.questionIndex--;
    },
  },
};
</script>
<style scoped>
</style>