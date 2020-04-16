<template>
  <v-layout>
    <v-flex>
      <v-card
        class="messages"
        :loading="loading || fetching"
        tile>
        <v-toolbar
          flat>
          <v-toolbar-title>Messages</v-toolbar-title>
        </v-toolbar>
        <v-divider />
        <v-card-text class="m-body">
          <div
            v-for="(item, i) in itemsComputed"
            :key="i"
            :class="['message my-4 ',  item.auteur == 'moi' ? 'text-right' : '']">
            <div
              :class="['m-content', item.auteur == 'moi' ? 'primary white--text moi' : 'grey lighten-3 autre']">
              {{ item.message }}
            </div>
            <div style="font-size: 12px">{{ item.date }} {{ item.heure }}</div>
            <div style="font-size: 12px">Par: {{ item.user.fullname }}</div>
          </div>
        </v-card-text>
        <v-divider />
        <v-toolbar flat>
          <v-text-field
            v-model="message"
            label="Entrer votre message"
            :loading="loading"
            :disabled="loading"
            hide-details
            filled
            tile
            single-line
            @keyup.enter="send"/>
          <v-btn
            color="primary"
            class="ml-2"
            :disabled="!message"
            height="57"
            tile
            depressed
            @click="send">
            Envoyer
          </v-btn>
        </v-toolbar>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<style lang="stylus">
  .messages * {
    border-radius: 0;
  }
  .messages {
    .m-body {
      height: 400px;
      overflow: auto;
    }

    .m-content {
      max-width: 60%;
      padding: 8px;
      display: inline-block;
      border-radius: 10px;
    }
  }
</style>
<script>
  export default {
    middleware: ['auth'],
    data() {
      return {
        message: '',
        loading: false,
        fetching: false,
        items: []
      }
    },
    computed: {
      user_id() {
        return this.user.id
      },
      itemsComputed() {
        return this.items.map(item => {
          const parts = item.created_at.split('T')
          const date = parts[0].split('-').reverse().join('/')
          const heure = parts[1].split('.')[0]
          return {
            ...item,
            auteur: item.user_id == this.user_id ? 'moi' : 'autre',
            date,
            heure
          }
        })
      }
    },
    created() {
      this.fetch()

      Echo.channel('messages').listen('.message', ({ item }) => {
        if (item.user_id != this.user_id) {
          this.items.push(item)
        }
      })
    },
    methods: {
      fetch() {
        this.fetching = true

        this.$axios.get('messages')
          .then(({data}) => {
            this.items = data
          })
          .finally(() => this.fetching = false)
      },
      send() {
        if (!this.message) {
          return
        }
        this.loading = true
        this.$axios.post('messages', {message: this.message})
          .then(({ data }) => {
            this.items.push(data)
            this.message = ''
          })
          // .catch(({ data }) => {
          //   this.$awn.alert('Envoi impossible')
          // })
          .finally(() => this.loading = false)
      }
    }
  }

</script>
