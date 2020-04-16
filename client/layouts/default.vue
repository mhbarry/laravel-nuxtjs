<template>
  <v-app>
    <v-app-bar
      app
      flat>
      <v-toolbar-title>Laranuxt</v-toolbar-title>
      <v-spacer />
      <template v-if="logged">
        <v-toolbar-title class="px-4">{{ user.fullname }}</v-toolbar-title>
      </template>
      <v-toolbar-items>
        <template v-if="logged">
          <v-btn
            text
            to="/messages">
            Messages
          </v-btn>
          <v-btn
            text
            @click="$store.dispatch('auth/logout')">
            Deconnexion
          </v-btn>
        </template>
        <template v-else>
          <v-btn
            to="/register"
            text>
            Inscription
          </v-btn>
          <v-btn
            to="/login"
            text>
            Connexion
          </v-btn>
        </template>
      </v-toolbar-items>
    </v-app-bar>
    <v-content>
      <v-container>
        <nuxt />
      </v-container>
    </v-content>
  </v-app>
</template>

<style>
</style>

<script>
  import app from "../mixins/app";
  export default {
    mixins: [app],
    computed: {
      logged() {
        return (this.user || {}).id
      }
    }
  }
</script>
