// EDIT BUTTON
function enableInputs() {

    // get elements by class
    const cityInputs = document.querySelectorAll('.edit-city');
    const inputs = document.querySelectorAll('.edit');

    // show the city names after clicking edit
    cityInputs.forEach(cityInput => cityInput.hidden = false);

    // enable change the inputs
    inputs.forEach(input => input.disabled = false);
}