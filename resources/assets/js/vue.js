window.Vue = require('vue');
require('vue-resource');

window.VueTables = require('vue-tables-2');
import {ServerTable, ClientTable, Event} from 'vue-tables-2';
//window.VueTables = require('vue-tables-2');
//import Vue from 'vue';
window.bus = Event;
//window.bus = require('vue-tables-2/compiled/bus');

require('./vue/filters');