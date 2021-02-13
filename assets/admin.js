import {AdminProductProductAttributeValueType} from "./admin/product/AdminProductProductAttributeValueType";
import {CollectionBasicType} from "./admin/CollectionBasicType";


if (document.querySelector('.add-attribute-link')) {
    let adminProductProductAttributeValueType = new AdminProductProductAttributeValueType(document.querySelector('.add-attribute-link'), '#product_productAttribute');
}
if (document.querySelector('.add-item-link')) {
    let collectionBasicType = new CollectionBasicType(document.querySelector('.add-item-link'));
}

import $ from 'jquery';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/admin.css';
import 'select2';
$('#product_productOptions').select2();
$('.admin-input-select').select2();