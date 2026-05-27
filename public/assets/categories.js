// public/js/categories.js

const categories = {
    "Competitive & Govt Exams": [
        "Civil Services",
        "Banking Exams",
        "Railway Exams",
        "SSC Exams",
        "Defence Exams",
        "Teaching Exams",
        "Other Govt Exams"
    ],

    "Academic & School Education": [
        "Pre-Primary",
        "Primary",
        "Middle School",
        "Secondary",
        "Senior Secondary",
        "Board-wise",
        "Subject-wise"
    ],

    "Fiction Books": [
        "Indian Fiction",
        "International Fiction",
        "Genre Fiction"
    ],

    "Non-Fiction Books": [
        "Biography & Autobiography",
        "Self Help",
        "Business & Economics",
        "History & Society",
        "Science & Technology"
    ],

    "Skill Development & Professional": [
        "Skill Books"
    ],

    "Children & Young Readers": [
        "Children Books"
    ],

    "Religion & Spirituality": [
        "Religion Books"
    ],

    "Reference & Functional Books": [
        "Reference"
    ],

    "Digital & Format Based": [
        "Book Format"
    ]
};

// Load categories
const categorySelect = document.getElementById("category");
const subCategorySelect = document.getElementById("sub_category");

Object.keys(categories).forEach(category => {
    let option = document.createElement("option");
    option.value = category;
    option.textContent = category;
    categorySelect.appendChild(option);
});

// Load subcategories on category change
categorySelect.addEventListener("change", function () {

    const selectedCategory = this.value;

    // Reset subcategory
    subCategorySelect.innerHTML =
        '<option value="">Select Sub Category</option>';

    if (selectedCategory && categories[selectedCategory]) {

        categories[selectedCategory].forEach(subCategory => {

            let option = document.createElement("option");

            option.value = subCategory;
            option.textContent = subCategory;

            subCategorySelect.appendChild(option);
        });
    }
});
