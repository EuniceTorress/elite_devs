const API_BASE_URL = '../sql/js/';

export function fetchCategories() {
  return fetch(`${API_BASE_URL}categories.php`)
    .then(response => response.json())
    .catch(error => console.error('Error fetching categories:', error));
}

export function fetchAutocompleteSuggestions() {
  return fetch(`${API_BASE_URL}stocks.php`)
    .then(response => response.json())
    .catch(error => console.error('Error fetching autocomplete suggestions:', error));
}
