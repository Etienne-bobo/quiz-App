<template>
  <v-app>
    <app-layout />
    <v-main>
      <v-container>
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profile
          </h2>
        </template>

        <div>
          <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div v-if="$page.jetstream.canUpdateProfileInformation">
              <update-profile-information-form :user="$page.user" />

              <jet-section-border />
            </div>

            <div v-if="$page.jetstream.canUpdatePassword">
              <update-password-form class="mt-10 sm:mt-0" />

              <jet-section-border />
            </div>

            <div v-if="$page.jetstream.canManageTwoFactorAuthentication">
              <two-factor-authentication-form class="mt-10 sm:mt-0" />

              <jet-section-border />
            </div>

            <logout-other-browser-sessions-form
              :sessions="sessions"
              class="mt-10 sm:mt-0"
            />

            <jet-section-border />

            <delete-user-form class="mt-10 sm:mt-0" />
          </div>
        </div>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import AppLayout from "@/Layouts/ProfilePageLayout";
import DeleteUserForm from "./DeleteUserForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import LogoutOtherBrowserSessionsForm from "./LogoutOtherBrowserSessionsForm";
import TwoFactorAuthenticationForm from "./TwoFactorAuthenticationForm";
import UpdatePasswordForm from "./UpdatePasswordForm";
import UpdateProfileInformationForm from "./UpdateProfileInformationForm";

export default {
  props: ["sessions"],

  components: {
    AppLayout,
    DeleteUserForm,
    JetSectionBorder,
    LogoutOtherBrowserSessionsForm,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm,
  },
};
</script>
