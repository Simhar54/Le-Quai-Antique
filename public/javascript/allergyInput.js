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

// Add click event listener to the "Add Allergy" button
ajouterAllergieBtn.addEventListener("click", () => {
  const currentInput = document.getElementById(`qa_allergy_${allergieCount}`);
  const invalidFeedback = currentInput.nextElementSibling;

  // Validate the current allergy input before adding it to the list
  if (validateAllergyInput(currentInput)) {
    const listItem = document.createElement("li");
    listItem.textContent = currentInput.value;

    // Create a "Remove" button for the list item
    const removeBtn = document.createElement("button");
    const removeIcon = document.createElement("i");
    removeIcon.classList.add("bi", "bi-trash-fill");
    removeBtn.appendChild(removeIcon);
    removeBtn.classList.add("btn", "btn-sm", "ml-2");
    removeBtn.addEventListener("click", () => {
      removeListItemAndHiddenInput(listItem, currentInput.id);
    });

    listItem.appendChild(removeBtn);
    allergyList.appendChild(listItem);

    // Change the current input type to hidden and hide the invalid feedback
    currentInput.type = "hidden";
    invalidFeedback.style.display = "none";

    // Increment the allergy count
    allergieCount++;

    // Create a new label for the next input
    const newInputLabel = document.createElement("label");
    newInputLabel.htmlFor = `qa_allergy_${allergieCount}`;
    allergiesContainer.insertBefore(newInputLabel, ajouterAllergieBtn);

    // Create a new input for the next allergy
    const newInput = document.createElement("input");
    newInput.type = "text";
    newInput.classList.add("form-control");
    newInput.id = `qa_allergy_${allergieCount}`;
    newInput.name = "allergies[]";
    newInput.required = true;
    // Add input event listener to validate the new input
    newInput.addEventListener("input", () => validateAllergyInput(newInput));
    allergiesContainer.insertBefore(newInput, ajouterAllergieBtn);

    // Create a new invalid feedback element for the new input
    const newInvalidFeedback = document.createElement("div");
    newInvalidFeedback.classList.add("invalid-feedback");
    newInvalidFeedback.textContent = "Veuillez entrer une allergie.";
    allergiesContainer.insertBefore(newInvalidFeedback, ajouterAllergieBtn);
    ajouterAllergieBtn.scrollIntoView();
  } else {
    // Display invalid feedback if the current input is not valid
    invalidFeedback.style.display = "block";
  }
});
