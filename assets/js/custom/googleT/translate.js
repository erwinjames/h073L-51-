// script.js
// Function to translate all text elements on the page
function translatePage(targetLanguage) {
  const elementsToTranslate = document.querySelectorAll('[data-translate]');
  elementsToTranslate.forEach(element => {
    const originalText = element.dataset.translate;
    googleTranslate(targetLanguage, originalText, translatedText => {
      element.textContent = translatedText;
    });
  });
}

// Google Translate function
function googleTranslate(targetLanguage, text, callback) {
  const baseUrl = 'https://translate.googleapis.com/translate_a/single';
  const apiUrl = `${baseUrl}?client=gtx&sl=auto&tl=${targetLanguage}&dt=t&q=${encodeURIComponent(text)}`;

  fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
      const translatedText = data[0][0][0];
      callback(translatedText);
    })
    .catch(error => console.error('Error translating:', error));
}

// Function to set language preference in local storage
function setLanguagePreference(language) {
  localStorage.setItem('language', language);
}

// Function to get language preference from local storage
function getLanguagePreference() {
  return localStorage.getItem('language') || 'en'; // Default language is English
}

// Function to handle language selection
function handleLanguageSelection(languageCode) {
  setLanguagePreference(languageCode);
  translatePage(languageCode);
}

// Get elements
const englishButton = document.getElementById('englishButton');
const japaneseButton = document.getElementById('japaneseButton');

// Event listeners for language buttons
englishButton.addEventListener('click', () => {
  handleLanguageSelection('en');
});

japaneseButton.addEventListener('click', () => {
  handleLanguageSelection('ja');
});

// Initial call to translate page based on stored language preference
const storedLanguage = getLanguagePreference();
translatePage(storedLanguage);
