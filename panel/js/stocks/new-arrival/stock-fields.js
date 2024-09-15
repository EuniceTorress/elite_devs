import { fetchCategories, fetchAutocompleteSuggestions } from './fetch-categories.js';

export function generateStockFields(count, existingData, categories, autocompleteSuggestions, stocksFields) {
  stocksFields.innerHTML = "";

  for (let i = 0; i < count; i++) {
    const data = existingData[i] || { name: '', description: '', category: 'electronics', otherCategory: '', quantity: '', unitPrice: '', unitCost: '' };

    const optionsHtml = categories.map(cat => 
      `<option value="${cat}" ${data.category === cat ? 'selected' : ''}>${cat.charAt(0).toUpperCase() + cat.slice(1)}</option>`
    ).join('');

    const fieldHtml = `
    <div class="stock-field">
      <div class="row">
        <p class="lb">${i + 1}.</p>
        <div class="form-group col-2">
          <label for="itemName${i}">Item Name:</label>
          <input type="text" class="form-control itemNameClass" id="itemName${i}" name="itemName${i}" value="${data.name}" placeholder="Enter item name">
          <div id="autocomplete${i}" class="autocomplete-suggestions"></div>
        </div>
        <div class="form-group col-2">
          <label for="itemDescription${i}">Description:</label>
          <input type="text" class="form-control" id="itemDescription${i}" name="itemDescription${i}" value="${data.description}" placeholder="Optional">
        </div>
        <div class="form-group col-2">
          <label for="itemCategory${i}">Type:</label>
          <select class="form-control" id="itemCategory${i}" name="itemCategory${i}">
            ${optionsHtml}
            <option value="others" ${data.category === 'others' ? 'selected' : ''}>Others</option>
          </select>
        </div>
        <div class="additional-category col-2" id="additionalCategory${i}" style="display: ${data.category === 'others' ? 'block' : 'none'};">
          <div class="form-group">
            <input type="text" class="form-control" id="otherCategory${i}" name="otherCategory${i}" value="${data.otherCategory}" placeholder="Specify Type"> 
          </div>
        </div>
        <div class="form-group col-1">
          <label for="itemCost${i}">Unit Cost:</label>
          <input type="number" step="0.01" class="form-control" id="itemCost${i}" name="itemCost${i}" value="${data.unitCost}" min="1" required>
        </div>
        <div class="form-group col-1">
          <label for="itemPrice${i}">Unit Price:</label>
          <input type="number" step="0.01" class="form-control" id="itemPrice${i}" name="itemPrice${i}" value="${data.unitPrice}" min="1" required>
        </div>
        <div class="form-group col-1">
          <label for="itemQuantity${i}">Quantity:</label>
          <input type="number" class="form-control" id="itemQuantity${i}" name="itemQuantity${i}" value="${data.quantity}" min="1" required>
        </div>
      </div>
      <hr>
    </div>
    `;
    stocksFields.insertAdjacentHTML('beforeend', fieldHtml);
  }

  stocksFields.querySelectorAll('input[name^="itemName"]').forEach((input, index) => {
    const suggestionsContainer = document.getElementById('autocomplete' + index);

    input.addEventListener('input', function() {
      const query = this.value.toLowerCase();
      suggestionsContainer.innerHTML = '';
      if (query.length > 0) {
        const filteredSuggestions = autocompleteSuggestions.filter(item => item.toLowerCase().includes(query));
        filteredSuggestions.forEach(suggestion => {
          const div = document.createElement('div');
          div.textContent = suggestion;
          div.addEventListener('click', () => {
            input.value = suggestion;
            suggestionsContainer.innerHTML = '';
          });
          suggestionsContainer.appendChild(div);
        });
      }
    });

    document.addEventListener('click', function(event) {
      if (!input.contains(event.target) && !suggestionsContainer.contains(event.target)) {
        suggestionsContainer.innerHTML = '';
      }
    });
  });

  stocksFields.querySelectorAll('select[name^="itemCategory"]').forEach(select => {
    select.addEventListener('change', function(event) {
      const index = this.id.match(/\d+/)[0];
      const additionalCategory = document.getElementById('additionalCategory' + index);
      additionalCategory.style.display = this.value === 'others' ? 'block' : 'none';
    });
    select.dispatchEvent(new Event('change'));
  });
}

export function getExistingStockData(stocksFields) {
  const currentFields = Array.from(stocksFields.getElementsByClassName('stock-field'));
  return currentFields.map((field, index) => ({
    name: field.querySelector(`#itemName${index}`).value,
    description: field.querySelector(`#itemDescription${index}`).value,
    category: field.querySelector(`#itemCategory${index}`).value,
    otherCategory: field.querySelector(`#otherCategory${index}`).value,
    quantity: field.querySelector(`#itemQuantity${index}`).value,
    unitPrice: field.querySelector(`#itemPrice${index}`).value,
    unitCost: field.querySelector(`#itemCost${index}`).value
  }));
}
