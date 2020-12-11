<template>
  <v-app>
    <AppLayout />
    <v-main>
      <v-container class="mt-6">
        <v-alert
          border="top"
          class="mx-2"
          colored-border
          type="info"
          elevation="2"
        >
          List of All Quizzes
        </v-alert>
        <v-row no-gutters>
          <v-col v-for="(data, id) in quizzes" :key="id" cols="12" sm="4">
            <v-card class="mx-auto mb-6" max-width="344">
              <v-card-text>
                <p class="display-1 text--primary">
                  {{ data.name }}
                </p>
                <div class="text--primary">
                  {{ data.description }}
                </div>
                <div class="text--primary mt-6">
                  <span>Duration:</span>
                  {{ data.minutes }}
                </div>
              </v-card-text>
              <v-card-actions>
                <inertia-link :href="route('quiz.edit', data.id)">
                  <v-btn @click="edit(data)" text color="teal white--text">
                    Edit
                  </v-btn>
                </inertia-link>
                <v-btn color="red white--text" @click="reveal = true">
                  Delete
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
  name: "index",
  props: ["quizzes"],
  components: {
    AppLayout,
  },
  methods: {
    edit: function (data) {
      this.form = Object.assign({}, data);
    },
  },
};
</script>