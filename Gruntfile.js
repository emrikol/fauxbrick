module.exports = function( grunt ) {
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),
		concat: {
			options: {
				stripBanners: true,
			},
			main: {
				src: [
					'js/src/fauxbrick.js'
				],
				dest: 'js/fauxbrick.js'
			},
			navigation: {
				src: [
					'js/src/navigation.js'
				],
				dest: 'js/navigation.js'
			},
			customizer: {
				src: [
					'js/src/customizer.js'
				],
				dest: 'js/customizer.js'
			},
			skip_link_focus_fix: {
				src: [
					'js/src/skip-link-focus-fix.js'
				],
				dest: 'js/skip-link-focus-fix.js'
			}
		},

		uglify: {
			all: {
				files: {
					'js/fauxbrick.min.js': ['js/fauxbrick.js'],
					'js/navigation.min.js': ['js/navigation.js'],
					'js/customizer.min.js': ['js/customizer.js'],
					'js/skip-link-focus-fix.min.js': ['js/skip-link-focus-fix.js'],
				},
				options: {
					mangle: {
						except: ['jQuery']
					}
				}
			}
		},

		sass: {
			all: {
				options: {
					unixNewlines: true
				},
				files: {
					'style.css': 'scss/style.scss',
				}
			}
		},

		cssmin: {
			front_end: {
				expand: true,

				cwd: './',
				src: ['style.css'],

				dest: './',
				ext: '.min.css'
			}
		},

		watch: {
			styles: {
				files: [ 'scss/**/*.scss' ],
				tasks: [ 'sass', 'cssmin' ],
				options: {
					debounceDelay: 500
				}
			},
			scripts: {
				files: [ 'js/src/**/*.js' ],
				tasks: [ 'concat', 'uglify' ],
				options: {
					debounceDelay: 500
				}
			}
		},

		clean: {
			main: ['release/<%= pkg.version %>']
		},

		copy: {
			main: {
				src:  [
					'**',
					'!**/.*',
					'!**/style.css.map',
					'!**/readme.md',
					'!node_modules/**',
					'!release/**',
					'!scss/**',
					'!fonts/**',
					'!js/src/**',
					'!js/bootstrap/**',
					'!images/src/**',
					'!composer.json',
					'!composer.lock',
					'!Gruntfile.js',
					'!package.json',
				],
				dest: 'release/<%= pkg.version %>/'
			}
		},

		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: './release/<%= pkg.name %>.<%= pkg.version %>.zip'
				},
				expand: true,
				cwd: 'release/<%= pkg.version %>/',
				src: ['**/*'],
				dest: '<%= pkg.name %>/'
			}
		}
	} );

	require('load-grunt-tasks')(grunt);

	grunt.registerTask( 'default', ['concat', 'uglify', 'sass', 'cssmin' ] );
	grunt.registerTask( 'css', ['sass', 'autoprefixer', 'cssmin'] );
	grunt.registerTask( 'js', ['concat', 'uglify'] );
	grunt.registerTask( 'build', ['default', 'clean', 'copy', 'compress'] );

	grunt.util.linefeed = '\n';
};