/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */

module.exports = {

  // Project options.
  projectURL: 'localhost', // Local project URL of your already running WordPress site. Could be something like wpgulp.local or localhost:3000 depending upon your local WordPress setup.
  productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
  browserAutoOpen: false,
  injectChanges: true,

  // Style options.
  styleSRC: './assets/css/*.scss', // Path to main .scss file.
  styleDestination: './assets/css/', // Path to place the compiled CSS file. Default set to root folder.
  outputStyle: 'compact', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
  errLogToConsole: true,
  precision: 10,

  // JS Admin (original is Vendor) options.
  jsVendorSRC: './assets/js/admin/*.js', // Path to JS admin folder.
  jsVendorEntry: './assets/js/admin/admin.js', // Path to JS admin scripts entry.
  jsVendorDestination: './assets/js/', // Path to place the compiled JS admin file.
  jsVendorFile: 'drgc-admin', // Compiled JS admin file name.

  // JS Public (original is Custom) options.
  jsCustomSRC: './assets/js/public/*.js', // Path to JS public scripts folder.
  jsCustomEntry: './assets/js/public/public.js', // Path to JS public scripts entry.
  jsCustomDestination: './assets/js/', // Path to place the compiled JS public scripts file.
  jsCustomFile: 'drgc-public', // Compiled JS public file name.

  // Images options.
  imgSRC: './assets/img/raw/**/*', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
  imgDST: './assets/img/', // Destination folder of optimized images. Must be different from the imagesSRC folder.

  // Watch files paths.
  watchStyles: './assets/css/**/*.scss', // Path to all *.scss files inside css folder and inside them.
  watchJsVendor: './assets/js/admin/*.js', // Path to all vendor JS files.
  watchJsCustom: './assets/js/public/*.js', // Path to all custom JS files.
  watchPhp: './**/*.php', // Path to all PHP files.

  // Translation options.
  textDomain: 'digital-river-global-commerce', // Your textdomain here.
  translationFile: 'digital-river-global-commerce.pot', // Name of the translation file.
  translationDestination: './languages', // Where to save the translation files.
  pluginShortName: 'drgc', // For CSS filename prefix.
  packageName: 'Digital_River_Global_Commerce', // Package name.
  bugReport: 'https://github.com/DigitalRiver/digital-river-global-commerce', // Where can users report bugs.
  lastTranslator: 'GCTemplates <gcTemplates@digitalriver.com>', // Last translator Email ID.
  team: 'GCTemplates <gcTemplates@digitalriver.com>', // Team's Email ID.

  // Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
  // The following list is set as per WordPress requirements. Though, Feel free to change.
  BROWSERS_LIST: [
    'last 2 version',
    '> 1%',
    'ie >= 11',
    'last 1 Android versions',
    'last 1 ChromeAndroid versions',
    'last 2 Chrome versions',
    'last 2 Firefox versions',
    'last 2 Safari versions',
    'last 2 iOS versions',
    'last 2 Edge versions',
    'last 2 Opera versions'
  ]
};
