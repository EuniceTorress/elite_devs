function matchesCategory(rowCategory, selectedCategories) {
    return selectedCategories.length === 0 || selectedCategories.includes(rowCategory);
}

function matchesFilter(selectedFilter, rowQuantity) {
    return (selectedFilter === 'low' && rowQuantity <= 5) ||
           (selectedFilter === 'high' && rowQuantity > 5) ||
           selectedFilter === '';
}

function sortRows(filteredRows, sortOrder) {
    return filteredRows.sort((a, b) => {
        const aValue = a.cells[sortOrder.column].textContent.trim();
        const bValue = b.cells[sortOrder.column].textContent.trim();
        const aNum = parseFloat(aValue.replace(/[^0-9.-]+/g, '')) || aValue;
        const bNum = parseFloat(bValue.replace(/[^0-9.-]+/g, '')) || bValue;

        if (aNum > bNum) return sortOrder.ascending ? 1 : -1;
        if (aNum < bNum) return sortOrder.ascending ? -1 : 1;
        return 0;
    });
}

export { matchesCategory, matchesFilter, sortRows };
