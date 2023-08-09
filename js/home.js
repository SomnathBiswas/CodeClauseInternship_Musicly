// =================================MAIN Tabs ==================================
// Select all tab links
const tabLinks = document.querySelectorAll('.main-tabs');
const pTabLinks = document.querySelectorAll('.playlist-tabs');

// Add event listeners to tab links
tabLinks.forEach(tabLink => {
    tabLink.addEventListener('click', handleTabClick);
});

function handleTabClick(event) {
    event.preventDefault();

    // Remove 'active' class from all playlist tab links and tabs
    pTabLinks.forEach(pTabLink => {
        pTabLink.classList.remove('active');
    });
    const pTabs = document.querySelectorAll('.playlist-tab-content');
    pTabs.forEach(pTab => {
        pTab.classList.remove('active');
    });

    // Remove 'active' class from all main tab links and tabs
    tabLinks.forEach(tabLink => {
        tabLink.classList.remove('active');
    });
    const tabs = document.querySelectorAll('.main-tab-content');
    tabs.forEach(tab => {
        tab.classList.remove('active');
    });

    // Add 'active' class to clicked tab link and corresponding tab
    const selectedTab = event.target.getAttribute('href');
    const selectedTabLink = document.querySelector(`[href="${selectedTab}"]`);
    selectedTabLink.classList.add('active');
    const selectedTabContent = document.querySelector(selectedTab);
    selectedTabContent.classList.add('active');
}
// =============================================================================

// =============================== PLAYLIST Tabs ===============================
// Add event listeners to tab links
pTabLinks.forEach(pTabLink => {
    pTabLink.addEventListener('click', handlePlaylistTabClick);
});

function handlePlaylistTabClick(event) {
    event.preventDefault();

    // Remove 'active' class from all main tab links and tabs
    tabLinks.forEach(tabLink => {
        tabLink.classList.remove('active');
    });
    const mainTabs = document.querySelectorAll('.main-tab-content');
    mainTabs.forEach(tab => {
        tab.classList.remove('active');
    });

    // Remove 'active' class from all playlist tab links and tabs
    pTabLinks.forEach(pTabLink => {
        pTabLink.classList.remove('active');
    });
    const pTabs = document.querySelectorAll('.playlist-tab-content');
    pTabs.forEach(pTab => {
        pTab.classList.remove('active');
    });

    // Add 'active' class to clicked tab link and corresponding tab
    const selectedTab = event.target.getAttribute('href');
    const selectedTabLink = document.querySelector(`[href="${selectedTab}"]`);
    selectedTabLink.classList.add('active');
    const selectedTabContent = document.querySelector(selectedTab);
    selectedTabContent.classList.add('active');
}
// =============================================================================

// ================================== MODALS ===================================
const createPlaylistModal = document.getElementById("createPlaylistModal")
const newPlaylistBtn = document.getElementById("newPlaylistBtn")
const createPlaylistCloseBtn = document.getElementById("createPlaylistCloseBtn")

const choosePlaylistModal = document.getElementById("choosePlaylistModal")
const choosePlaylistBtn = document.getElementById("choosePlaylistBtn")
const choosePlaylistCloseBtn = document.getElementById("choosePlaylistCloseBtn")

// CREATE PLAYLIST EVENT
newPlaylistBtn.onclick = () => {
    createPlaylistModal.style.display = "flex"
}

// CLOSE CREATE PLAYLIST EVENT
createPlaylistCloseBtn.onclick = () => {
    createPlaylistModal.style.display = "none"
}


// ADD TO PLAYLIST EVENT
choosePlaylistBtn.onclick = () => {
    choosePlaylistModal.style.display = "flex"
}

// CLOSE ADD TO PLAYLIST EVENT
choosePlaylistCloseBtn.onclick = () => {
    choosePlaylistModal.style.display = "none"
}


// =============================================================================

