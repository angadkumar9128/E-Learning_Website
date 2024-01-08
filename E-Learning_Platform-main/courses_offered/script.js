// Course data (sample)
const courses = [
    {
        title: "Introduction to Programming",
        description: "Learn the fundamentals of programming using languages like Python and Java.",
        imageUrl: "course1.jpg"
    },
    {
        title: "Data Structures and Algorithms",
        description: "Understand essential data structures and algorithms used in software development.",
        imageUrl: "course2.jpg"
    },
    {
        title: "Web Development",
        description: "Learn to build interactive and dynamic websites using HTML, CSS, and JavaScript.",
        imageUrl: "course3.jpg"
    },
    // Add more courses here
];

// Function to populate course listings
function populateCourses() {
    const courseContainer = document.getElementById("courseContainer");
    courseContainer.innerHTML = ""; // Clear previous courses

    courses.forEach(course => {
        const courseDiv = document.createElement("div");
        courseDiv.classList.add("course");

        const courseImage = document.createElement("img");
        courseImage.src = course.imageUrl;
        courseImage.alt = course.title;
        courseDiv.appendChild(courseImage);

        const courseTitle = document.createElement("h3");
        courseTitle.textContent = course.title;
        courseDiv.appendChild(courseTitle);

        const courseDescription = document.createElement("p");
        courseDescription.textContent = course.description;
        courseDiv.appendChild(courseDescription);

        courseContainer.appendChild(courseDiv);
    });
}

// Show the login modal when the "Login" link is clicked
document.getElementById("loginLink").addEventListener("click", () => {
    document.getElementById("loginModal").style.display = "block";
});

// Hide the login modal when the "Close" button is clicked
document.querySelector(".close").addEventListener("click", () => {
    document.getElementById("loginModal").style.display = "none";
});

// Handle login form submission
document.getElementById("loginForm").addEventListener("submit", (e) => {
    e.preventDefault();
    // Handle login logic here (not implemented in this template)
    // For a real implementation, you would need to use a backend server for authentication
    // After successful login, you can show the "Logout" link and hide the "Login" link
    document.getElementById("loginModal").style.display = "none";
    document.getElementById("loginLink").style.display = "none";
    document.getElementById("logoutLink").style.display = "inline-block";
});

// Initial course population
populateCourses();
