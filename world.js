document.addEventListener('DOMContentLoaded', function(){
    // Get the lookup button and lookup cities button
    const lookupBtn = document.getElementById('lookup');
    const lookupCitiesBtn = document.getElementById('lookup-cities');

    // Function to handle the XMLHttpRequest
    function makeRequest(url, callback) {
        return function (event) {
            event.preventDefault();

            const country = document.getElementById('country');
            const result = document.getElementById('result');
            let requested = country.name + "=" + country.value;

            const xhr = new XMLHttpRequest();

            xhr.onload = function () {
                callback(result, this.responseText);
            }

            xhr.open("GET", url + requested, true);
            xhr.send();
        };
    }

    // Add click event listeners for both buttons
    lookupBtn.addEventListener('click', makeRequest("world.php?", updateResult));
    lookupCitiesBtn.addEventListener('click', makeRequest("world.php?context=cities&", updateResult));

    // Callback function to update the result element
    function updateResult(resultElement, responseText) {
        console.log(responseText);
        resultElement.innerHTML = responseText;
    }
});
