
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import { Application } from '@hotwired/stimulus';
import { definitionsFromContext } from '@hotwired/stimulus-webpack-helpers';
const application = Application.start();


const context = require.context('./controllers', true, /\.js$/);
// Suggested code may be subject to a license. Learn more: ~LicenseLog:1679593970.
application.load(definitionsFromContext(context));


