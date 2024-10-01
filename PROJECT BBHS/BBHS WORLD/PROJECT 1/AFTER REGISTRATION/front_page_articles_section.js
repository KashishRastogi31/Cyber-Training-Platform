// For three Sides Of Cyber Security
const divs = document.querySelectorAll(".red_side,.blue_side ,.purple_side");
const redirectUrls = ["redside.html", "blueside.html", "purpleside.html"];

divs.forEach(function (div, index) {
  div.addEventListener("click", function () {
    window.location.href = redirectUrls[index];
  });
});

// For Article Section

const parentDivs = document.querySelectorAll(".stats,.rp,.news");
const childDivs = document.querySelectorAll(".actual_data");

parentDivs.forEach((parentDiv, index) => {
  parentDiv.addEventListener("click", () => {
    const childDiv = childDivs[index];
    if (childDiv.style.display === "block") {
      childDiv.style.display = "none";
    } else {
      // Close all child divs
      childDivs.forEach((otherChildDiv) => {
        otherChildDiv.style.display = "none";
      });
      childDiv.style.display = "block";
    }
  });
});


// For News Section, IMG1
const newsImage1 = document.getElementById("news_image1");
const newsImagesArray1 = [
  {
    url: "https://hackread.com/grand-theft-auto-fake-gta-vi-beta-download-malware/",
    img: "news1.jpg",
  },
  {
    url: "https://therecord.media/cyber-army-russia-us-sanctions",
    img: "news3.png",
  },
  {
    url: "https://techcrunch.com/2024/07/19/us-cyber-agency-cisa-says-malicious-hackers-are-taking-advantage-of-crowdstrike-outage",
    img: "news5.png",
  },
];

let currentIndex1 = 0;

function changeNewsImage1() {
  newsImage1.src = newsImagesArray1[currentIndex1].img;
  const currentIndex = currentIndex1; // create a closure
  newsImage1.onclick = function () {
    window.location.href = newsImagesArray1[currentIndex].url;
  };
  currentIndex1 = (currentIndex1 + 1) % newsImagesArray1.length;
}

changeNewsImage1();
setInterval(changeNewsImage1, 2500);

// For News Section, IMG2
const newsImage2 = document.getElementById("news_image2");
const newsImagesArray2 = [
  {
    url: "https://blog.sucuri.net/2024/07/attackers-abuse-swap-file-to-steal-credit-cards.html",
    img: "news2.jpg",
  },
  {
    url: "https://www.recordedfuture.com/research/oilalpha-spyware-used-to-target-humanitarian-aid-groups",
    img: "news4.png",
  },
  {
    url: "https://www.cybersecuritydive.com/news/funding-hits-2-year-high/721748",
    img: "news6.png",
  },
];

let currentIndex2 = 0;

function changeNewsImage2() {
  newsImage2.src = newsImagesArray2[currentIndex2].img;
  const currentIndex = currentIndex2; // create a closure
  newsImage2.onclick = function () {
    window.location.href = newsImagesArray2[currentIndex].url;
  };
  currentIndex2 = (currentIndex2 + 1) % newsImagesArray2.length;
}

changeNewsImage2();
setInterval(changeNewsImage2, 3000);

// FAQ
const questions = document.querySelectorAll(".faq_questions");
const answers = document.querySelectorAll(".faq_answers");

questions.forEach((question, index) => {
  question.addEventListener("click", () => {
    answers[index].classList.toggle("show");
  });
});
