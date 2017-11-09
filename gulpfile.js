const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
	mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap');

	Elixir.webpack.mergeConfig({
        module: {
            loaders: [{
                test: /\.jsx?$/,
                loader: 'babel',
                exclude: /node_modules(?!\/(vue-tables-2|vue-pagination-2))/,
                query: {
		          presets: [
		            "es2015",
		            "react"
		          ]
		        }
            }]
        }
    });

    mix.sass('app.scss')
    	.sass('public/public.scss')
       .webpack('app.js');
});
