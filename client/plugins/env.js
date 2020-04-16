const options = <%= JSON.stringify(options, null, 2) %>
const env = options.env
window.env = env
export default function (context, inject) {
  inject('env', (key) => {
    key = key.toUpperCase()
    return env[key] || ''
  })
}
