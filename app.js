// Data initialization
console.log("js file loaded")
const data = {
    showShop: false,
    searchQuery: "",
    selectedCategory: "",
    isSubmitting: false,
    submissionError: false,
    showSuccessMessage: false,

    categories: [
        { title: 'Medicinal Flowers', slug:'medicinal', description: 'Premium botanicals for holistic wellness and traditional remedies', color: '#5a716a', image: './image/medi.jpg' },
        { title: 'Ornamental Flowers', slug:'ornamental', description: 'Curated floral masterpieces for sophisticated environments', color: '#8c6a58', image: './image/ornamental.jpg' },
        { title: 'Worship Flowers', slug:'worship', description: 'Sacred blossoms for spiritual ceremonies and divine offerings', color: '#7a645a', image: './image/worship.jpg' },
        { title: 'Edible Flowers', slug:'edible', description: 'Gourmet selection for culinary arts and premium infusions', color: '#9e5a6c', image: './image/edible.jpg' },
        { title: 'Fragrant Flowers', slug:'fragrant', description: 'Luxurious aromatics for perfumery and essence extraction', color: '#7a6a8c', image: './image/fragrant.jpg' },
        { title: 'Seasonal Flowers', slug:'seasonal', description: 'Exclusive varieties curated for seasonal celebrations', color: '#5a718c', image: './image/season.jpg' },
        { title: 'Dried & Everlasting Flowers', slug:'dried', description: 'Timeless arrangements for enduring elegance', color: '#8c7d6a', image: './image/dried.jpg' },
        { title: 'Luxury Gifting Flowers', slug:'luxury', description: 'Bespoke arrangements for corporate and executive gifting', color: '#8c8a5a', image: './image/luxe.jpeg' },
        { title: 'Home Scents Flowers', slug:'home', description: 'Premium botanicals for luxury candles and ambient fragrances', color: '#6a5a8c', image: './image/home.jpg' },
        { title: 'Natural Dye Flowers', slug:'natural', description: 'Sustainable pigments for eco-friendly textile production', color: '#5a5a8c', image: './image/ndye.jpg' }
    ]
};


     

function init() {
    console.log('Page loaded init()');
    renderCategories();
    mounted();
}

// Create the category cards dynamically
function renderCategories() {
    const categoriesList = document.getElementById('categories-list');
    categoriesList.innerHTML = ''; // Clear any existing content

    data.categories.forEach(category => {
        const categoryCard = document.createElement('div');
        categoryCard.classList.add('category-card');
        categoryCard.style.backgroundColor = category.color;

        categoryCard.innerHTML = `
            <div class="category-text-content">
                <h3 class="category-title">${category.title}</h3>
                <p class="category-desc">${category.description}</p>
                <button class="enter-btn" onclick="goToCategory('${category.slug}')">Explore Collection →</button>
            </div>
            <img src="${category.image}" alt="${category.title}" class="category-image">
        `;
        categoriesList.appendChild(categoryCard);
    });
}



// Handling navigation
function navigateToFlowers(categorySlug) {
    window.location.href = `flower.php?category=${encodeURIComponent(categorySlug)}`;
    data.showShop = true;
}

//navigate to category page
function goToCategory(slug) {
    window.location.href = `category.php?category=${encodeURIComponent(slug)}`;
}

// Call init on page load
window.onload = init;


// Exploring the shop
function exploreShop() {
    data.showShop = true;
}

// Filter categories based on URL
function filterCategories() {
    const params = new URLSearchParams(window.location.search);
    const urlCategory = params.get('category');
    if (urlCategory) {
        data.selectedCategory = urlCategory;
    }
}


// Mounting function
function mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
    console.log('Selected Category:', category);

    filterCategories();//call the filter category to apply the filter
     
}
