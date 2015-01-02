/* jshint node:true */
module.exports = function( grunt ) {
  'use strict';

  grunt.initConfig({

    // JavaScript linting with JSHint.
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'js/*.js',
        '!js/*.min.js',
        'inc/customizer/js/*.js',
        '!inc/customizer/js/*.min.js'
      ]
    },

    // Minify .js files.
    uglify: {
      options: {
        preserveComments: 'some'
      },
      main: {
        files: [{
          expand: true,
          cwd: 'js/',
          src: [
            '*.js',
            '!*.min.js'
          ],
          dest: 'js/',
          ext: '.min.js'
        }]
      },
      customizer: {
        files: [{
          expand: true,
          cwd: 'inc/customizer/js/',
          src: [
            '*.js',
            '!*.min.js'
          ],
          dest: 'inc/customizer/js/',
          ext: '.min.js'
        }]
      }
    },

    // Compile all .scss files.
    sass: {
      compile: {
        options: {
          sourcemap: 'none',
          style: 'nested',
          loadPath: require( 'node-bourbon' ).includePaths
        },
        files: [{
          'style.css': 'style.scss',
          'inc/woocommerce/css/*.css': 'inc/woocommerce/css/sass/*.scss'
        }]
      }
    },

    // Minify all .css files.
    cssmin: {
      minify: {
        expand: true,
        cwd: 'inc/woocommerce/css/',
        src: ['*.css'],
        dest: 'inc/woocommerce/css/',
        ext: '.css'
      }
    },

    // Watch changes for assets.
    watch: {
      css: {
        files: [
          'style.scss',
          'inc/woocommerce/css/*.scss',
          'sass/modules/*.scss',
          'sass/partials/*.scss',
          'sass/vendor/*.scss'
        ],
        tasks: [
          'sass',
          'cssmin'
        ]
      },
      js: {
        files: [
          // main js
          'js/*js',
          '!js/*.min.js',

          // customizer js
          'inc/customizer/js/*js',
          '!inc/customizer/js/*.min.js'
        ],
        tasks: ['uglify']
      }
    },

    // Generate POT files.
    makepot: {
      options: {
        type: 'wp-theme',
        domainPath: 'languages',
        potHeaders: {
          'report-msgid-bugs-to': 'https://github.com/valendesigns/archetype/issues',
          'last-translator': 'Valen Designs <support@valendesigns.com>',
          'language-team': 'Valen Designs <support@valendesigns.com>'
        }
      },
      frontend: {
        options: {
          potFilename: 'archetype.pot',
          processPot: function ( pot ) {
            pot.headers['project-id-version'];
            return pot;
          }
        }
      }
    },

    // Check textdomain errors.
    checktextdomain: {
      options:{
        text_domain: 'archetype',
        keywords: [
          '__:1,2d',
          '_e:1,2d',
          '_x:1,2c,3d',
          'esc_html__:1,2d',
          'esc_html_e:1,2d',
          'esc_html_x:1,2c,3d',
          'esc_attr__:1,2d',
          'esc_attr_e:1,2d',
          'esc_attr_x:1,2c,3d',
          '_ex:1,2c,3d',
          '_n:1,2,4d',
          '_nx:1,2,4c,5d',
          '_n_noop:1,2,3d',
          '_nx_noop:1,2,3c,4d'
        ]
      },
      files: {
        src:  [
          '**/*.php', // Include all files
          '!node_modules/**' // Exclude node_modules/
        ],
        expand: true
      }
    },

    // Creates deploy-able theme
    copy: {
      deploy: {
        src: [
          '**',
          '!.*',
          '!.*/**',
          '.htaccess',
          '!Gruntfile.js',
          '!package.json',
          '!node_modules/**',
          '!style.scss',
          '!sass/**',
          '!inc/woocommerce/css/sass/*.scss',
          '!tests/**',
          '!phpunit.xml.dist'
        ],
        dest: 'archetype',
        expand: true,
        dot: true
      }
    }

  });

  // Load NPM tasks to be used here
  grunt.loadNpmTasks( 'grunt-contrib-jshint' );
  grunt.loadNpmTasks( 'grunt-contrib-uglify' );
  grunt.loadNpmTasks( 'grunt-contrib-sass' );
  grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
  grunt.loadNpmTasks( 'grunt-contrib-watch' );
  grunt.loadNpmTasks( 'grunt-wp-i18n' );
  grunt.loadNpmTasks( 'grunt-checktextdomain' );
  grunt.loadNpmTasks( 'grunt-contrib-copy' );

  // Register tasks
  grunt.registerTask( 'default', [
    'css',
    'uglify'
  ]);

  grunt.registerTask( 'css', [
    'sass',
    'cssmin'
  ]);

  grunt.registerTask( 'dev', [
    'default',
    'makepot'
  ]);

  grunt.registerTask( 'deploy', [
    'copy'
  ]);
};
