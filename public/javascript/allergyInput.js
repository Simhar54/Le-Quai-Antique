// Get the "Add Allergy" button, allergies container and allergy list elements
const ajouterAllergieBtn = document.getElementById("add_allergy");
const allergiesContainer = document.getElementById("allergy_form_container");
const allergyList = document.querySelector(".qa_allergy_form_list");

// Initialize the allergy count
let allergieCount = 1;

// Function to remove a list item and its associated hidden input element
function removeListItemAndHiddenInput(listItem, inputId) {
  const inputToRemove = document.getElementById(inputId);
  if (inputToRemove) {
    inputToRemove.remove();
  }
  listItem.remove();
}

// Function to validate the allergy input and apply Bootstrap validation styles
function validateText(input) {
  const regex = /^[a-zA-Z\s]+$/;
  return regex.test(input.value);
}

function validateAllergyInput(input) {
  const isValid = validateText(input);

  if (isValid) {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  } else {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
  }
  return isValid;
}

function addAllergy(allergyValue, id) {
  const listItem = document.createElement("li");
  listItem.textContent = allergyValue;

  const removeBtn = document.createElement("button");
  const removeIcon = document.createElement("i");
  removeIcon.classList.add("bi", "bi-trash-fill");
  removeBtn.appendChild(removeIcon);
  removeBtn.classList.add("btn", "btn-sm", "ml-2");
  removeBtn.addEventListener("click", () => {
    removeListItemAndHiddenInput(listItem, `qa_allergy_${id}`);
  });

  listItem.appendChild(removeBtn);
  allergyList.appendChild(listItem);

  const newInput = document.createElement("input");
  newInput.type = "hidden";
  newInput.id = `qa_allergy_${id}`;
  newInput.name = "allergies[]";
  newInput.value = allergyValue;
  allergiesContainer.appendChild(newInput);
}

// In the click event listener for the "Add Allergy" button,
// you now just call the addAllergy function with the current input value
ajouterAllergieBtn.addEventListener("click", () => {
  console.log("Ajouter une allergie button clicked");
  const currentInput = document.getElementById(`qa_allergy_${allergieCount}`);
  const invalidFeedback = currentInput.nextElementSibling;

  if (validateAllergyInput(currentInput)) {
    addAllergy(currentInput.value, allergieCount);

    // Remove the current input from the DOM
    currentInput.remove();

    // Increment the allergy count
    allergieCount++;

    // Create a new input for the next allergy
    const newInput = document.createElement("input");
    newInput.type = "text";
    newInput.classList.add("form-control");
    newInput.id = `qa_allergy_${allergieCount}`; // Notice the change here
    newInput.name = "allergies[]";
    newInput.required = true;

    // Add input event listener to validate the new input
    newInput.addEventListener("input", () => validateAllergyInput(newInput));

    // Insert the new input before the "Add Allergy" button
    allergiesContainer.insertBefore(newInput, ajouterAllergieBtn);

    // Create a new invalid feedback element for the new input
    const newInvalidFeedback = document.createElement("div");
    newInvalidFeedback.classList.add("invalid-feedback");
    newInvalidFeedback.textContent = "Veuillez entrer une allergie.";

    // Insert the new invalid feedback element before the "Add Allergy" button
    allergiesContainer.insertBefore(newInvalidFeedback, ajouterAllergyBtn);
  } else {
    invalidFeedback.style.display = "block";
  }
});




// This code to pre-fill the user's existing allergies also uses the addAllergy function
let allergiesArray = document.getElementById("allergy_form_container");

if (allergiesArray.dataset.allergies) {
  let allergies = JSON.parse(allergiesArray.dataset.allergies);

  allergies.forEach((allergy, index) => {
    addAllergy(allergy, allergieCount);
    allergieCount++;
  });
}
 