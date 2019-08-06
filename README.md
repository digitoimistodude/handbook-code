# handbook-code
![based_on_air_version 4.6.2_](https://img.shields.io/badge/based_on_air_version-4.6.2_-brightgreen.svg?style=flat-square) ![project_created 06_Aug_2019](https://img.shields.io/badge/project_created-06_Aug_2019-blue.svg?style=flat-square) ![Tested_up_to WordPress_5.0.3](https://img.shields.io/badge/Tested_up_to-WordPress_5.0.3-blue.svg?style=flat-square) ![Compatible_with PHP_7.2](https://img.shields.io/badge/Compatible_with-PHP_7.2-green.svg?style=flat-square)

This project is hand made for customer. Customer basic details are here:

**Company name:** (Please fill)
**Contact person:** (Please fill)
**Contact email:** (Please fill)

## Stack

This project is built on [digitoimistodude/dudestack](https://github.com/digitoimistodude/dudestack), [digitoimistodude/air-light](https://github.com/digitoimistodude/air-light), [digitoimistodude/marlin-vagrant](https://github.com/digitoimistodude/marlin-vagrant) or [digitoimistodude/macos-lemp-setup](https://github.com/digitoimistodude/macos-lemp-setup), [digitoimistodude/devpackages](https://github.com/digitoimistodude/devpackages) which are documented at their corresponding locations. This is a guide on:

- How to setup the project initially
- How to update the project dependencies
- Project settings and features

## Basic details

**Developers:** [ronilaukkarinen](https://github.com/ronilaukkarinen)
**Custom post type plugin:** ACF Pro

## Theme screenshot

![Screenshot](/content/themes/handbook2019/screenshot.png?raw=true "Screenshot")

## Features

On top of features included in [digitoimistodude/air-light](https://github.com/digitoimistodude/air-light), this project contains:

- (Please fill)

## Environments:

Green checkmarks show if the environment is already set up and running, red cross indicates if it's not yet there or disabled.

✅ Development: [handbook-code.test](http://handbook-code.test)
❌ Staging: [asiakas.dude.fi/handbook-code](https://asiakas.dude.fi/handbook-code)
❌ Production: [handbook-code.fi](https://handbook-code.fi/)

## Setting it up initially

According to our handbook, you should have run `createproject`, inital setup by now. Your Vagrant machine (or macOS LEMP) should be up and running. If not, go back to [dudestack-instructions](https://github.com/digitoimistodude/dudestack-instructions) or [Dude handbook](https://handbook.dude.fi/wordpress-kehitys/projektin-aloitus) and read what you have do.

If dev environment is indeed running, you're ready to version control the project.

There are npm packages in both project root and theme folder. If you come later to this project, please run:

1. `composer in\stall` (in project folder)
2. `npm install` (in project folder)
2. `npm install` (in theme folder)

Run project with `gulp`.

## Noteworthy in this project

Not at the moment.
