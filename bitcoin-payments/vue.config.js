const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  publicPath: '/payments/',
  configureWebpack: {
    resolve: {
      fallback: {
        "stream": require.resolve("stream-browserify"),
        "buffer": require.resolve("buffer/"),
        "assert": require.resolve("assert/"),
        "crypto": require.resolve("crypto-browserify")
      },
    },
  }
})
