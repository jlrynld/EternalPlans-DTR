function submitForm() {
    // Get selected action
    var selectedAction = document.getElementById('selectAction').value;

    // Get current time
    var currentTime = getCurrentTime();

    // Set selected action and current time in hidden inputs
    document.getElementById('selectedAction').value = selectedAction;
    document.getElementById('currentTime').value = currentTime;

    function route(name, parameters = {}) {
        const url = new URL(window.location.origin + '/' + name);
    
        for (const [key, value] of Object.entries(parameters)) {
            url.searchParams.append(key, value);
        }
    
        return url.toString();
    }

    // Submit the form using Ajax
    var formData = new FormData(document.getElementById('dtrForm'));
    $.ajax({
        url: '{{ route('dashboard.recordTime') }}',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
    });
}

// Attach click event listener to the submit button
document.getElementById('submitButton').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission
    submitForm(); // Call submitForm function
});