/* jshint node:true */
module.exports = function( grunt ) {
	'use strict';

	grunt.initConfig({

		pkg: grunt.file.readJSON( 'package.json' ),

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
			core: {
				files: [ {
					expand: true,
					cwd: 'js/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'js/',
					ext: '.min.js'
				} ]
			},
			customizer: {
				files: [ {
					expand: true,
					cwd: 'inc/customizer/js/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'inc/customizer/js/',
					ext: '.min.js'
				} ]
			}
		},

		// Compile all .scss files.
		sass: {
			options: {
				require: 'susy',
				sourcemap: 'none',
				includePaths: require( 'node-bourbon' ).includePaths
			},
			core: {
				files: [ {
					'style.css': 'style.scss'
				} ]
			},
			customizer: {
				files: [ {
					'inc/customizer/css/customizer.css': 'inc/customizer/sass/customizer.scss'
				} ]
			},
			woocommerce: {
				files: [ {
					expand: true,
					cwd: 'inc/woocommerce/sass/',
					src: [ '*.scss' ],
					dest: 'inc/woocommerce/css/',
					ext: '.css'
				} ]
			}
		},

		// Create RTL .css files
		rtlcss: {
			options: {
				config: {
					swapLeftRightInUrl: false,
					swapLtrRtlInUrl: false,
					autoRename: false,
					preserveDirectives: true
				},
				saveUnmodified: true
			},
			core: {
				expand: true,
				ext: '-rtl.css',
				src: [
					'style.css'
				]
			},
			woocommerce: {
				expand: true,
				ext: '-rtl.css',
				src: [
					'inc/woocommerce/css/*.css',
					'!inc/woocommerce/css/*-rtl.css'
				]
			}
		},

		// Minify all .css files.
		cssmin: {
			core: {
				expand: true,
				files: [ {
					'style.min.css': 'style.css',
					'style-rtl.min.css': 'style-rtl.css'
				} ]
			},
			customizer: {
				files: [ {
					expand: true,
					cwd: 'inc/customizer/css/',
					src: [ '*.css' ],
					dest: 'inc/customizer/css/',
					ext: '.css'
				} ]
			},
			woocommerce: {
				files: [ {
					expand: true,
					cwd: 'inc/woocommerce/css/',
					src: [ '*.css' ],
					dest: 'inc/woocommerce/css/',
					ext: '.css'
				} ]
			}
		},

		// Watch changes for assets.
		watch: {
			css: {
				files: [
					'style.scss',
					'sass/**/*.scss',
					'inc/customizer/sass/*.scss',
					'inc/woocommerce/sass/*.scss'
				],
				tasks: [
					'sass',
					'rtlcss',
					'cssmin',
					'clean:core'
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
				tasks: [ 'uglify' ]
			}
		},

		// Generate POT files.
		makepot: {
			options: {
				type: 'wp-theme',
				domainPath: 'languages',
				potHeaders: {
					'report-msgid-bugs-to': 'Valen Designs <support@valendesigns.com>',
					'last-translator': 'Valen Designs <support@valendesigns.com>',
					'language-team': 'Valen Designs <support@valendesigns.com>'
				}
			},
			frontend: {
				options: {
					potFilename: '<%= pkg.name %>.pot',
					exclude: [
						'dist/<%= pkg.name %>/.*' // Exclude deploy directory
					],
					processPot: function( pot ) {
						pot.headers['project-id-version'];
						return pot;
					}
				}
			}
		},

		// Check textdomain errors.
		checktextdomain: {
			options:{
				text_domain: '<%= pkg.name %>',
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
				src:	[
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
					'!npm-debug.log',
					'!.DS_Store',
					'!style.scss',
					'!sass/**',
					'!inc/customizer/sass/*.scss',
					'!inc/woocommerce/sass/*.scss',
					'!tests/**',
					'!phpunit.xml.dist'
				],
				dest: 'dist/<%= pkg.name %>',
				expand: true,
				dot: true
			}
		},

		// Compress distribution package into a ZIP
		compress: {
			deploy: {
				options: {
					archive: 'dist/<%= pkg.name %>-<%= pkg.version %>.zip',
					mode: 'zip'
				},
				files: [ {
					expand: true,
					cwd: 'dist/<%= pkg.name %>/',
					src: [ '**/*' ],
					dest: '<%= pkg.name %>'
				} ]
			}
		},

		// Clean up
		clean: {
			core: {
				src: [ 'style-rtl.css' ]
			},
			deploy: {
				src: [ 'dist/<%= pkg.name %>' ]
			}
		},

		// Shell actions for transifex client
		shell: {
			options: {
				stdout: true,
				stderr: true
			},
			txpush: {
				command: 'tx push -s' // push the resources
			},
			txpull: {
				command: 'tx pull -a -f' // pull the .po files
			}
		},

		// Convert .po to .mo
		potomo: {
			options: {
				poDel: false
			},
			dist: {
				files: [ {
					expand: true,
					cwd: 'languages/',
					src: [
						'*.po'
					],
					dest: 'languages/',
					ext: '.mo',
					nonull: true
				} ]
			}
		}

	});

	// Load tasks
	grunt.loadNpmTasks( 'grunt-contrib-jshint' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-sass' );
	grunt.loadNpmTasks( 'grunt-rtlcss' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-checktextdomain' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-shell' );
	grunt.loadNpmTasks( 'grunt-potomo' );

	// Register tasks
	grunt.registerTask( 'default', [
		'css',
		'uglify'
	]);

	grunt.registerTask( 'css', [
		'sass',
		'rtlcss',
		'cssmin',
		'clean:core'
	]);

	grunt.registerTask( 'tx_update', [
		'makepot',
		'shell:txpush'
	]);

	grunt.registerTask( 'dev', [
		'default',
		'tx_update'
	]);

	grunt.registerTask( 'mo', [
		'shell:txpull',
		'potomo'
	]);

	grunt.registerTask( 'deploy', [
		'mo',
		'copy',
		'compress',
		'clean'
	]);

};
