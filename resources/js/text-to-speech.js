// text-to-speech.js

// Function to read the text using the Web Speech API
function readAloud(text) {
    if ('speechSynthesis' in window) {
        const utterance = new SpeechSynthesisUtterance(text);
        // Optional: Set the language if necessary (e.g., en-US)
        utterance.lang = 'en-US'; // You can adjust the language here
        window.speechSynthesis.speak(utterance);
    } else {
        alert('Sorry, your browser does not support text-to-speech.');
    }
}

// Attach event listeners to all speaker icons on the page
document.addEventListener('DOMContentLoaded', () => {
    const speakerIcons = document.querySelectorAll('.speaker-icon');

    // Function to handle the click event
    function handleClick() {
        let textToRead = '';

        // Check if the icon is inside a specific content section
        const jobListingContainer = this.closest('li'); // Check if inside a job listing (if applicable)
        const headingContainer = this.closest('h1'); // Check if inside a heading (if applicable)

        if (jobListingContainer) {
            const jobTitle = jobListingContainer.querySelector('h3')?.textContent.trim() || '';
            const location = jobListingContainer.querySelector('p:nth-of-type(1)')?.textContent.trim() || '';
            const salary = jobListingContainer.querySelector('p:nth-of-type(2)')?.textContent.trim() || '';
            textToRead = `${jobTitle}. ${location}. ${salary}.`;
        // } else if (headingContainer) {
        //     // Read aloud the heading
        //     textToRead = headingContainer.textContent.trim();
        } else {
            // Fallback to the data-text attribute if no other element is found
            textToRead = this.dataset.text || 'No text available to read';
        }

        readAloud(textToRead);
    }

    // Add event listeners to all speaker icons
    speakerIcons.forEach(icon => {
        icon.addEventListener('click', handleClick);

        // Add keyboard accessibility (Enter/Space)
        icon.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                handleClick.call(icon);
            }
        });
    });
});
