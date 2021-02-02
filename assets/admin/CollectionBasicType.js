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
        this.ul = document.querySelector(this.addButton.getAttribute('data-collection-holder-class'));
        this.addDeleteLinkToExistingLi();

        // Events
        this.addButton.addEventListener('click', () => {
            this.createNewLi();
        });
    }

    addDeleteLinkToExistingLi() {
        if (this.ul.children.length > 0) {
            for (let i = 0; i < this.ul.children.length; i++) {
                let ulChildren = this.ul.children[i];
                this.addFormRemoveButton(ulChildren);
            }
        }
    }

    createNewLi() {
        let counter = this.ul.getAttribute('data-widget-counter').valueOf();
        let newFormGroup = this.ul.getAttribute('data-prototype');
        newFormGroup = newFormGroup.replaceAll('__name__', counter);
        counter++;
        this.ul.setAttribute('data-widget-counter', counter);
        let newLi = document.createElement('li');
        newLi.innerHTML = newFormGroup;
        this.ul.append(newLi);
        this.addFormRemoveButton(newLi);
    }
}