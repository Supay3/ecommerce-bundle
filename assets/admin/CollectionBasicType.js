import {AbstractCollectionType} from "./AbstractCollectionType.js";

/**
 * This class allows you to create easily a Collection adding feature for Symfony
 */
export class CollectionBasicType extends AbstractCollectionType {

    /**
     * @param {HTMLElement} button The button to add an item to the collection
     */
    constructor(button) {
        super();
        this.addButton = button;
        this.list = document.querySelector(this.addButton.getAttribute('data-collection-holder-class'));
        this.addDeleteLinkToExistingDiv();

        // Events
        this.addButton.addEventListener('click', () => {
            this.createNewDiv();
        });
    }

    addDeleteLinkToExistingDiv() {
        if (this.list.children.length > 0) {
            for (let i = 0; i < this.list.children.length; i++) {
                let listChildren = this.list.children[i];
                this.addFormRemoveButton(listChildren);
            }
        }
    }

    createNewDiv() {
        let counter = this.list.getAttribute('data-widget-counter').valueOf();
        let newFormGroup = this.list.getAttribute('data-prototype');
        newFormGroup = newFormGroup.replaceAll('__name__', counter);
        counter++;
        this.list.setAttribute('data-widget-counter', counter);
        let newDiv = document.createElement('div');
        newDiv.setAttribute('class', 'admin-list-collection-element');
        newDiv.innerHTML = newFormGroup;
        this.list.append(newDiv);
        this.addFormRemoveButton(newDiv);
    }
}