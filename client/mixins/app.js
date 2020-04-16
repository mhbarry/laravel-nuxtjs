export default {
  created() {
    const auth = this.$session.get('auth') || { user: {} }
    this.$store.dispatch('auth/setData', auth)
  }
}
