
    // Image and caption data
    const carouselData = [
        {
            src: "image1.jpg",
            caption: {
                title: "REVO 2016 TO<br>ROCCO 2021",
                subtitle: "UPGRADE KIT"
            }
        },
        {
            src: "image2.jpg",
            caption: {
                title: "FORTUNER 2016<br>TO 2021",
                subtitle: "TRD BODY KIT"
            }
        },
        // Add more items as needed
    ];

    let currentIndex = 0;

    const imageElement = document.getElementById("carousel-image");
    const captionElement = document.getElementById("carousel-caption");

    function updateCarousel() {
        const currentItem = carouselData[currentIndex];
        imageElement.src = currentItem.src;
        captionElement.innerHTML = `
            <h2>${currentItem.caption.title}</h2>
            <h3>${currentItem.caption.subtitle}</h3>
            <a href="#" class="buy-button">BUY NOW</a>
        `;
        currentIndex = (currentIndex + 1) % carouselData.length; // Loop back to the first item
    }

    // Automatically update carousel every 5 seconds
    setInterval(updateCarousel, 5000);

    // Initialize the first display
    updateCarousel();
