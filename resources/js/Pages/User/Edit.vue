<template>
  <v-app>
    <AppLayout />
    <v-main>
      <div v-if="$page.flash.message" class="text-center">
        <v-snackbar v-model="snackbar" :multi-line="multiLine" top>
          <p class="text-sm">{{ $page.flash.message }}</p>

          <template v-slot:action="{ attrs }">
            <v-btn color="red" text v-bind="attrs" @click="snackbar = false">
              Close
            </v-btn>
          </template>
        </v-snackbar>
      </div>
      <v-container>
        <v-btn
          fixed
          right
          @click="confirmationDialog = true"
          color="red white--text"
        >
          Delete
        </v-btn>
        <v-flex xs12 sm12 md12 lg9 class="mt-6">
          <div class="mt-6 mr-lg-12">
            <p class="display-1 font-weight-bold">
              {{ oneUser.name
              }}<span
                ><v-icon
                  class="ml-6"
                  @click="dialog = true"
                  color="primary_dark"
                  >mdi-pencil</v-icon
                ></span
              >
            </p>
          </div>
        </v-flex>
        <v-card max-width="600" class="mt-6">
            <v-card-title>Email: {{oneUser.email}}</v-card-title>
            <v-card-text>Password: {{oneUser.password}}</v-card-text>
            <v-card-text>Occupation: {{oneUser.occupation}}</v-card-text>
            <v-card-text>Address: {{oneUser.address}}</v-card-text>
            <v-card-text>Phone: {{oneUser.phone}}</v-card-text>
        </v-card>
        <v-row justify="center">
          <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
              <v-card-title>User </v-card-title>
              <v-card-text>
                <v-container>
                  <v-form
                    ref="form"
                    class="mt-6"
                    v-model="valid"
                    lazy-validation
                  >
                    <v-text-field
                      v-model="form.name"
                      :rules="questionRules"
                      label="Name"
                      required
                      filled
                    ></v-text-field>
                    <v-text-field
                      v-model="form.email"
                      :rules="nameRules"
                      label="Enter Email"
                      required
                      filled
                    ></v-text-field>
                    <v-text-field
                      v-model="form.password"
                      :rules="nameRules"
                      label="Enter password"
                      required
                      filled
                    ></v-text-field>
                    <v-text-field
                      v-model="form.occupation"
                      :rules="nameRules"
                      label="Enter Occupation"
                      required
                      filled
                    ></v-text-field>
                    <v-text-field
                      v-model="form.address"
                      :rules="nameRules"
                      label="Enter Address"
                      required
                      filled
                    ></v-text-field>
                    <v-text-field
                      v-model="form.phone"
                      :rules="nameRules"
                      label="Enter Phone"
                      required
                      filled
                    ></v-text-field>
                  </v-form>
                </v-container>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialog = false">
                  Close
                </v-btn>
                <v-btn color="blue darken-1" text @click="update">
                  Update
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
        <v-row justify="center">
          <v-dialog v-model="confirmationDialog" persistent max-width="600px">
            <v-card>
              <v-card-title> Delete this Quiz </v-card-title>
              <v-card-text>
                <p>
                  This action will remove definitively
                  <b>{{ oneUser.name }}</b> user
                </p>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="confirmationDialog = false"
                >
                  Close
                </v-btn>
                <v-btn
                  color="red"
                  class="white--text"
                  @click="destroy(oneUser)"
                >
                  Delete
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
  name: "edit",
  components: {
    AppLayout,
  },
  props: ["oneUser"],
  remember: "form",
  data() {
    return {
      dialog: false,
      confirmationDialog: false,
      valid: true,
      sending: false,
      multiLine: true,
      snackbar: true,
      form: {
        name: this.oneUser.name,
        email: this.oneUser.email,
        password: this.oneUser.password,
        occupation: this.oneUser.occupation,
        address: this.oneUser.address,
        phone: this.oneUser.phone,
      },
      questionRules: [(v) => !!v || "Question is required"],
      nameRules: [(v) => !!v || "Option is required"],
    };
  },
  methods: {
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    update: function () {
      if (this.$refs.form.validate()) {
        this.$inertia.put(this.route("user.update", this.oneUser.id), this.form, {
          onStart: () => (this.sending = true),
          onFinish: () => (this.sending = false),
        });
      }
      this.dialog = false;
    },
    destroy(oneUser) {
      oneUser._method = "DELETE";
      this.$inertia.post("/user/" + this.oneUser.id, oneUser);
      this.confirmationDialog = false;
    },
  },
};
</script>
