'use strict';
module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        min: {
            dist: {
                src: [
                        'src/js/kmPMT.js'
                ],
                dest: 'build/dist/kmPMT.min.js'
            }
        },
        cssmin: {
            dist: {
                src: ['src/assets/css/main.css'],
                dest: 'build/dist/assets/css/kmPMT.min.css'
            }
        },
        jshint: {
            all: ['src/**/*.js']
        },
        csslint: {
            options: {
                csslintrc: '.csslintrc',
            },
            all: {
                src: ['src/assets/css/*.css']
            }
        },

    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.registerTask('default', ['jshint']);
};