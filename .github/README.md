<p align="center"><img src="https://tabeeb.com/wp-content/uploads/2022/09/Logo-grey-en.svg " width="140" height="auto" style="margin-bottom: 8px;"></p>

# Tabeeb - Educational Medical Platform (WordPress Theme)

Website: [tabeeb.com](https://tabeeb.com)

## About

Create WordPress Theme for Tabeeb Website using HTML, Css, JS & PHP.

## `Tabeeb Features`

- **Rich Medical Content:** Tabeeb offers an extensive collection of medical articles, research papers, case studies, and educational materials in Arabic, curated by renowned doctors.

- **Interactive Courses:** Users can enroll in interactive online courses covering various medical disciplines, complete with video lectures, quizzes, and assignments.

- **Expert Consultations:** Tabeeb connects users with experienced doctors who can provide online consultations and answer medical queries.

- **User Profiles:** Each user can create a personalized profile to track their learning progress, course enrollments, and consultation history.

- **Search Functionality:** Users can easily search for specific medical topics, doctors, or courses within the platform.

- **User Interaction:** Users can engage in discussions, post comments, and interact with other medical enthusiasts on the platform.

- **Responsive Design:** Tabeeb is optimized for various devices, including desktops, tablets, and smartphones.

## Basic Features

- Combines Underscore’s PHP/JS files and Bootstrap’s HTML/CSS/JS.
- Comes with Bootstrap (v4 and/or v5) Sass source files and additional .scss files. Nicely sorted and ready to add your own variables and customize the Bootstrap variables.
- Uses a single minified CSS file for all the basic stuff.
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/) integration (v4.7.0)
- Jetpack ready
- WooCommerce support
- Contact Form 7 support
- Translation ready

## Installation

- Download the tabeeb folder from GitHub or from [https://git.jubna.me/tabeeb/tabeeb-website](https://git.jubna.me/tabeeb/tabeeb-website)
- IMPORTANT: If you download it from GitHub make sure you rename the "tabeeb-master.zip" file just to "tabeeb.zip" or you might have problems using child themes!
- Upload it into your WordPress installation theme subfolder: `/wp-content/themes/`
- Login to your WordPress backend
- Go to Appearance → Themes
- Activate the tabeeb theme

## Developing With npm, postCSS, Rollup, SASS and BrowserSync

This theme uses [sass](https://www.npmjs.com/package/sass) and [postCSS](https://postcss.org) to handle compiling all of the styles into one style sheet. The theme also includes [rollup.js](https://www.rollupjs.org/) to handle javascript compilation and minification. These choices are based on the same libraries and npm commands used in Bootstrap. In addition, it comes with [Browser Sync](http://browsersync.io) to handle live reloading while you develop.

### Confused by All the CSS, SCSS, and SASS Files?

Some basics about the files that come with Understrap:

- The theme itself uses the `/style.css` file only to identify the theme inside of WordPress. The file is not loaded by the theme and does not include any styles.
- The `/css/theme.css` and its minified little brother `/css/theme.min.css` file(s) provides all styles. It is composed of different SCSS sets and one variable file, all imported at `/src/sass/theme.scss`
- Your design goes into: `/src/sass/theme`.
  - Override Bootstrap by addind your variables to the `/src/sass/theme/_theme_variables.scss`
  - Add your custom styles to the `/src/sass/theme/_theme.scss` file
  - Or add other .scss files into it and `@import` it into `/src/sass/theme/_theme.scss`.

The same goes for Javascript. Just add your javascript to `/src/js/custom-javascript.js` and let rollup.js handle the rest.

### Installing Dependencies

- Make sure you have installed Node.js and Browser-Sync (optional) on your computer globally
- Then open your terminal and browse to the location of your Understrap copy
- Run: `$ npm install`

### Running

To work with and compile your Sass and Javascript files on the fly start:

```bash
npm run watch
```

Or, to run with Browser-Sync:

First change the browser-sync options to reflect your environment in the file `/build/browser-sync.config.js` in the beginning of the file:

```javascript
module.exports = {
	proxy: "localhost/", // Change here
	notify: false,
	files: ["./css/*.min.css", "./js/*.min.js", "./**/*.php"],
};
```

then run:

```bash
npm run watch-bs
```

## Bootstrap 4 Legacy Build Process

Some of our build tasks have been duplicated to support both Bootstrap 4 and Boostrap 5 asset generation. The _default_ version of tasks will generate v5 assets.

**CSS Tasks** `npm run css` will generate v5 assets, while `npm run css-bs4` will generate necessary assets for v4.

**JS Tasks** `npm run js` will generate v5 assets, while `npm run js-bs4` will generate necessary assets for v4.

**Watch Tasks** `npm run watch` and `npm run watch-bs` will only generate for v5. Once complete, run `npm run dist` to update v4.

**Dist Task** `npm run dist` will generate both v4 & v5 assets.

**Other Assets** This theme also includes a few additional files directories to support Bootstrap 4 in `/src/build-bootstrap4/`, `/src/sass/assets/bootstrap4/`, and `/src/js/bootstrap4.js`

Thank you for choosing Tabeeb! We hope our platform helps you on your medical education journey. Happy learning! 🚀
