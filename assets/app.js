import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/global.scss';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

/*let btnAccessories = document.querySelector('.em-btnAccessories');
let btnSystem = document.querySelector('.em-btnSystem');
let btnScreen = document.querySelector('.em-btnScreen');
let btnNetwork = document.querySelector('.em-btnNetwork');
let btnRam = document.querySelector('.em-btnRam');

let inputAccessories = document.getElementById('preselection_accessories');
let inputSystem = document.getElementById('preselection_system');
let inputScreen = document.getElementById('preselection_screen');
let inputNetwork = document.getElementById('preselection_network');
let inputRam = document.getElementById('preselection_ram');
let inputStorage = document.getElementById('preselection_storage');

let accessories = document.querySelector('.em-accessories');
let system = document.querySelector('.em-system');
let screen = document.querySelector('.em-screen');
let network = document.querySelector('.em-network');
let ram = document.querySelector('.em-ram');

btnAccessories.addEventListener('click', emDisappear(system, accessories));
btnSystem.addEventListener('click', emDisappear(screen, system));
btnScreen.addEventListener('click', emDisappear(network, screen));
btnNetwork.addEventListener('click', emDisappear(ram, network));
btnRam.addEventListener('click', emDisappear(storage, ram));

inputAccessories.addEventListener('click', emAppear(btnAccessories));
inputSystem.addEventListener('click', emAppear(btnSystem));
inputScreen.addEventListener('click', emAppear(btnScreen));
inputNetwork.addEventListener('click', emAppear(btnNetwork));

function emDisappear(appear, disappear) {
    console.log('disappear')
    appear.style.display = 'unset';
    disappear.style.display = 'none';
}

function emAppear(element) {
    console.log('appear')
    element.style.display = 'unset';
}*/
