'use strict';
var util = require('util');
var path = require('path');
var yeoman = require('yeoman-generator');


var WpwidgetGenerator = module.exports = function WpwidgetGenerator(args, options, config) {
  yeoman.generators.Base.apply(this, arguments);

  this.on('end', function () {
    this.installDependencies({ skipInstall: options['skip-install'] });
  });

  this.pkg = JSON.parse(this.readFileAsString(path.join(__dirname, '../package.json')));
};

util.inherits(WpwidgetGenerator, yeoman.generators.Base);

WpwidgetGenerator.prototype.askFor = function askFor() {
  var cb = this.async();

  // have Yeoman greet the user.
  console.log(this.yeoman);

  var prompts = [{
    name: 'widgetName',
    message: 'What do you want to call your WP-Widget\n(use spaces if necesary, avoid using \'_\' or \'-\' characters, eg. My Widget) \n?'
  }, {
    name: 'domainPrefix',
    message: 'What is your domain prefix (eg. myapp)\n?'
  }, {
    name: 'widgetDescription',
    message: 'What is the description of your widget\n?'
  }, {
    type: 'list',
    name: 'jsFramework',
    message: 'Which JS js setup do you have\n?',
    choices: [{
        name: "plain js",
        value: 'plain'
      },{
        name: "jQuery",
        value: 'jquery'
      },{
        name: "AngularJS",
        value: 'angularjs'
      },{
        name: "Module",
        value: 'module'
      },{
        name: "let me handel it",
        value: 'none'
      }
    ]
  }];

  this.prompt(prompts, function (props) {
    this.widgetName = this._sanitize( props.widgetName );
    this.domainPrefix = this._sanitize( props.domainPrefix );
    this.widgetDescription = this._sanitize( props.widgetDescription );
    this.jsFramework = props.jsFramework;
    console.log("this.jsFramework", this.jsFramework);

    cb();
  }.bind(this));
};

WpwidgetGenerator.prototype.app = function app() {
  this.dashedWidgetName = this.widgetName.replace( /\s/g, '-').toLowerCase();
  this.underscoredWidgetName = this.widgetName.replace( /\s/g, '_');
  this.TitleCaseWidgetName = this.widgetName.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
  this.classWidgetName = this.TitleCaseWidgetName.replace( /\s/g, '_');


  this.mkdir(this.dashedWidgetName);
  this.mkdir(this.dashedWidgetName + '/css');
  this.mkdir(this.dashedWidgetName + '/js');
  this.mkdir(this.dashedWidgetName + '/lang');
  this.mkdir(this.dashedWidgetName + '/views');

  this.template('_plugin.php', this.dashedWidgetName + '/' + this.dashedWidgetName + '.php');

  this.template('css/' + '_admin.css', this.dashedWidgetName + '/css/admin.css');
  this.template('css/' + '_widget.css', this.dashedWidgetName + '/css/widget.css');

  this.template('views/' + '_admin.php', this.dashedWidgetName + '/views/admin.php');
  this.template('views/' + '_widget.php', this.dashedWidgetName + '/views/widget.php');

  this.template('js/' + '_admin.js', this.dashedWidgetName + '/js/admin.js');
  this.template('js/' + '_widget.js', this.dashedWidgetName + '/js/widget.js');

  this.copy('lang/_plugin.po', this.dashedWidgetName + '/lang/plugin.po');
  this.copy('README.txt', this.dashedWidgetName + '/README.txt');

  this.template('_package.json', 'package.json');
  this.template('_bower.json', 'bower.json');
};

WpwidgetGenerator.prototype.projectfiles = function projectfiles() {
  this.copy('editorconfig', '.editorconfig');
  this.copy('jshintrc', '.jshintrc');
};


WpwidgetGenerator.prototype._sanitize = function sanitize(str) {
  return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
};