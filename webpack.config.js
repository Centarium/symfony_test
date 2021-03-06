var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
     .addEntry('js/app', './assets/js/app.js')
     .addEntry('jsx/app', './assets/jsx/appReact.jsx')
     .addStyleEntry('css/app', './assets/css/app.scss')

    .createSharedEntry('vendor', [
        'jquery',
        'bootstrap',

        // you can also extract CSS - this will create a 'vendor.css' file
        // this CSS will *not* be included in page1.css or page2.css anymore
        'bootstrap-sass/assets/stylesheets/_bootstrap.scss'
    ])

    // uncomment if you use Sass/SCSS files
     .enableSassLoader()
     .enableReactPreset()

    // uncomment for legacy applications that require $/jQuery as a global variable
     .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
