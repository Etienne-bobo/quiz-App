<template>
    <div>
      <v-app-bar app color="success" dark elevation="0">
        <v-app-bar-nav-icon
          @click.stop="sidebarMenu = !sidebarMenu"
        ></v-app-bar-nav-icon>
        <v-spacer></v-spacer>
        <div class="sm:flex sm:items-center sm:ml-6">
          <div class="ml-3 relative text-black">
            <jet-dropdown align="right" width="48">
              <template #trigger>
                <button
                  v-if="$page.jetstream.managesProfilePhotos"
                  class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out"
                >
                  <img
                    class="h-8 w-8 rounded-full object-cover"
                    :src="$page.user.profile_photo_url"
                    :alt="$page.user.name"
                  />
                </button>

                <button
                  v-else
                  class="flex items-center text-sm font-medium text-white hover:text-gray-700 hover:border-gray-300 transition duration-150 ease-in-out"
                >
                  <div>{{ $page.user.name }}</div>

                  <div class="ml-1">
                    <svg
                      class="fill-current h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </div>
                </button>
              </template>

              <template #content>
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                  Manage Account
                </div>

                <jet-dropdown-link :href="route('profile.show')">
                  <span class="text-black">Profile</span>
                </jet-dropdown-link>
                <div class="border-t border-gray-100"></div>
                <!-- Authentication -->
                <form @submit.prevent="logout" class="text-blue">
                  <jet-dropdown-link as="button"> Logout </jet-dropdown-link>
                </form>
              </template>
            </jet-dropdown>
          </div>
        </div>
      </v-app-bar>
      <v-navigation-drawer
        class="textAlign"
        v-model="sidebarMenu"
        app
        floating
        :permanent="sidebarMenu"
        :mini-variant.sync="mini"
      >
        <v-list dense color="success" dark>
          <v-list-item>
            <v-list-item-action>
              <v-icon @click.stop="sidebarMenu = !sidebarMenu"
                >mdi-chevron-left</v-icon
              >
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                <h3 class="font-weight-thin">QuiZy</h3>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
        <v-list-item class="px-2 py-2" @click="toggleMini = !toggleMini">
          <v-badge
            bordered
            bottom
            color="success"
            dot
            offset-x="10"
            offset-y="10"
          >
            <v-avatar size="40">
              <span v-if="$page.jetstream.managesProfilePhotos">
                <img
                  :src="$page.user.profile_photo_url"
                  :alt="$page.user.name"
                />
              </span>
            </v-avatar>
          </v-badge>
          <v-list-item-content class="text-truncate px-4">
            <div>{{ $page.user.name }}</div>
          </v-list-item-content>
          <v-btn icon small>
            <v-icon>mdi-chevron-left</v-icon>
          </v-btn>
        </v-list-item>
        <v-divider></v-divider>
        <v-list>
          <v-list-item-group v-model="status" color="success">
            <v-list-item v-for="(item, i) in items" :key="i" :href="item.path" >
              <v-list-item-icon>
                <v-icon v-text="item.icon"></v-icon>
              </v-list-item-icon>
              <v-list-item-content >
                <v-list-item-title v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
        <v-btn
          @click="toggleTheme"
          color="success"
          class="mr-2 push_bottom my-6 ml-16 py-5"
          >{{ buttonText }}</v-btn
        >
      </v-navigation-drawer>
    </div>
</template>

<script>
import JetDropdown from "../Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";

export default {
  name: "Dashboard",
  components: {
    JetDropdown,
    JetDropdownLink,
  },
  computed: {
    mini() {
      return this.$vuetify.breakpoint.smAndDown || this.toggleMini;
    },
    buttonText() {
      return !this.$vuetify.theme.dark ? "Go dark" : "Go light";
    },
  },
  data: () => ({
    sidebarMenu: true,
    toggleMini: false,
    items: [
      {
        icon: "mdi-google-analytics",
        title: "Dashboard",
        path: route('dashboard'),
      },
      {
        icon: "mdi-pharmacy",
        title: "Quiz",
        path: route('quiz.index'),
      },
      {
        icon: "mdi-hospital-box",
        title: "Questions",
        path: route('question.index'),
      },
      {
        icon: "mdi-hospital-box",
        title: "Users",
        path: route('user.index'),
      },
      {
        icon: "mdi-hospital-box",
        title: "Assign Quiz",
        path: route('exam.index'),
      },
    ],
    status: 1,
  }),
  methods: {
    toggleTheme() {
      this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
    },
    logout() {
      axios.post(route("logout").url()).then((response) => {
        window.location = "/";
      });
    },
  },
};
</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition-property: opacity;
  transition-duration: 0.25s;
}
.fade-enter-active {
  transition-delay: 0.25s;
}
.fade-enter,
.fade-leave-active {
  opacity: 0;
}
.theme--light.v-application ::-webkit-scrollbar {
  width: 13px;
}
.theme--light.v-application ::-webkit-scrollbar-track {
  background: #e6e6e6;
  border-left: 1px solid #dadada;
}
.theme--light.v-application ::-webkit-scrollbar-thumb {
  background: #b0b0b0;
  border: solid 3px #e6e6e6;
  border-radius: 7px;
}
.theme--light.v-application ::-webkit-scrollbar-thumb:hover {
  background: black;
}
.theme--dark.v-application ::-webkit-scrollbar {
  width: 13px;
}
.theme--dark.v-application ::-webkit-scrollbar-track {
  background: #202020;
  border-left: 1px solid #2c2c2c;
}
.theme--dark.v-application ::-webkit-scrollbar-thumb {
  background: #3e3e3e;
  border: solid 3px #202020;
  border-radius: 7px;
}
.theme--dark.v-application ::-webkit-scrollbar-thumb:hover {
  background: white;
}
.push_bottom {
  position: absolute;
  bottom: 0px;
}
.textAlign {
  text-align: left;
}
</style>