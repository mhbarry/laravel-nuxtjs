import fs from 'fs'

import { resolve } from 'path'

import _ from 'underscore'

export default function (options = { only: []}) {
  const only = _.isArray(options.only) ? options.only : []
  const items = {}
  fs.readFile('./../.env', 'utf8', function(err, data){

    if (err) {
      console.error('.env file not found')
      return
    }
    const rows = data.split("\n")

    rows.forEach(item => {
      if (item) {
        const parts = item.split('=')
        const key = parts[0]
        const value = parts[1]
        if (only.includes(key)) {
          items[key] = value
        }
      }
    })
  });

  this.addPlugin({
    src: resolve(__dirname, 'plugins/env.js'),
    options: {
      env: items
    }
  })
}
