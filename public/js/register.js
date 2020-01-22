/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/js/register.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/register.js":
/*!*******************************!*\
  !*** ./assets/js/register.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

/* ######################
    Need some css
#######################*/
// require('../sass/user-forms.scss');

/* ######################
    Variables
#######################*/
// the form
var registerFormDiv = document.querySelector('#log-in_form'); // the inputs

var usernameInput = document.querySelector('#username');
var emailInput = document.querySelector('#email');
var passwordInput = document.querySelector('#password');
var passwordBisInput = document.querySelector('#password-bis'); // the spans to display errors

var usernameErrorSpan = document.querySelector('label[for="username"] span.msg-error');
var emailErrorSpan = document.querySelector('label[for="email"] span.msg-error');
var passwordErrorSpan = document.querySelector('label[for="password"] span.msg-error');
var passwordBisErrorSpan = document.querySelector('label[for="password-bis"] span.msg-error'); // array including inputs and error spans

var inputsAndSpans = [['username', usernameInput, usernameErrorSpan], ['email', emailInput, emailErrorSpan], ['password', passwordInput, passwordErrorSpan], ['password-bis', passwordBisInput, passwordBisErrorSpan]]; // the clickable question marks to display input rule helps

var usernameQuestionMark = document.querySelector('#username-help');
var passwordQuestionMark = document.querySelector('#password-help');
var passwordBisQuestionMark = document.querySelector('#password-bis-help'); // the text to display when a question mark is clicked

var usernameHelp = 'Le pseudonyme doit comporter entre 3 et 20 caractères.\nIl peut être composé de :\nmajuscules\nminuscules\nchiffres\ncaractères spéciaux parmis cette liste : à â ç é è ê ë î ï ô ù û ÿ.\nLes caractères suivants - _ et espace peuvent être utilisés mais ne peuvent débuter ou finir le pseudo ni être mis cote-à-cote.';
var passwordHelp = 'Le mot de passe doit comporter entre 8 et 20 caractères.\nIl doit être composé d\'au moins :\n1 majuscule\n1 minuscule\n1 chiffre\n1 caractère spécial.';
var passwordBisHelp = 'Ce deuxième mot de passe doit être identique au premier.'; // array including question marks and text to display

var helpers = [[usernameQuestionMark, usernameHelp], [passwordQuestionMark, passwordHelp], [passwordBisQuestionMark, passwordBisHelp]]; // a boolean to know if there are errors in form to prevent submiting

var errorFlag = false;
/* ######################
    Event listeners
#######################*/
// focus event on inputs

var _loop = function _loop(i) {
  var group = inputsAndSpans[i];
  /* group[0] is the input id
     group[1] is the input
     group[2] is the associated error span */

  group[1].addEventListener('focus', function () {
    // remove any error class or message
    group[1].classList.remove('value-error');
    group[2].innerHTML = '';
  });
};

for (var i = 0; i < inputsAndSpans.length; i++) {
  _loop(i);
} // blur event on inputs


var _loop2 = function _loop2(_i) {
  var group = inputsAndSpans[_i];
  /* group[0] is the input id
     group[1] is the input
     group[2] is the associated error span */

  group[1].addEventListener('blur', function () {
    checkInputValue(group);
  });
};

for (var _i = 0; _i < inputsAndSpans.length; _i++) {
  _loop2(_i);
} // submit event on form


registerFormDiv.addEventListener('submit', function () {
  errorFlag = false; // check each input value

  for (var _i2 = 0; _i2 < inputsAndSpans.length; _i2++) {
    var group = inputsAndSpans[_i2];
    checkInputValue(group);
  }

  if (errorFlag) {
    event.preventDefault();
  }
}); // click event on a question mark

var _loop3 = function _loop3(_i3) {
  /* helpers[i][0] : the question mark
      helpers[i][1] : the text to display */
  helpers[_i3][0].addEventListener('click', function () {
    event.preventDefault();
    alert(helpers[_i3][1]);
  });
};

for (var _i3 = 0; _i3 < helpers.length; _i3++) {
  _loop3(_i3);
}
/* ######################
    Functions
#######################*/
//  check the value of the input


function checkInputValue(group) {
  /* group[0] is the input id
      group[1] is the input
      group[2] is the associated error span */
  console.log(group);
  var regEx = '';
  var errorMessage = '';

  switch (group[0]) {
    case 'username':
      regEx = /^[a-zA-Z0-9àâçéèêëîïôùûÿ]+(['_\s\-]?[a-zA-Z0-9àâçéèêëîïôùûÿ])*$/;

      if (group[1].value === '') {
        errorMessage = 'Il faut entrer un pseudonyme.';
      } else if (group[1].value.length < 3 || group[1].value.length > 20) {
        errorMessage = 'Le nombre de caractères n\'est pas correct.';
      } else if (!regEx.test(group[1].value)) {
        errorMessage = 'Les caractères employés ne correspondent pas à la règle.';
      }

      break;

    case 'email':
      regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      if (group[1].value === '') {
        errorMessage = 'Il faut entrer une adresse email';
      } else if (!regEx.test(group[1].value)) {
        errorMessage = 'Cette adresse mail ne semble pas valide.';
      }

      break;

    case 'password':
      regEx = /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,20}$/;

      if (group[1].value === '') {
        errorMessage = 'Il faut entrer un mot de passe.';
      } else if (!regEx.test(group[1].value)) {
        errorMessage = 'Ce mot de passe n\'est pas valide';
      }

      break;

    case 'password-bis':
      if (group[1].value === '') {
        errorMessage = 'Il faut entrer un mot de passe.';
      } else if (group[1].value !== passwordInput.value) {
        errorMessage = 'Les deux champs de mot de passe doivent être identiques.';
      }

      break;

    default:
      console.log('Erreur, cet input est inconnu !!');
  } // check if there were error in the input


  if (errorMessage !== '') {
    errorFlag = true;
    displayError(errorMessage, group);
  }
} // Display the errro message in the good span


function displayError(errorMessage, group) {
  /* group[0] is the input id
      group[1] is the input
      group[2] is the associated error span */
  group[2].innerHTML = errorMessage;
  group[1].classList.add('value-error');
}
/*  TODOs :



    DONEs :

        _ retirer les messages d'erreur avant le check blur et submit
            -> dans checkInputValue() ?
*/

/***/ })

/******/ });
//# sourceMappingURL=register.js.map