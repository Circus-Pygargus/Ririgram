const path = require('path');
const MiniCSSExtractPlugin = require('mini-css-extract-plugin');
const devMode = process.env.MODE_ENV !== 'production';
const CopyPlugin = require('copy-webpack-plugin');

module.exports = {
  entry: {
    app: './assets/js/app.js',
  },

  output: {
    path: path.resolve(__dirname, 'public/js'),
    filename: '[name].js'
  },

  module:{
    rules:[{
      test: /\.s?[ac]ss$/,
      use : [
        MiniCSSExtractPlugin.loader,
        {loader: 'css-loader', options: { url: false, sourceMap : true}},
        {loader: 'sass-loader', options: {sourceMap: true}}
      ]
    },
    {
      test: /\.js$/,
      exclude: /node_modules/,
      use: "babel-loader"
    }
    ]
  },
  devtool:'source-map',
  plugins:[
    new MiniCSSExtractPlugin({
      filename: '../css/style.css'
    }),
    new CopyPlugin([
      { from: 'assets/images', to: '../img' },
      { from: 'assets/fonts', to: '../fonts' }
    ])
  ],

   mode : devMode ? 'development': 'production'
};