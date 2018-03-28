/*!******************************************************************
Framework:   FrontBox 1.0.1 (github.com/BartoszPiwek/FrontBox)
Addon:       FrontBox-WordPress 1.0.0 (github.com/BartoszPiwek/FrontBox-WordPress)
Author:      Bartosz Piwek
********************************************************************/

module.exports = function (grunt) {

  'use strict';

  require('jit-grunt')(grunt, {
    sprite: 'grunt-spritesmith',
    autocolor: 'node_modules/frontbox-grunt/tasks/autocolor.js',
    autoclass: 'node_modules/frontbox-grunt/tasks/autoclass.js',
    autosvg: 'node_modules/frontbox-grunt/tasks/autosvg.js',
  });
  require('time-grunt')(grunt);

  grunt.loadNpmTasks('grunt-css-statistics');
  grunt.loadNpmTasks('grunt-html');
  grunt.loadNpmTasks('grunt-preprocess');
  grunt.loadNpmTasks('grunt-zip');
  grunt.loadNpmTasks('grunt-combine-media-queries');

  //=========================================================================
  // Settings

  var html_variables = grunt.file.readJSON('settings/variables_html.json');

  // END Settings
  //=========================================================================

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    //===== Bower

    bowercopy: {
      options: {
        clean: true
      },
      libs: {
        options: {
          destPrefix: 'src/'
        },
        // Comment usused plugins
        files: {
          'src/js/libs/jquery.js': 'jquery/dist/jquery.js',
          'src/js/libs/picturefill.js': 'picturefill/dist/picturefill.js',
          'src/js/libs/select2.js': 'select2/dist/js/select2.js',
          'src/less/libs/select2.less': 'select2/dist/css/select2.css',
          'src/js/libs/tooltipster.js': 'tooltipster/dist/js/tooltipster.main.js',
          'src/less/libs/tooltipster.main.less': 'tooltipster/dist/css/tooltipster.main.css',
          'src/less/libs/fullpage.js.less': 'fullpage.js/dist/jquery.fullpage.css',
          'src/js/libs/fullpage.js': 'fullpage.js/dist/jquery.fullpage.js'
        }
      }
    },

    // Concat
    concat: {
      prod: {
        src: [
          'src/js/libs/jquery.js',
          'src/js/libs/slick.min.js',
          'src/js/libs/youtube.min.js',
          'src/js/libs/cookies.min.js',
          'src/js/libs/featherlight.min.js',
          'assets/js/frontbox.prod.js',
        ],
        dest: 'assets/js/script.prod.js',
      }
    },

    //===== Process

    // Preprocess project
    preprocess: {

      // Frontbox scripts
      dev_frontbox: {
        src: ['assets/js/frontbox.js'],
        options: {
          inline: true,
        }
      },
      prod_frontbox: {
        src: ['assets/js/frontbox.js'],
        options: {
          inline: true,
        }
      }
    },

    //  Uglify JS
    uglify: {
      options: {
        preserveComments: false,
        drop_console: true,
      },
      prod: {
        files: {
          'assets/js/script.prod.js': 'assets/js/script.prod.js'
        }
      },
    },

    babel: {
      options: {
        sourceMap: false,
        presets: ['env']
      },
      dist: {
        files: {
          'assets/js/frontbox.prod.js': 'assets/js/frontbox.js'
        }
      }
    },


    //===== COPY process (files to dev / prod folder)

    copy: {
      // DEV
      dev: {
        files: [
          // screenshot
          {
            expand: true,
            cwd: 'src/images/',
            src: ['**/*.png', '**/*.jpg', '**/*.gif', '**/*.svg'],
            dest: 'assets/images/',
            filter: 'isFile',
          },
          // fonts
          {
            expand: true,
            cwd: 'src/fonts/',
            src: '**',
            dest: 'assets/fonts/',
            filter: 'isFile',
          },
          // javascript
          {
            expand: true,
            cwd: 'src/js/',
            src: ['**', 'libs/*js'],
            dest: 'assets/js/',
            filter: 'isFile',
          },
          // sound
          {
            expand: true,
            cwd: 'src/sound/',
            src: ['**'],
            dest: 'assets/sound/',
            filter: 'isFile',
          },
        ]
      },
      // Frontbox scripts
      dev_frontbox: {
        files: [{
          expand: true,
          cwd: 'src/js/frontbox/',
          src: ['*.js'],
          dest: 'assets/js/frontbox/',
          filter: 'isFile'
        },
        {
          expand: true,
          cwd: 'src/js/',
          src: ['frontbox.js'],
          dest: 'assets/js/',
          filter: 'isFile'
        },
        ]
      },
    },

    //===== JavaScript Process

    // // Concat JS
    // concat: {
    //   prod: {
    //     src: [
    //       'src/js/libs/jquery.js',
    //       'src/js/libs/bootstrap-carousel.js',
    //       'src/js/libs/social.js',
    //       'src/js/frontbox.js',
    //       // 'src/js/frontbox-debug.js', // Debug - Only DEV
    //     ],
    //     dest:  'assets/js/scripts.js',
    //   }
    // },
    //
    // // Uglify JS
    // uglify: {
    //   options: {
    //     preserveComments: false,
    //     drop_console: true,
    //   },
    //   prod: {
    //     files: {
    //       'assets/js/scripts.js': 'assets/js/scripts.js',
    //     },
    //   },
    // },

    //===== Images Process

    // Images optimization
    image: {
      dynamic: {
        options: {
          svgo: true,
          zopflipng: ['-y'],
        },
        files: [{
          expand: true,
          cwd: 'public/prod/images/',
          src: ['**/*.{png,jpg,gif,svg}'],
          dest: 'public/prod/images/',
          filter: 'isFile'
        }]
      }
    },

    // Spritesmith
    // Normal and retina images must be in the same folder
    sprite: {
      icons: {
        src: 'src/images/sprites/icons/*.png',
        dest: 'src/images/sprite-icon.png',
        destCss: 'src/less/automatic/_sprite-icon.less',
        cssTemplate: 'settings/spriteSyntax.less',
        imgPath: '@spriteBannersPath',
        padding: 2,
        algorithmOpts: {
          sort: false
        },
        cssFormat: 'css',
        cssOpts: {
          cssClass: function(item) {
            return '.' + item.name;
          }
        },
        retinaSrcFilter: ['src/images/sprites/icons/*@2x.png'],
        retinaDest: 'src/images/2x/sprites-banners.png'
      },
    },

    // Create favicons
    favicons: {
      options: {
        trueColor: true,
        precomposed: true,
        appleTouchBackgroundColor: "#FFFFFF",
        coast: true,
        windowsTile: true,
        tileBlackWhite: false,
        tileColor: "auto",
        html: 'template-parts/favicon.php',
        HTMLPrefix: "<?php echo $url; ?>/assets/images/favicon/"
      },
      icons: {
        src: 'src/images/favicon.png',
        dest: 'src/images/favicon'
      }
    },

    //===== SVG Process

    // Compress SVG file (grunt-svgmin)
    svgmin: {
      options: {
        plugins: [{
          removeViewBox: false
        }, {
          removeUselessStrokeAndFill: false
        }, {
          removeAttrs: {
            attrs: ['xmlns']
          }
        }]
      },
      dev: {
        files: [{
          expand: true,
          dest: 'src/images/svg/',
          src: ['**/*.svg'],
          cwd: 'assets/images/svg/'
        }]
      }
    },

    //===== CSS Process

    // less
    less: {
      dev: {
        options: {
          compress: false,
          sourceMap: true,
          sourceMapFilename: 'style.css.map',
          sourceMapURL: 'style.css.map',
          sourceMapBasepath: '',
          sourceMapRootpath: '/',
          customFunctions: {
            'version': function() {
              return true;
            },
          }
        },
        files: {
          'style.css': "src/less/style.less"
        }
      },
      prod: {
        options: {
          compress: true,
          sourceMap: false,
          customFunctions: {
            'version': function() {
              return false;
            },
          }
        },
        files: {
          'style.prod.css': "src/less/style.less"
        }
      }
    },

    // Postcss
    postcss: {
      prod: {
        options: {
          processors: [
            require('autoprefixer')({
              browsers: ['last 2 versions', 'ie >= 8', 'Android >= 4.0.0', 'Safari >= 7.1', 'iOS >= 6']
            }), // add vendor prefixes
            require('postcss-pxtorem')({
              rootValue: 10,
              unitPrecision: 5,
              propWhiteList: [],
              selectorBlackList: [],
              replace: true,
              mediaQuery: false,
              minPixelValue: 0
            })
          ],
          map: false
        },
        src: 'style.prod.css',
      },
      min: {
        options: {
          processors: [
            require('cssnano')({
              zindex: false,
              autoprefixer: false
            }) // minify the result
          ],
          map: false
        },
        src: 'style.prod.css',
      }
    },

    // Automatic create variables
    autocolor: {
      automatic: {
        expand: true,
        src: '**',
        cwd: 'src/less',
        filter: 'isFile'
      },
      options: {
        variableFile: "src/less/variables/_colors.less",
        prefix: "@"
      }
    },

    //===== Addon

    // Audo create LESS class
    autoclass: {
      files: {
        expand: true,
        cwd: '',
        src: ['*/**.php'],
        flatten: true,
      },
      options: {
        dest: "src/less/automatic/_automatic.less",
        destResponsive: "src/less/automatic/_responsive.less",
        database: "settings/plugin_autoclass.json"
      }
    },


    // Tests
    cssstats: {
      options: {
        htmlOutput: true,
        jsonOutput: false,
        uniqueDeclarations: [
          'font-size',
          'float',
          'width',
          'height',
          'color',
          'background-color'
        ],
        addOrigin: true,
        addRawCss: true,
        addHtmlStyles: true,
        addGraphs: true,
      },
      dev: {
        files: {
          'logs': ['style.css'],
        }
      },
      prod: {
        files: {
          'logs': ['style.css'],
        }
      },
    },

    // Cleaning
    clean: {
      options: {
        'force': true
      },
      begin: [''],
      end: [
        'critical*.css',
        'images/svg/',
        // 'js/frontbox.js',
        // 'frontbox/',
        // 'libs',
        // 'frontbox-debug.js',
      ],
      dev: [''],
    },

    // Rename CSS selectors
    // rcs: {
    //   css: {
    //     options: {
    //       replaceCss: true,
    //       config: 'grunt_files/rename-css-selectors.json',
    //     },
    //     files: [{
    //       src: 'public/prod/css/style.css',
    //       dest: 'public/prod/css/style.css',
    //     }]
    //   },
    //   all: {
    //     options: {
    //       exclude: [
    //         '.active', 'active'
    //       ],
    //     },
    //     files: [{
    //       expand: true,
    //       cwd: 'public/prod',
    //       src: ['*.html'],
    //       dest: 'public/prod',
    //     }]
    //   }
    // },

    // grunt-combine-media-queries - Combine matching media queries into one media query definition
    cmq: {
      options: {
        log: true
      },
      your_target: {
        files: [{
          src: 'style.prod.css',
          dest: 'style.prod.css',
        }]
      }
    },

    //===== Watch

    // Watch files
    watch: {
      processhtml: {
        files: ['src/template/**/*'],
        tasks: ['newer:copy:dev', 'preprocess:php_dev', 'autosvg:dev', 'autoclass'],
      },
      less: {
        files: ['src/less/**/*'],
        tasks: ['less:dev'],
      },
      images: {
        files: ['src/images/**/*.*'],
        tasks: ['newer:copy:dev'],
      },
      svg: {
        files: ['src/images/svg/*.svg'],
        tasks: ['svgmin'],
      },
      js: {
        files: ['src/js/**/*.js'],
        tasks: ['copy:dev', 'preprocess:dev_frontbox'],
      },
      valid: {
        files: ['src/template/**/*.html'],
        tasks: ['processhtml:dev', 'htmllint:html', 'open:valid'],
      },
      update: {
        files: ['public/dev/**/*'],
      },
    },

    // Concurrent - fix for multiple watch tasks
    concurrent: {
      dev_watch: {
        tasks: ['watch:processhtml', 'watch:less', 'watch:images', 'watch:js', 'watch:svg', 'watch:update'],
        options: {
          logConcurrentOutput: true,
        },
      },
    },

  });

  grunt.registerTask('default', ['dev']);
  grunt.registerTask('up', ['connect:dev:keepalive']);
  grunt.registerTask('up_prod', ['connect:prod:keepalive']);

  // Main tasks
  grunt.registerTask('dev', [
    'newer:copy:dev',
    'copy:dev_frontbox',
    'autoclass',
    'less:dev',
    'svgmin',
    'preprocess:dev_frontbox',
    'concurrent:dev_watch'
  ]);
  grunt.registerTask('prod', [

    // Images
    'favicon',
    'image',
    'svgmin',

    'copy:dev',
    'preprocess:prod_frontbox',

    // CSS
    'autoclass',
    'less:prod',
    'cmq',
    'postcss:prod',
    'postcss:min',

    // JavaScript
    'babel',
    'concat',
    'uglify',
  ]);

  // Images tasks
  grunt.registerTask('images', ['sprite', 'imageoptim']);
  grunt.registerTask('icons', []);
  // grunt.registerTask('banners', ['less:banners', 'watch:banners']);

  // Style tasks
  grunt.registerTask('colors', ['autocolor']);

  grunt.registerTask('favicon', ['favicons']);
};
