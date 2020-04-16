const options = JSON.parse(`<%= JSON.stringify(options) %>`)
const env = options.env
window.env = env
export default function (context, inject) {
  inject('env', (key) => {
    key = key.toUpperCase()
    return env[key] || ''
  })
}
