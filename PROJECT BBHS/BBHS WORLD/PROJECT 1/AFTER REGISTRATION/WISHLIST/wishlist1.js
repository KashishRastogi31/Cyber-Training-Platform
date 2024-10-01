document.addEventListener("DOMContentLoaded", () => {
  // Load wishlist from localStorage
  let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

  // Function to update localStorage
  function updateWishlist() {
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
  }

  // Function to check if the course is already in the wishlist
  function isCourseInWishlist(courseId) {
    return wishlist.some((course) => course.id === courseId);
  }

  // Function to remove course from wishlist
  function removeFromWishlist(courseId) {
    wishlist = wishlist.filter((course) => course.id !== courseId);
    updateWishlist();
    displayWishlist();
  }

  // Function to add course to wishlist
  function addToWishlist(course) {
    if (!isCourseInWishlist(course.id)) {
      wishlist.push(course);
      updateWishlist();
      alert("Course added to wishlist!");
    } else {
      alert("Course is already in your wishlist.");
    }
  }

  // Function to display wishlist
  function displayWishlist() {
    const wishlistContainer = document.getElementById("wishlist-container");
    wishlistContainer.innerHTML = "";

    wishlist.forEach((course) => {
      const courseElement = document.createElement("div");
      courseElement.classList.add("course");
      courseElement.innerHTML = `
                <div class="course-img">
                    <img src="${course.imageUrl}" alt="Course Image">
                </div>
                <div class="course-body">
                    <div class="course-category">${course.category}</div>
                    <div class="course-title">${course.title}</div>
                    <div class="course-icon-row">
                        <span class="course-icon-left"><i class="fa fa-user gray"></i> ${course.level}</span>
                        <span class="course-icon-right"><i class="fa fa-hourglass gray"></i> ${course.time}</span>
                    </div>
                    <div class="course-price">${course.price}</div>
                </div>
                <div class="course-btn-container">
                    <button class="btn btn-blue course-btn buy-btn"><i class="fa fa-shopping-bag"></i> Buy Course</button>
                    <button class="btn btn-red course-btn remove-btn" data-id="${course.id}"><i class="fa fa-trash"></i> Remove</button>
                </div>
            `;
      wishlistContainer.appendChild(courseElement);

      // Add event listener to remove button
      courseElement
        .querySelector(".remove-btn")
        .addEventListener("click", function () {
          removeFromWishlist(course.id);
        });
    });
  }

  // Display the wishlist on page load
  displayWishlist();
});
