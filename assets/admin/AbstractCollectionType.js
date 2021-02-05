/**
 * Abstract class for the CollectionType
 */
export class AbstractCollectionType {

    /**
     * Creates a remove button for a Collection element
     *
     * @param {HTMLElement} formLi The Collection element that requires a remove button
     * @param {HTMLDataElement} option Specify in case you need a remove button for a ProductAttribute, if specified this will also delete the
     * selected attribute from the Product ProductAttribute option linked to the Product ProductAttributeValue that is deleted,
     * needs the counter array and the id of the Product ProductAttribute list to work
     * @param {array} counter An array of the selected Product ProductAttribute options
     * @param {string} listId The id of the ProductAttribute list, needs to be in querySelector format ('#' at the beginning)
     */
    addFormRemoveButton (formLi, option = null, counter = null, listId = '') {
        let removeFormButton = this.createRemoveButton();
        formLi.append(removeFormButton);
        removeFormButton.addEventListener('click', function () {
            if (option !== null && counter !== null && listId !== '') {
                let optionList = document.querySelector(listId);
                for (let i = 0; i < optionList.children.length; i++) {
                    let currentOption = optionList.children[i];
                    if (currentOption.value === option.value) {
                        if (currentOption.hasAttribute('selected')) {
                            currentOption.removeAttribute('selected');
                            AbstractCollectionType.removeValueFromArray(counter, currentOption.value);
                        }
                    }
                }
            }
            this.parentElement.remove();
        });
    }

    /**
     * @returns {HTMLButtonElement}
     */
    createRemoveButton () {
        let removeFormButton = document.createElement('button');
        removeFormButton.className = 'remove-form-button';
        removeFormButton.setAttribute('type', 'button');
        removeFormButton.append('Remove');
        return removeFormButton;
    }

    /**
     * @param {array} array The array which you want to delete the value from
     * @param value The value you want to delete
     */
    static removeValueFromArray (array, value) {
        let index = array.indexOf(value);
        if (index !== -1) {
            array.splice(index, 1);
        }
    }
}