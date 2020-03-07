const path = require('path');
const webpack = require('webpack');
module.exports = {
    devtool: 'source-map',
    entry: {
        template: './views/js/template.js',
        profile_contact: './views/js/profileContact.js',

    },
    output: {
        path: path.resolve(__dirname, 'views/js'),
        filename: '../../assets/[name].js'
    },

    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
          })
    ],

    resolve: {
        alias: {
            'load-image': 'blueimp-load-image/js/load-image.js',
            'load-image-meta': 'blueimp-load-image/js/load-image-meta.js',
            'load-image-exif': 'blueimp-load-image/js/load-image-exif.js',
            'load-image-scale': 'blueimp-load-image/js/load-image-scale.js',
            'canvas-to-blob': 'blueimp-canvas-to-blob/js/canvas-to-blob.js',
            'jquery-ui/ui/widget': 'blueimp-file-upload/js/vendor/jquery.ui.widget.js'
        }
    },

    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [
                    { loader: 'style-loader' },
                    { loader: 'css-loader' },
                ],
            },
            {
                test: /\.(png|jpe?g|gif)$/i,
                use: [
                  {
                    loader: 'file-loader',
                  },
                ],
              },
            {
                test: /\.(png|jpg)$/,
                loader: 'url-loader'
            },
            {
                test: /\.scss$/,
                loader: 'style-loader!css-loader!sass-loader'
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg|gif|png|jpg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [
                  {
                    loader: 'file-loader',
                    options: {
                        publicPath: '/plataforma_clientes/assets',
                        name: '[name].[ext]',
                        outputPath: '../../assets',
                    }
                  }
                ]
            },
            {
                test: /\.less$/,
                use: [
                    // Creates `style` nodes from JS strings
                    'style-loader',
                    // Translates CSS into CommonJS
                    'css-loader',
                    // Compiles Sass to CSS
                    'less-loader',
                  ],
            }
        ],
    },
};