document.getElementById('submitButton').addEventListener('click', function(event) {
    document.getElementById('submitButton').disabled=true;
    document.getElementById('dtrForm').submit();
});