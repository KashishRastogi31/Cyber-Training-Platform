document.addEventListener("DOMContentLoaded", () => {
  console.log("JavaScript Loaded!");

  // Function to update localStorage
  function updateWishlist(wishlist) {
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
    console.log("Wishlist updated:", wishlist);
  }

  // Function to check if the course is already in the wishlist
  function isCourseInWishlist(wishlist, courseId) {
    return wishlist.some((course) => course.id === courseId);
  }

  // Function to add course to wishlist
  function addToWishlist(course) {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    if (!isCourseInWishlist(wishlist, course.id)) {
      wishlist.push(course);
      updateWishlist(wishlist);
      alert("Course added to wishlist!");
      document.querySelector(
        `.add-to-list-btn[data-id="${course.id}"]`
      ).innerHTML = '<i class="fa fa-check"></i> Added';
    } else {
      alert("Course is already in your wishlist.");
    }
  }

  // Add click event listener to all 'Add to List' buttons
  document.querySelectorAll(".add-to-list-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const course = {
        id: this.getAttribute("data-id"),
        imageUrl: this.getAttribute("data-image-url"),
        title: this.getAttribute("data-title"),
        category: this.getAttribute("data-category"),
        price: this.getAttribute("data-price"),
        level: this.getAttribute("data-level"),
        time: this.getAttribute("data-time"),
      };

      addToWishlist(course);
      this.disabled = true;
      this.innerHTML = '<i class="fa fa-check"></i> Added';
    });
  });

  // Update button states on page load
  function updateButtonStates() {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    document.querySelectorAll(".add-to-list-btn").forEach((button) => {
      const courseId = button.getAttribute("data-id");
      if (isCourseInWishlist(wishlist, courseId)) {
        button.innerHTML = '<i class="fa fa-check"></i> Added';
        button.disabled = true;
      } else {
        button.innerHTML = '<i class="fa fa-list"></i> Add to List';
        button.disabled = false;
      }
    });
  }

  updateButtonStates();

  // Listen for storage events
  window.addEventListener("storage", updateButtonStates);
});
