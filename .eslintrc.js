module.exports = {
  ignorePatterns: ['content/themes/handbook/js/dist/*.js', 'content/themes/handbook/node_modules/**/*.js', 'temp.js', 'content/themes/handbook/js/src/front-end.js', '**/gulp/**/*.js', '**/gulp/*.js', 'gulpfile.js'],
  parser: 'babel-eslint',
  extends: 'eslint-config-airbnb/base',
  rules: {
    indent: ['error', 2],
  },
  env: {
    browser: true,
    jquery: true,
  },
};
