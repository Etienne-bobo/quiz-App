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
        <v-card-text
          class="px-8"
          v-for="(question, id) in quizQuestions"
          :key="id"
        >
          <div v-if="id === questionIndex">
            <p class="text-2xl mb-8 text--primary">
              {{id+1}} : {{ question.question }}
            </p>
            <v-text-field
              v-for="choice in question.answers"
              :key="choice"
              v-model="choice.answer"
              label="Solo"
              height="50"
              solo
              readonly
              rounded
            >
              <template v-slot:prepend-inner>
                <v-radio-group v-model="userResponses[id]">
                  <v-radio
                    :value="choice.is_correct == true ? true : choice.answer"
                    name="id"
                    @click="choices(question.id, choice.id)"
                  ></v-radio>
                </v-radio-group>
              </template>
            </v-text-field>
          </div>
        </v-card-text>

        <div class="mb-16 px-6" v-if="questionIndex != quizQuestions.length">
          <v-btn v-if="questionIndex > 0" text color="secondary" class="ml-2 float-left" @click="prev">
            <v-icon>mdi-rewind</v-icon>
            previous
          </v-btn>
          <v-btn
            text
            color="primary"
            class="ml-2 white--text float-right"
            @click="postUserChoices"
          >
            Next
            <v-icon>mdi-fast-forward</v-icon>
          </v-btn>
        </div>
        <v-card-actions v-if="questionIndex === quizQuestions.length">
          <p>{{ score() }}/{{ quizQuestions.length }}</p>
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
      radioGroup: 0,
      questionIndex: 0,
      userResponses: Array(this.quizQuestions.length).fill(false),
      currentQuestion: 0,
      currentAnswer: 0,
    };
  },

  methods: {
    prev() {
      this.questionIndex--;
    },
    choices(question, answer) {
      (this.currentAnswer = answer), (this.currentQuestion = question);
    },
    score() {
      return this.userResponses.filter((val) => {
        return val === true;
      }).length;
    },
    postUserChoices(){
      this.questionIndex++;
      this.$inertia.post("/quiz/create", {
        answerId: this.currentAnswer,
        questionId: this.currentQuestion,
        quizId: this.quiz.id
      });
    }
  },
};
</script>
<style scoped>
</style>