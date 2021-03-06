const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

const config = {
    entry: {
        index: './src/js/index.js',
        style: './src/scss/style.scss',
    },
    output: {
        filename: 'js/[name].js',
        path: path.resolve(__dirname, 'assets'),
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                /* 		use: ExtractTextPlugin.extract({
					fallback: 'style-loader', */
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader?url=false',
                    'postcss-loader',
                    'sass-loader',
                ],
                //}),
            },
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                loader: 'babel-loader',
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '/css/[name].css',
        }),
    ],
};

//If true JS and CSS files will be minified
if (process.env.NODE_ENV === 'production') {
    config.plugins.push(
        //new UglifyJSPlugin(),
        new CssMinimizerPlugin()
    );
}

module.exports = config;
