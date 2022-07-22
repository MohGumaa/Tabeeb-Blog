
<p align="center"><img src="https://dev.tabeeb.com/wp-content/uploads/2022/06/tabeeb-logo-new.svg" width="320" height="auto"></p>

#### See: [Official Demo](https://dev.tabeeb.com/)

# Tabeeb Blog WordPress Theme Framework

Website: [tabeeb.com](https://dev.tabeeb.com)

Child Theme Project: [https://github.com/MohGumaa/Tabeeb-Blog](https://github.com/MohGumaa/Tabeeb-Blog)

## About

Create WordPress Theme for Tabeeb Website using HTML, Css, JS & PHP.

## Basic Features

- Combines PHP/JS files and Bootstrap’s HTML/CSS/JS.
- Comes with Bootstrap (v4 and/or v5) Sass source files and additional .scss files. Nicely sorted and ready to add your own variables and customize the Bootstrap variables.
- Uses a single minified CSS file for all the basic stuff.
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/) integration (v4.7.0)
- Jetpack ready
- WooCommerce support
- Contact Form 7 support
- Translation ready

### Installing Dependencies
- Make sure you have installed Node.js and Browser-Sync (optional) on your computer globally
- Then open your terminal and browse to the location of your theme copy
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
	"proxy": "localhost/", // Change here
	"notify": false,
	"files": ["./css/*.min.css", "./js/*.min.js", "./**/*.php"]
};
```

then run:

```bash
npm run watch-bs
```

## Bootstrap 4 Legacy Build Process

Some of our build tasks have been duplicated to support both Bootstrap 4 and Boostrap 5 asset generation. The *default* version of tasks will generate v5 assets.

**CSS Tasks** `npm run css` will generate v5 assets, while `npm run css-bs4` will generate necessary assets for v4.

**JS Tasks** `npm run js` will generate v5 assets, while `npm run js-bs4` will generate necessary assets for v4.

**Watch Tasks** `npm run watch` and `npm run watch-bs` will only generate for v5. Once complete, run `npm run dist` to update v4.

**Dist Task** `npm run dist` will generate both v4 & v5 assets.

**Other Assets** This theme also includes a few additional files directories to support Bootstrap 4 in `/src/build-bootstrap4/`, `/src/sass/assets/bootstrap4/`, and `/src/js/bootstrap4.js`

## Block Editor (Gutenberg) Support

As of version 1.0.0, theme supports the block editor. The theme include "Bootstrap" styles automatically for default blocks like tables, captions, and blockquotes. Even further, the theme automatically parses your Bootstrap variables to load your custom color palette into the block editor, ensuring that your color choices match the front-end of the site.


*Note: Wide- and full-width blocks will not work with the sidebar templates. They'll simply display in a normal width. They will work, however, with any full width templates or if sidebars are globally disabled in the customizer.*

## How to Use the Built-In Widget Slider

The front-page slider is widget driven. Simply add more than one widget to widget position “Hero”.
- Click on Appearance → Widgets.
- Add two, or more, widgets of any kind to widget area “Hero”.
- That’s it.

## RTL styles?
Add a new file to the themes root folder called rtl.css. Add all alignments to this file according to this description:
https://codex.wordpress.org/Right_to_Left_Language_Support

## Page Templates
theme includes several different page template files to render a number of unique layouts.

### Blank Template

The `blank.php` template is useful when working with various page builders and can be used as a starting blank canvas.

### Empty Template

The `empty.php` template displays a header and a footer only. A good starting point for landing pages.

### Sidebar Templates

The theme also includes a number of templates for enabling the right and left sidebars.

### Full Width Template

The `fullwidthpage.php` template has full width layout without a sidebar.


Licenses & Credits
=
- Font Awesome: https://fontawesome.com/v4.7/license/ (Font: SIL OFL 1.1, (S)CSS: MIT)
- Bootstrap: http://getbootstrap.com | https://github.com/twbs/bootstrap/blob/master/LICENSE (MIT)
- WP Bootstrap Navwalker by Edward McIntyre & William Patton: https://github.com/wp-bootstrap/wp-bootstrap-navwalker (GNU GPLv3)
