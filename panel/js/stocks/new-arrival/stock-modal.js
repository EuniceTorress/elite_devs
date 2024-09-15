import { showModal, hideModal } from './modal.js';
import { showMessageModal } from './message.js';
import { generateStockFields, getExistingStockData } from './stock-fields.js';
import { fetchCategories, fetchAutocompleteSuggestions } from './fetch-categories.js';

document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById("newArrival");
  const overlay = document.getElementById("modalOverlay");
  const messageModal = document.getElementById("messageModal");
  const link = document.getElementById("openNewArrivalModal");
  const closeBtns = document.getElementsByClassName("close");
  const stockCountInput = document.getElementById("stockCount");
  const stocksFields = document.getElementById("stocksFields");
  const formStockCount = document.getElementById("formStockCount");

  function clearNewArrivalFields() {
    stockCountInput.value = '';
    formStockCount.value = '';
    stocksFields.innerHTML = '';
  }

  if (link) {
    link.onclick = function(event) {
      event.preventDefault();
      showModal(modal, overlay);
    };
  }

  Array.from(closeBtns).forEach(btn => {
    btn.onclick = function() {
      hideModal(modal, overlay, messageModal, clearNewArrivalFields);
    };
  });

  window.onclick = function(event) {
    if (event.target === overlay) {
      hideModal(modal, overlay, messageModal, clearNewArrivalFields);
    }
  };

  stockCountInput.addEventListener('input', function() {
    const count = parseInt(this.value, 10) || 0;
    formStockCount.value = count;
    fetchCategories()
      .then(categories => fetchAutocompleteSuggestions()
        .then(autocompleteSuggestions => generateStockFields(
          count, 
          getExistingStockData(stocksFields), 
          categories, 
          autocompleteSuggestions, 
          stocksFields
        ))
      );
  });

  const form = document.getElementById('stocksForm');
  if (form) {
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      console.log('Form submission triggered');

      const formData = new FormData(form);
      for (const [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
      }

      fetch(form.action, {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        console.log('Response:', data);
        showMessageModal(data.includes('Successfully inserted') ? 'Stock information submitted successfully' : data, messageModal);
        if (data.includes('Successfully inserted')) {
          hideModal(modal, overlay, messageModal, clearNewArrivalFields);
          location.reload();
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showMessageModal('An error occurred.', messageModal);
      });
    });
  }

  fetchCategories()
    .then(categories => fetchAutocompleteSuggestions()
      .then(autocompleteSuggestions => generateStockFields(
        parseInt(stockCountInput.value, 10) || 0, 
        getExistingStockData(stocksFields), 
        categories, 
        autocompleteSuggestions, 
        stocksFields
      ))
    );
});
