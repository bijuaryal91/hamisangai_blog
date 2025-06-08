// Sidebar Toggle
const menuToggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');

menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

// Theme Toggle
const toggleThemeBtn = document.querySelector('#toggle-theme');
const html = document.documentElement;

toggleThemeBtn.addEventListener('click', () => {
    const currentTheme = html.getAttribute('data-theme');
    html.setAttribute('data-theme', currentTheme === 'dark' ? 'light' : 'dark');
});

// Dropdowns (Notifications and Profile)
const notificationBtn = document.querySelector('.notification-btn');
const profileBtn = document.querySelector('.profile-btn');
const notificationDropdown = document.querySelector('.notification-dropdown');
const profileDropdown = document.querySelector('.profile-dropdown');

notificationBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    notificationDropdown.classList.toggle('active');
    profileDropdown.classList.remove('active');
});

profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('active');
    notificationDropdown.classList.remove('active');
});

// Close dropdowns when clicking outside
document.addEventListener('click', () => {
    notificationDropdown.classList.remove('active');
    profileDropdown.classList.remove('active');
});

// Tabs Functionality
const tabBtns = document.querySelectorAll('.tab-btn');
const tabPanes = document.querySelectorAll('.tab-pane');

tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        // Remove active class from all buttons and panes
        tabBtns.forEach(b => b.classList.remove('active'));
        tabPanes.forEach(p => p.classList.remove('active'));
        // Add active class to clicked button and corresponding pane
        btn.classList.add('active');
        const targetPane = document.querySelector(`#${btn.getAttribute('data-tab')}`);
        targetPane.classList.add('active');
    });
});

// Comment Filter Buttons
const commentFilterBtns = document.querySelectorAll('.comment-filter .btn');
commentFilterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        commentFilterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        // Add logic to filter comments based on btn dataset or content
        console.log(`Filtering comments by: ${btn.textContent}`);
    });
});

// Pagination
const paginationBtns = document.querySelectorAll('.pagination button');
paginationBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        if (!btn.disabled) {
            paginationBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            // Add logic to update table content based on page
            console.log(`Navigating to page: ${btn.textContent}`);
        }
    });
});



// Image Upload Preview
const imageUploadInput = document.querySelector('.image-upload input[type="file"]');
const imagePreview = document.querySelector('.image-upload img');

if (imageUploadInput && imagePreview) {
    imageUploadInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (event) => {
                imagePreview.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

// Tag Management
const tagInput = document.querySelector('.sidebar-section input[data-tags]');
const tagsContainer = document.querySelector('.tags-container');

if (tagInput && tagsContainer) {
    tagInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && tagInput.value.trim()) {
            const tag = document.createElement('div');
            tag.className = 'tag';
            tag.innerHTML = `
                ${tagInput.value.trim()}
                <i class="fas fa-times"></i>
            `;
            tagsContainer.appendChild(tag);
            tagInput.value = '';
            
            // Remove tag on click
            tag.querySelector('i').addEventListener('click', () => {
                tag.remove();
            });
        }
    });
}

// Sample Chart Data (Replace with actual data source)
const viewsChartCtx = document.querySelector('#viewsChart');
if (viewsChartCtx) {
    const viewsChart = new Chart(viewsChartCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Page Views',
                data: [1200, 1900, 3000, 2500, 4000, 3500],
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart Filter
    const chartFilter = document.querySelector('.chart-filter select');
    chartFilter.addEventListener('change', (e) => {
        const value = e.target.value;
        // Update chart data based on filter (sample logic)
        viewsChart.data.datasets[0].data = value === 'monthly' 
            ? [1200, 1900, 3000, 2500, 4000, 3500]
            : value === 'weekly' 
            ? [300, 450, 700, 600, 900, 800]
            : [50, 70, 120, 100, 150, 130];
        viewsChart.update();
    });
}

// Initialize on Page Load
document.addEventListener('DOMContentLoaded', () => {
    // Set default active tab
    const defaultTab = document.querySelector('.tab-btn');
    if (defaultTab) {
        defaultTab.click();
    }
    
    // Set default active pagination
    const defaultPage = document.querySelector('.pagination button:not(:disabled)');
    if (defaultPage) {
        defaultPage.click();
    }
    
    // Set default comment filter
    const defaultFilter = document.querySelector('.comment-filter .btn');
    if (defaultFilter) {
        defaultFilter.click();
    }


    
});