export default function ({redirect, route, store}) {
  const auth = $nuxt.$session.get('auth') || { user: {} }
  if (!auth.user.id) {
    redirect('/')
  }
}
