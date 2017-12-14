/*!******************************************************************
Framework:   FrontBox 1.0.1 (github.com/BartoszPiwek/FrontBox)
Addon:       FrontBox-WordPress 1.0.0 (github.com/BartoszPiwek/FrontBox-WordPress)
Author:      Bartosz Piwek
********************************************************************/

module.exports = function(grunt) {

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
        'src/js/libs/slick.js',
        'src/js/libs/jquery-modal-video.js',
        'src/js/libs/jquery.mask.js',
        'src/js/libs/jquery-validator.js',
        'src/js/libs/jquery.inputmask.bundle.js',
        'src/js/frontbox.js',
    ],
    dest: 'assets/js/script.js',
  }
},

uglify: {
  prod: {
    options: {
      warnings: false,
      drop_console: true,
      drop_debugger: true
    },
    files: {
      'assets/js/script.js': ['assets/js/script.js']
    }
  },
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
            dest:  'assets/js/',
            filter: 'isFile',
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
    imageoptim: {
      options: {
        quitAfter: true
      },
      png: {
        options: {
          imageAlpha: true,
          jpegMini: false
        },
        src: [
          'public/prod/images/**/*.png'
        ]
      },
      jpg: {
        options: {
          imageAlpha: false,
          jpegMini: false
        },
        src: [
          'public/prod/images/**/*.jpg'
        ]
      }
    },

    // Spritesmith
    sprite: {
      logos: {
        src: 'src/images/sprite/logos/*.png',
        dest: 'src/images/sprite-logo.png',
        destCss: 'src/less/automatic/sprite-logo.less',
        cssTemplate: 'grunt_files/sprite_syntax_responsive.less',
        imgPath: '@spriteLogoPath',
        padding: 15,
        algorithmOpts: {
          sort: false
        },
        cssFormat: 'css',
        cssOpts: {
          cssClass: function(item) {
            return '.' + item.name;
          }
        },
        // retinaSrcFilter: ['src/images/sprites/icons/2x/*@2x.png'],
        // retinaDest: 'src/images/2x/sprites-banners.png'
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
        html: 'src/template/includes/favicon.html',
        HTMLPrefix: "/images/favicon/"
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
          sourceMapRootpath: '/'
        },
        files: {
          'style.css': "src/less/style.less"
        }
      },
      prod: {
        options: {
          compress: false,
          sourceMap: false
        },
        files: {
          'style.css': "src/less/style.less"
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
        src: 'style.css',
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
        src: 'style.css',
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
        tasks: ['newer:copy:dev'],
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
  grunt.registerTask('dev', ['copy:dev', 'less:dev', 'svgmin', 'concurrent:dev_watch']);
  grunt.registerTask('prod', ['copy:dev', 'less:prod', 'concat', 'uglify', 'svgmin', 'postcss:prod',
 'postcss:min']);

  // Images tasks
  grunt.registerTask('images', ['sprite', 'imageoptim']);
  grunt.registerTask('icons', []);
  // grunt.registerTask('banners', ['less:banners', 'watch:banners']);

  // Style tasks
  grunt.registerTask('colors', ['autocolor']);

  // Addon tasks
  grunt.registerTask('hash', ['hash_res']);
  grunt.registerTask('bower', ['bowercopy']);

  // Valid tasks
  grunt.registerTask('valid', ['clean:dev', 'processhtml:dev', 'htmllint:html', 'open:valid', 'watch:valid']);
  grunt.registerTask('prod_valid', ['processhtml:prod', 'htmllint:prod_html', 'open:prod_valid']);
};
