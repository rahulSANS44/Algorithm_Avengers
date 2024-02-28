const navItems = document.querySelector('.nav-item');
const openNavBtn = document.querySelector('#open_nav-btn');
const closeNavBtn = document.querySelector('#close_nav-btn");

// opens nav dropdown

const openNav =() => {
navItems.style.display = 'flex';
openNavBtn.style.display = 'none';
closeNavBtn.style.display = 'inline-block';
}

// close nav dropdown

const closeNav = () => {
navItems.style.display = 'none';
openNavBtn.style.display = 'inline-block';
closeNavBtn.style.display = 'none';
}

openNavBtn.addEventListener('click', openNav);

closeNavBtn.addEventListener('click', closeNav);


const sidebar= document.querySelector('aside');
const showsidebarbtn= document.querySelector('#show_sidebar-btn');
const hidesidebarbtn= document.querySelector('#hide_sidebar-btn');


const showsidebar=() => {
    sidebar.style.left='0';
    showSidebarBtn.style.display ='none';
    hidesidebarbtn.style.display='inline-block';
}

const hideSidebar=() => {
    sidebar.style.left='-100%';
    showSidebarBtn.style.display ='inline-block';
    hidesidebarbtn.style.display='none';
}


showSidebarBtn.addEventListener('click', showSidebar);
hidesidebarbtn.addEventListener('click', hideSidebar);