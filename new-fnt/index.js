document.addEventListener("DOMContentLoaded", function() {
  const menu = document.getElementById('menu');
  const menuItems = document.querySelector('.menu_items');

  if (menu && menuItems) {
    menu.addEventListener('click', function () {
      if (menuItems.classList.contains('hidden')) {
        menuItems.classList.remove('hidden','opacity-0');
        menuItems.classList.add('flex','opacity-100');
      } else {
        menuItems.classList.add('hidden','opacity-0');
        menuItems.classList.remove('flex','opacity-100');
      }
    });
  }

  const yearlyButton = document.getElementById("yearly");
  const monthlyButton = document.getElementById("monthly");

  if (yearlyButton && monthlyButton) {
    yearlyButton.addEventListener("click", function() {
      yearlyButton.classList.add("active");
      monthlyButton.classList.remove("active");
    });

    monthlyButton.addEventListener("click", function() {
      monthlyButton.classList.add("active");
      yearlyButton.classList.remove("active");
    });
  }
});
// faq
document.addEventListener('DOMContentLoaded', function() {
  const parents = document.querySelectorAll('.parent');

  parents.forEach(parent => {
    parent.addEventListener('click', function() {
      const child = this.querySelector('.child');

      // Toggle child visibility
      child.classList.toggle('hidden');
      
      // Rotate the toggle icon
      this.querySelector('.toggle-icon').classList.toggle('rotate-45');

      if (!child.classList.contains('hidden')) {
        // If child is shown, set its height to auto for smooth transition
        child.style.maxHeight = child.scrollHeight + 'px';
      } else {
        // If child is hidden, set its height back to 0 for smooth transition
        child.style.maxHeight = '0';
      }
    });

    // Add click event listener for child to hide it when clicked
    const child = parent.querySelector('.child');
    if (child) {
      child.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent parent click event from firing
        this.classList.add('hidden'); // Hide the child
        this.style.maxHeight = '0'; // Set child's height to 0 for smooth transition
        parent.querySelector('.toggle-icon').classList.remove('rotate-45'); // Rotate the toggle icon back
      });
    }
  });
});



