// Add a click event listener to the document
document.addEventListener('click', function(event) {
    // Check if the clicked element is a button and has all three classes
    if (event.target.tagName === 'BUTTON' && event.target.classList.contains('btn') && event.target.classList.contains('btn-success') && event.target.classList.contains('btn-lg')) {
        if(event.target.innerHTML == 'بروزرسانی') {
            // The clicked button has all three classes
            event.target.disable = true;
            event.target.style.background = '#0dcd9482';
            event.target.style.padding = '24.5px 62px';
            event.target.innerHTML = '';
    
            var customLoader = document.createElement('span');
            customLoader.className = 'custom-loader';
            customLoader.style.transform = 'rotate(45deg) scale(0.5) translate(128px, -125px)';
        
            var parentDiv = event.target.parentElement;
    
            // Append the custom loader to the parent div
            parentDiv.appendChild(customLoader);
        } else {
            // The clicked button has all three classes
            event.target.disable = true;
            event.target.style.background = '#0dcd9482';
            event.target.style.padding = '24.5px 44px';
            event.target.innerHTML = '';
    
            var customLoader = document.createElement('span');
            customLoader.className = 'custom-loader';
            customLoader.style.transform = 'rotate(45deg) scale(0.5) translate(100px, -95px)';
        
            var parentDiv = event.target.parentElement;
    
            // Append the custom loader to the parent div
            parentDiv.appendChild(customLoader);
        }
    }
});