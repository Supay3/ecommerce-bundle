/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/admin.css';

// start the Stimulus application
import './bootstrap';

import {AdminProductProductAttributeValueType} from "./admin/product/AdminProductProductAttributeValueType";
import {CollectionBasicType} from "./admin/CollectionBasicType";

if (document.querySelector('.add-attribute-link')) {
    let adminProductProductAttributeValueType = new AdminProductProductAttributeValueType(document.querySelector('.add-attribute-link'), '#product_productAttribute');
}
if (document.querySelector('.add-item-link')) {
    let collectionBasicType = new CollectionBasicType(document.querySelector('.add-item-link'));
}