var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.3.min.js'; // Check https://jquery.com/ for the current version
document.getElementsByTagName('head')[0].appendChild(script);
function makeAjaxRequest(method, url, data, callback) {
    console.log(JSON.stringify(data));
    $.ajax({
        method: method,
        url: url,
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            callback(null, response);
        },
        error: function(xhr, status, error) {
            callback(error, null);
        }
    });
}

// const apiUrl = 'https://api.example.com/data';

// makeAjaxRequest('GET', apiUrl, null, function(error, response) {
//     if (error) {
//         console.error('Error:', error);
//     } else {
//         console.log('Response:', response);
//         // Process response data here
//     }
// });


// makeAjaxRequest('POST', apiUrl, postData, function(error, response) {
//     if (error) {
//         console.error('Error:', error);
//     } else {
//         console.log('Response:', response);
//         // Process response data here
//     }
// });
