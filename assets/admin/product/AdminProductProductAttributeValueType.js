import {AbstractCollectionType} from "../AbstractCollectionType.js";

/**
 * This class allows us to add ProductAttributeValues to a Product and to set a good looking to those who already exists
 */
export class AdminProductProductAttributeValueType extends AbstractCollectionType {

    /**
     * @param {HTMLElement} button The addAttribute(s) button
     * @param {string} listId The id of the ProductAttribute list, needs to be in querySelector format ('#' at the beginning)
     */
    constructor(button, listId) {
        super();
        this.listId = listId;
        this.addButton = button;
        this.attributeValueList = document.querySelector(this.addButton.getAttribute('data-collection-holder-class'));
        this.Counter = {
            'counter': [],
            'data-widget-counter': this.attributeValueList.getAttribute('data-widget-counter').valueOf(),
        };
        this.attributeList = document.querySelector(listId);
        this.attributeValueChildrenList = this.attributeValueList.children.length > 0 ? this.attributeValueList.children : null;
        this.newProductAttributeValueForm = this.attributeValueList.getAttribute('data-prototype').valueOf();

        // Modification of the DOM
        this.seekForOptions();

        // Events
        this.addButton.addEventListener('click', () => {
            this.currentlySelectedOptions = this.attributeList.selectedOptions;
            this.addProductProductAttributeValue();
        });
    }

    /**
     * If some Product ProductAttributeValue already exists for this Product, seeks for their linked ProductAttribute
     * in attempt to change their label, set the selected attribute on the Product ProductAttribute and add a delete button
     * for each of the Product ProductAttributeValue
     */
    seekForOptions () {
        if (this.attributeValueChildrenList !== null) {
            this.SelectedOption = {
                'option': null,
            };
            for (let i = 0; i < this.attributeValueChildrenList.length; i++) {
                let attributeValueChildren = this.attributeValueChildrenList[i];
                let attributeValueChildrenOptions = attributeValueChildren.getElementsByTagName('option');
                for (let j = 0; j < attributeValueChildrenOptions.length; j++) {
                    let attributeValueChildrenOption = attributeValueChildrenOptions[j];
                    if (attributeValueChildrenOption.hasAttribute('selected')) {
                        this.Counter.counter.push(attributeValueChildrenOption.value);
                        this.SelectedOption.option = attributeValueChildrenOption;
                        this.changeLabelForExistingAttributeValue(attributeValueChildrenOption, attributeValueChildren);
                        this.setSelectedOnProductAttributeOptions(attributeValueChildrenOption);
                    }
                }
                this.addFormRemoveButton(attributeValueChildren, this.SelectedOption.option, this.Counter.counter, this.listId);
            }
        }
    }

    /**
     * Set the ProductAttributeValue label to the linked ProductAttribute name
     *
     * @param {HTMLElement} attributeValueChildrenOption The productAttributeValue option which contains the label to set
     * @param {HTMLElement} attributeValueChildren The productAttributeValue child element which contains the label to change
     */
    changeLabelForExistingAttributeValue (attributeValueChildrenOption, attributeValueChildren) {
        attributeValueChildren.getElementsByTagName('label').forEach(function (label) {
            if (label.textContent === 'Text value') {
                label.textContent = attributeValueChildrenOption.textContent;
            }
        });
    }

    /**
     * Compare the value of the ProductAttribute options and the ProductAttributeValue ProductAttribute that is selected
     * in attempt to set 'selected' attribute to the ProductAttribute option which match
     *
     * @param {HTMLDataElement} attributeValueChildrenOption The ProductAttribute option of the ProductAttributeValue that is selected
     */
    setSelectedOnProductAttributeOptions (attributeValueChildrenOption) {
        if (this.attributeList.children.length > 0) {
            for (let i = 0; i < this.attributeList.children.length; i++) {
                let attributeOption = this.attributeList.children[i];
                if (attributeOption.value === attributeValueChildrenOption.value) {
                    attributeOption.setAttribute('selected', 'selected');
                }
            }
        }
    }

    /**
     * Adds a new Product ProductAttributeValue to the Product form
     */
    addProductProductAttributeValue() {
        for (let i = 0; i < this.currentlySelectedOptions.length; i++) {
            let currentlySelectedOption = this.currentlySelectedOptions[i];
            let n = 0;
            while (!this.Counter.counter.includes(currentlySelectedOption.value) && n < this.currentlySelectedOptions.length) {
                n++;
                this.Counter.counter.push(currentlySelectedOption.value);
                this.Counter["data-widget-counter"]++;
                currentlySelectedOption.setAttribute('selected', 'selected');
                this.attributeValueList.append(this.createNewProductAttributeValueForm(currentlySelectedOption));
            }
        }
    }

    /**
     *
     * @param {HTMLDataElement} currentlySelectedOption
     * @returns {HTMLLIElement}
     */
    createNewProductAttributeValueForm(currentlySelectedOption) {
        let newProductAttributeValueForm = this.newProductAttributeValueForm
            .replace('Text value', currentlySelectedOption.textContent)
            .replaceAll('__name__', this.Counter["data-widget-counter"].valueOf())
        ;
        let newProductAttributeValueLi = document.createElement('li');
        newProductAttributeValueLi.innerHTML = newProductAttributeValueForm;
        let options = newProductAttributeValueLi.getElementsByTagName('option');
        for (let i = 0; i < options.length; i++) {
            let option = options[i];
            if (option.value === currentlySelectedOption.value) {
                option.setAttribute('selected', 'selected');
            }
        }
        this.addFormRemoveButton(newProductAttributeValueLi, currentlySelectedOption, this.Counter.counter, this.listId);
        return newProductAttributeValueLi;
    }
}