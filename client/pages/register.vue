<template>
  <v-layout>
    <v-flex class="xs12 sm6 offset-sm-3 md4 offset-md-4">
      <v-card
        :loading="loading"
        :disabled="loading">
        <v-toolbar
          flat>
          <v-toolbar-title>Inscrivez-vous !</v-toolbar-title>
        </v-toolbar>
        <v-divider />
        <v-card-text>
          <v-text-field
            v-model="model.fullname"
            label="Nom & Prénom"
            filled/>
          <v-text-field
            v-model="model.email"
            label="Email"
            filled/>
          <v-text-field
            v-model="model.password"
            label="Mot de passse"
            filled/>
        </v-card-text>
        <v-divider />
        <v-card-text>
          <v-btn depressed block color="primary" @click="register">
            Inscription
          </v-btn>
          <v-divider class="my-4"/>
          <v-btn depressed block to="/login">
            Se connecter
          </v-btn>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
  export default {
    middleware: ['not-auth'],
    data() {
      return {
        loading: false,
        model: {
          fullname: '',
          email: '',
          password: ''
        }
      }
    },
    methods: {
      register() {
        this.loading = true
        this.$axios.post('register', this.model)
          .then(({ data }) => {
            this.$store.dispatch('auth/setData', data)
            this.$router.push('/home')
          })
          .finally(() => this.loading = false)
      }
    }
  }
</script>
